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
     * The response that the API returns to the user
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
     * Constructor that initializes the request method by retrieving it from the server.
     * 
     * This constructor fetches the HTTP request method from the global `$_SERVER` array,
     * allowing the application to determine the type of HTTP request made (GET, POST, etc.).
     */
    public function __construct()
    {
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
    public function setResponse($data): API
    {
        $this->response = $data;
        return $this;
    }

    /**
     * Sets the response code for the API response.
     * 
     * This method accepts an integer representing the HTTP response code (e.g., 200 for success, 
     * 404 for not found) and stores it in the `responseCode` property. It returns the current 
     * instance of the API class to enable method chaining.
     * 
     * @param int $responseCode The HTTP response code to be set (e.g., 200, 404, 500, etc.).
     * 
     * @return API Returns the current instance of the API class for method chaining.
     */
    public function setResponseCode(int $responseCode): API
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
    public function send()
    {
        header("Content-Type: application/json");
        http_response_code($this->responseCode);
        echo json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
