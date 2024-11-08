<?php

namespace devt045t;

/**
 * Class API
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
    public string $requestMethod;

    /**
     * The allowed HTTP request methods (e.g., GET, POST, PUT, DELETE).
     * 
     * @var array
     */
    private array $allowedRequestMethods;

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
     * An array to store GET and POST parameters.
     *
     * This private property holds all the parameters from the GET and POST requests.
     * It is used internally to manage incoming data for processing.
     * 
     * @var array An array that contains both GET and POST parameters.
     */
    private array $parameters = [];

    /**
     * An array to store all GET parameters.
     *
     * This private property holds all the GET parameters from the requests.
     * It is used internally to manage incoming data for processing.
     * 
     * @var array An array that contains GET parameters.
     */
    private array $GETParameters = [];

    /**
     * An array to store all POST parameters.
     *
     * This private property holds all the POST parameters from the requests.
     * It is used internally to manage incoming data for processing.
     * 
     * @var array An array that contains POST parameters.
     */
    private array $POSTParameters = [];

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
     * This property holds an array of `APIParameter` objects that define the allowed
     * parameters for the API request. Each `APIParameter` object includes information
     * such as the parameter name, whether it is required, and its expected data type.
     * 
     * @var APIParameter[] An array of allowed API parameters.
     */
    private array $allowedParameters = [];

    /**
     * The error message that will be included in the error response.
     * This message provides a brief description of the error encountered.
     * 
     * @var string Default is a empty message
     */
    private string $errorMessage;

    /**
     * The additional details related to the error.
     * This attribute may include further information, such as specific validation errors
     * or any relevant data that can help the user or developer understand the cause
     * of the error more clearly.
     * 
     * @var mixed
     */
    private mixed $errorDetails;

    /**
     * Constructor that initializes the request method by retrieving it from the server.
     * 
     * This constructor fetches the HTTP request method from the global `$_SERVER` array,
     * allowing the application to determine the type of HTTP request made (GET, POST, etc.).
     */
    public function __construct()
    {
        $this->parameters = [...$_POST, ...$_GET];
        $this->GETParameters = $_GET;
        $this->POSTParameters = [...(array)json_decode(file_get_contents('php://input')), ...$_POST];

        $this->errorDetails = [];
        $this->errorMessage = "";

        $this->scriptStartTime = microtime(true);
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
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
        return $this->requestMethod;
    }

    /**
     * Sets the allowed request methods for the API.
     * 
     * This method allows you to define which HTTP request methods (e.g., GET, POST, PUT, DELETE) 
     * are allowed for the current API endpoint. By passing an array, you can allow multiple 
     * request methods for a single endpoint. This is useful for defining flexible API behavior 
     * where more than one HTTP method can be used for the same resource.
     * 
     * @param array $requestMethods An array of allowed HTTP request methods (e.g., ['GET', 'POST', 'PUT']).
     * 
     * @return self Returns the current instance for method chaining.
     */
    public function setAllowedRequestMethod(array $requestMethods): self
    {
        $this->allowedRequestMethods = $requestMethods;
        return $this;
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

    /**
     * Retrieves all GET and POST parameters.
     *
     * This method returns an array containing all parameters from the GET and POST
     * requests. It provides access to the stored parameters for further processing
     * or validation.
     *
     * @return array An array containing all GET and POST parameters.
     */
    public function getAllParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Retrieves all GET parameters.
     *
     * This method returns an array containing all parameters from the GET requests.
     * It provides access to the stored parameters for further processing
     * or validation.
     *
     * @return array An array containing all GET parameters.
     */
    public function getGETParameters(): array
    {
        return $this->GETParameters;
    }

    /**
     * Retrieves all POST parameters.
     *
     * This method returns an array containing all parameters from the POST requests.
     * It provides access to the stored parameters for further processing
     * or validation.
     *
     * @return array An array containing all POST parameters.
     */
    public function getPOSTParameters(): array
    {
        return $this->POSTParameters;
    }

    /**
     * ✨Magic✨ getter method for accessing private or protected properties dynamically.
     *
     * This method allows reading properties in a controlled way by retrieving
     * values from the `$parameters` array. It checks if a property exists in
     * the `$parameters` array and returns its value if present.
     *
     * @param string $property The name of the property being accessed.
     * @return mixed The value of the specified property, or null if it does not exist.
     */
    public function __get(string $property): mixed
    {
        return $this->parameters["$property"];
    }

    /**
     * Adds an allowed parameter to the list of allowed API parameters.
     * 
     * This method accepts an `APIParameter` object, which defines the name, 
     * required status, and data type of a parameter. It adds this parameter 
     * to the `allowedParameters` array, which is later used to validate incoming
     * API requests.
     * 
     * @param APIParameter $parameter The `APIParameter` object to add.
     * 
     * @return self Returns the current instance of the class, allowing for method chaining.
     */
    public function addParameter(APIParameter $parameter): self
    {
        $this->allowedParameters[] = $parameter;
        return $this;
    }

    /**
     * Validates the request method against the allowed methods.
     * 
     * This method checks if the current request method is one of the allowed methods defined for
     * the API endpoint. If the request method is not allowed, an error response will be sent
     * with a 400 Bad Request status code.
     * 
     * @return void
     */
    public function validate(): void
    {
        if (!in_array($this->requestMethod, $this->allowedRequestMethods)) {
            $this->sendErrorResponse(HTTPStatusCodes::BAD_REQUEST, "The request method is not allowed for this resource.", [$this->requestMethod]);
        }
    }

    /**
     * Sends an error response with the given status code and error message.
     * 
     * This method prepares an error response with the specified HTTP status code and error message.
     * It then sends the response to the client.
     * 
     * @param int $responseCode The HTTP status code for the error response.
     * @param string $errorMessage The error message to be included in the response.
     * @param mixed $errorDetails Default is an empty array. The error details to describe the error in detail.
     * 
     * @return void
     */
    public function sendErrorResponse(int $responseCode, string $errorMessage, mixed $errorDetails = []): void
    {
        $this->response = null;
        $this->responseCode = $responseCode;

        $this->response = [
            "error_message" => $errorMessage,
            "error_details" => $errorDetails
        ];

        $this->send();
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
            "data" => "{{ data }}",
        ];

        $wrapper = $defaultWrapper;
        if (isset($this->customWrapper)) {
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
            /**
             * @TODO => Fix in future, it makes me cry 😭
             * Errors will be part in data for now :c
             */
            // "{{ error_details }}" => $this->errorDetails,
            // "{{ error_message }}" => $this->errorMessage,
            "{{ runtime }}" => microtime(true) - $this->scriptStartTime,
            "{{ data }}" => $this->response,
        ];

        if (!is_string($templateItem)) {
            return $templateItem;
        }

        foreach ($placeholders as $placeholder => $replacement) {
            if (is_null($placeholder)) {
                return $templateItem;
            }
            if (strpos($templateItem, $placeholder) !== false) {
                if (is_string($replacement)) {
                    $templateItem = str_replace($placeholder, $replacement, $templateItem);
                }
                $templateItem = $replacement;
            }
        }

        return $templateItem;
    }
}
