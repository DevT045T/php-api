<?php

namespace devt045t;

/**
 * Class HttpMethods
 * 
 * This class provides constants for common HTTP request methods, making it easier to refer to 
 * these methods consistently throughout the application. It also includes utility functions 
 * for validation and retrieving all defined HTTP methods.
 * 
 * @package PHP-Api
 * @author t045t
 * @link https://t045t.dev
 * @license MIT
 */
class HttpMethods
{
    /**
     * @var string GET Represents the HTTP GET method.
     */
    public const GET = 'GET';

    /**
     * @var string POST Represents the HTTP POST method.
     */
    public const POST = 'POST';

    /**
     * @var string PUT Represents the HTTP PUT method.
     */
    public const PUT = 'PUT';

    /**
     * @var string DELETE Represents the HTTP DELETE method.
     */
    public const DELETE = 'DELETE';

    /**
     * @var string PATCH Represents the HTTP PATCH method.
     */
    public const PATCH = 'PATCH';

    /**
     * @var string OPTIONS Represents the HTTP OPTIONS method.
     */
    public const OPTIONS = 'OPTIONS';

    /**
     * @var string HEAD Represents the HTTP HEAD method.
     */
    public const HEAD = 'HEAD';

    /**
     * @var string TRACE Represents the HTTP TRACE method.
     */
    public const TRACE = 'TRACE';

    /**
     * @var string CONNECT Represents the HTTP CONNECT method.
     */
    public const CONNECT = 'CONNECT';

    /**
     * Returns a list of all available HTTP methods.
     * 
     * @return array An array containing all the HTTP request methods as strings.
     */
    public static function getAllMethods(): array
    {
        return [
            self::GET,
            self::POST,
            self::PUT,
            self::DELETE,
            self::PATCH,
            self::OPTIONS,
            self::HEAD,
            self::TRACE,
            self::CONNECT
        ];
    }

    /**
     * Checks if a given method is a valid HTTP request method.
     * 
     * @param string $method The HTTP method to check.
     * 
     * @return bool Returns true if the method is valid, false otherwise.
     */
    public static function isValidMethod(string $method): bool
    {
        return in_array($method, self::getAllMethods(), true);
    }
}
