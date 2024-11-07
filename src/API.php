<?php

/**
 * Class APIRequest
 * 
 * This class handles the request method for the API. It retrieves and stores the HTTP request
 * method (e.g., GET, POST, etc.) from the server, and provides a method to access the request method.
 * 
 * @package PHP-API
 * @author t045t
 * @link https://t045t.dev
 * @license MIT
 */
class API
{
    /**
     * The HTTP request method (e.g., GET, POST, PUT, DELETE).
     * 
     * @var string
     */
    public string $requesMethod;

    /**
     * The response data that the API returns to the user
     * 
     * @var mixed
     */
    public mixed $response;


    /**
     * The response code that the API returns to the user
     * Default is `OK - 200`
     * 
     * @var int
     */
    public int $responseCode = 200;

    /**
     * The final response with all the data and the correct response wrapper
     * 
     * @var array
     */
    private array $finalResponse;

    /**
     * The start time of the script.
     *
     * This property holds the timestamp of when the script execution began.
     * It is used to calculate the runtime of the script by comparing it with the current time
     * at the point where the script's execution ends.
     *
     * @var float The start time of the script (in seconds).
     */
    private float $scriptStartTime;


    /**
     * Custom wrapper to modify the structure of the response.
     *
     * This array holds the customization options for the response wrapper.
     * It can be used to override the default wrapper structure, allowing
     * for more control over the response format.
     *
     * @var array The custom response wrapper.
     */
    private array $customWrapper;


    /**
     * Constructor that initializes the request method by retrieving it from the server.
     * 
     * This constructor fetches the HTTP request method from the global `$_SERVER` array,
     * allowing the application to determine the type of HTTP request made (GET, POST, etc.).
     */
    public function __construct()
    {
        $this->scriptStartTime = microtime(true);
        $this->requesMethod = $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Gets the HTTP request method.
     * 
     * This method returns the HTTP request method (GET, POST, PUT, DELETE, etc.) that
     * was sent by the client.
     * 
     * @return string The HTTP request method.
     */
    public function getRequestMethod(): string
    {
        return $this->requesMethod;
    }

    /**
     * Sets the response data for the API.
     * 
     * This method accepts the response data (which can be any type) and stores it in the
     * response property. It returns the current instance of the API class to allow for
     * method chaining.
     * 
     * @param mixed $data The response data to be set. This can be any data type, such as an array,
     *                    object, string, etc.
     * 
     * @return API Returns the current instance of the API class for method chaining.
     */
    public function setResponse($data): self
    {
        $this->response = $data;
        return $this;
    }

    /**
     * Sets the HTTP response code for the API response.
     * 
     * This method sets the response code to be returned in the API response. The code is typically
     * an integer representing the HTTP status code (e.g., 200 for success, 404 for not found). 
     * You can use the constants from the `HTTPStatusCodes` class for convenience.
     * 
     * @param int $responseCode The HTTP status code (e.g., 200, 404, 500, etc.).
     * 
     * @return $this The current instance of the API class for method chaining.
     */
    public function setResponseCode(int $responseCode): self
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    /**
     * Sends the API response to the client.
     * 
     * This method sets the appropriate HTTP headers, including the `Content-Type` header
     * for JSON responses, and sets the HTTP response code using the value stored in the 
     * `responseCode` property. It then outputs the response data (stored in the `response` 
     * property) as a JSON-encoded string, ensuring that it is pretty-printed and that Unicode 
     * characters are not escaped. The method then terminates the script execution.
     * 
     * @return void This method does not return a value. It sends the response and exits the script.
     */
    public function send(): void
    {
        header("Content-Type: application/json");
        http_response_code($this->responseCode);

        $this->prepareResponseWrapper();

        echo json_encode($this->finalResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Prepares the response wrapper by wrapping the response with metadata.
     *
     * This method checks if there is any customization for the response wrapper,
     * and if not, it uses the default wrapper. It then processes each item in the 
     * wrapper template, replacing placeholders with actual values.
     *
     * @return self
     */
    protected function prepareResponseWrapper(): self
    {
        $defaultWrapper = [
            "meta" => [
                "response_code" => "{{ response_code }}",
                "host" => "{{ host }}",
                "count" => "{{ count }}",
                "runtime" => "{{ runtime }}"
            ],
            "data" => "{{ data }}"
        ];

        $wrapper = $defaultWrapper;
        if ($this->customWrapper) {
            $wrapper = $this->customWrapper;
        }

        foreach ($wrapper as $key => $wrappedChild) {
            if (is_array($wrappedChild)) {
                foreach ($wrappedChild as $childKey => $child) {
                    $wrapper[$key][$childKey] = $this->parseWrapperTemplate($child);
                }
            } else {
                $wrapper[$key] = $this->parseWrapperTemplate($wrappedChild);
            }
        }

        $this->finalResponse = $wrapper;

        return $this;
    }

    /**
     * Parses the wrapper template and replaces placeholders with actual values.
     *
     * This function replaces placeholders like {{ response_code }}, {{ host }},
     * {{ count }}, and {{ runtime }} with their corresponding values from the 
     * current class context, such as response code, host, count of data, and script runtime.
     *
     * @param mixed $templateItem The template string containing placeholders.
     * @return mixed The parsed string with placeholders replaced by actual values.
     */
    private function parseWrapperTemplate(mixed $templateItem): mixed
    {
        $placeholders = [
            "{{ response_code }}" => $this->responseCode,
            "{{ host }}" => isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https://" : "http://" . $_SERVER["HTTP_HOST"],
            "{{ count }}" => is_array($this->response) || is_object($this->response) ? count($this->response) : 0,
            "{{ runtime }}" => microtime(true) - $this->scriptStartTime,
            "{{ data }}" => $this->response,
        ];

        foreach ($placeholders as $placeholder => $replacement) {
            if (strpos($templateItem, $placeholder) !== false) {
                if (is_string($replacement)) {
                    $templateItem = str_replace($placeholder, $replacement, $templateItem);
                }
                $templateItem = $replacement;
            }
        }

        return $templateItem;
    }

    /**
     * Set the custom wrapper for the response.
     *
     * This method allows setting a custom wrapper structure to modify the 
     * format of the response. The provided array will replace the default 
     * wrapper, offering more flexibility in how the response is structured.
     *
     * @param array $customWrapper The custom wrapper array to set for the response.
     * 
     * @return self The current instance of the class (for method chaining).
     */
    public function setCustomWrapper(array $customWrapper): self
    {
        $this->customWrapper = $customWrapper;
        return $this;
    }
}
