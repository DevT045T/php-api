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
}
