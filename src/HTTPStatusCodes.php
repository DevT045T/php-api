<?php

namespace devt045t;

/**
 * Class HTTPStatusCodes
 * 
 * This class defines constants for all standard HTTP status codes. These codes indicate 
 * the result of an HTTP request, from successful responses to client and server errors.
 * 
 * @package PHP-API
 * @author t045t
 * @link https://t045t.dev
 * @license MIT
 */
class HTTPStatusCodes {

    // 1xx: Informational responses

    /**
     * 100 Continue
     * 
     * The server has received the request headers, and the client should proceed to send the request body.
     */
    const CONTINUE = 100;

    /**
     * 101 Switching Protocols
     * 
     * The server is switching protocols as requested by the client.
     */
    const SWITCHING_PROTOCOLS = 101;

    /**
     * 102 Processing (WebDAV)
     * 
     * The server has received and is processing the request, but no response is available yet.
     */
    const PROCESSING = 102;

    // 2xx: Success

    /**
     * 200 OK
     * 
     * The request was successful and the server has returned the requested data.
     */
    const OK = 200;

    /**
     * 201 Created
     * 
     * The request was successful and the server has created a new resource as a result.
     */
    const CREATED = 201;

    /**
     * 202 Accepted
     * 
     * The request has been accepted for processing, but the processing has not been completed.
     */
    const ACCEPTED = 202;

    /**
     * 203 Non-Authoritative Information
     * 
     * The request was successful but the returned metadata may be from a cached copy.
     */
    const NON_AUTHORITATIVE_INFORMATION = 203;

    /**
     * 204 No Content
     * 
     * The request was successful but the server has no data to return.
     */
    const NO_CONTENT = 204;

    /**
     * 205 Reset Content
     * 
     * The server successfully processed the request, but is not returning any content.
     */
    const RESET_CONTENT = 205;

    /**
     * 206 Partial Content
     * 
     * The server is returning a portion of the requested resource due to a range header sent by the client.
     */
    const PARTIAL_CONTENT = 206;

    // 3xx: Redirection

    /**
     * 300 Multiple Choices
     * 
     * There are multiple options for the resource from which the client may choose.
     */
    const MULTIPLE_CHOICES = 300;

    /**
     * 301 Moved Permanently
     * 
     * The resource has permanently moved to a new location, and future requests should be directed there.
     */
    const MOVED_PERMANENTLY = 301;

    /**
     * 302 Found (Previously "Moved Temporarily")
     * 
     * The resource has temporarily moved to a new location.
     */
    const FOUND = 302;

    /**
     * 303 See Other
     * 
     * The response to the request can be found under a different URI using the GET method.
     */
    const SEE_OTHER = 303;

    /**
     * 304 Not Modified
     * 
     * The resource has not been modified since the last request.
     */
    const NOT_MODIFIED = 304;

    /**
     * 305 Use Proxy
     * 
     * The requested resource must be accessed through a proxy.
     */
    const USE_PROXY = 305;

    /**
     * 307 Temporary Redirect
     * 
     * The resource resides temporarily under a different URI, and future requests should use the same URI.
     */
    const TEMPORARY_REDIRECT = 307;

    /**
     * 308 Permanent Redirect
     * 
     * The resource has permanently moved to a new URI, and future requests should be directed there.
     */
    const PERMANENT_REDIRECT = 308;

    // 4xx: Client Errors

    /**
     * 400 Bad Request
     * 
     * The server could not understand the request due to invalid syntax.
     */
    const BAD_REQUEST = 400;

    /**
     * 401 Unauthorized
     * 
     * The client must authenticate itself to get the requested response.
     */
    const UNAUTHORIZED = 401;

    /**
     * 402 Payment Required
     * 
     * Reserved for future use.
     */
    const PAYMENT_REQUIRED = 402;

    /**
     * 403 Forbidden
     * 
     * The server understands the request, but it refuses to authorize it.
     */
    const FORBIDDEN = 403;

    /**
     * 404 Not Found
     * 
     * The server cannot find the requested resource.
     */
    const NOT_FOUND = 404;

    /**
     * 405 Method Not Allowed
     * 
     * The HTTP method used is not allowed for the resource.
     */
    const METHOD_NOT_ALLOWED = 405;

    /**
     * 406 Not Acceptable
     * 
     * The server cannot generate a response that is acceptable according to the Accept headers sent in the request.
     */
    const NOT_ACCEPTABLE = 406;

    /**
     * 407 Proxy Authentication Required
     * 
     * The client must authenticate with a proxy before proceeding.
     */
    const PROXY_AUTHENTICATION_REQUIRED = 407;

    /**
     * 408 Request Timeout
     * 
     * The server timed out waiting for the request.
     */
    const REQUEST_TIMEOUT = 408;

    /**
     * 409 Conflict
     * 
     * The request could not be completed due to a conflict with the current state of the resource.
     */
    const CONFLICT = 409;

    /**
     * 410 Gone
     * 
     * The resource is no longer available and will not be available again.
     */
    const GONE = 410;

    /**
     * 411 Length Required
     * 
     * The server requires the Content-Length header to be set in the request.
     */
    const LENGTH_REQUIRED = 411;

    /**
     * 412 Precondition Failed
     * 
     * One or more conditions in the request headers were not met.
     */
    const PRECONDITION_FAILED = 412;

    /**
     * 413 Payload Too Large
     * 
     * The request is larger than the server is willing or able to process.
     */
    const PAYLOAD_TOO_LARGE = 413;

    /**
     * 414 URI Too Long
     * 
     * The URI provided was too long for the server to process.
     */
    const URI_TOO_LONG = 414;

    /**
     * 415 Unsupported Media Type
     * 
     * The server refuses to accept the request because the media type is not supported.
     */
    const UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * 416 Range Not Satisfiable
     * 
     * The range specified in the request's Range header is invalid.
     */
    const RANGE_NOT_SATISFIABLE = 416;

    /**
     * 417 Expectation Failed
     * 
     * The server cannot meet the requirements of the Expect header.
     */
    const EXPECTATION_FAILED = 417;

    /**
     * 418 I'm a teapot (April Fools' Joke)
     * 
     * The teapot refuses to brew coffee because it is a teapot.
     */
    const IM_A_TEAPOT = 418;

    /**
     * 421 Misdirected Request
     * 
     * The request was directed at a server that is not able to produce a response.
     */
    const MISDIRECTED_REQUEST = 421;

    /**
     * 422 Unprocessable Entity (WebDAV)
     * 
     * The server understands the request but cannot process it due to semantic errors.
     */
    const UNPROCESSABLE_ENTITY = 422;

    /**
     * 423 Locked (WebDAV)
     * 
     * The resource that is being accessed is locked.
     */
    const LOCKED = 423;

    /**
     * 424 Failed Dependency (WebDAV)
     * 
     * The request failed due to failure of a previous request.
     */
    const FAILED_DEPENDENCY = 424;

    /**
     * 425 Too Early
     * 
     * The server is unwilling to risk processing a request that might be replayed.
     */
    const TOO_EARLY = 425;

    /**
     * 426 Upgrade Required
     * 
     * The client should upgrade to a different protocol, such as TLS.
     */
    const UPGRADE_REQUIRED = 426;

    /**
     * 427 Unassigned
     * 
     * Reserved for future use.
     */
    const UNASSIGNED = 427;

    /**
     * 428 Precondition Required
     * 
     * The server requires the request to be conditional.
     */
    const PRECONDITION_REQUIRED = 428;

    /**
     * 429 Too Many Requests
     * 
     * The user has sent too many requests in a given amount of time.
     */
    const TOO_MANY_REQUESTS = 429;

    /**
     * 431 Request Header Fields Too Large
     * 
     * The server is unwilling to process the request because the header fields are too large.
     */
    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;

    /**
     * 451 Unavailable For Legal Reasons
     * 
     * The resource is unavailable due to legal reasons.
     */
    const UNAVAILABLE_FOR_LEGAL_REASONS = 451;

    // 5xx: Server Errors

    /**
     * 500 Internal Server Error
     * 
     * The server encountered an unexpected condition that prevented it from fulfilling the request.
     */
    const INTERNAL_SERVER_ERROR = 500;

    /**
     * 501 Not Implemented
     * 
     * The server does not support the functionality required to fulfill the request.
     */
    const NOT_IMPLEMENTED = 501;

    /**
     * 502 Bad Gateway
     * 
     * The server, while acting as a gateway or proxy, received an invalid response from the upstream server.
     */
    const BAD_GATEWAY = 502;

    /**
     * 503 Service Unavailable
     * 
     * The server is not ready to handle the request, usually due to being overloaded or down for maintenance.
     */
    const SERVICE_UNAVAILABLE = 503;

    /**
     * 504 Gateway Timeout
     * 
     * The server, while acting as a gateway or proxy, did not receive a timely response from the upstream server.
     */
    const GATEWAY_TIMEOUT = 504;

    /**
     * 505 HTTP Version Not Supported
     * 
     * The server does not support the HTTP protocol version that was used in the request.
     */
    const HTTP_VERSION_NOT_SUPPORTED = 505;

    /**
     * 506 Variant Also Negotiates
     * 
     * The server has an internal configuration error and cannot complete the negotiation.
     */
    const VARIANT_ALSO_NEGOTIATES = 506;

    /**
     * 507 Insufficient Storage (WebDAV)
     * 
     * The server is unable to store the representation needed to complete the request.
     */
    const INSUFFICIENT_STORAGE = 507;

    /**
     * 508 Loop Detected (WebDAV)
     * 
     * The server detected an infinite loop while processing the request.
     */
    const LOOP_DETECTED = 508;

    /**
     * 510 Not Extended
     * 
     * Further extensions to the request are required for the server to fulfill it.
     */
    const NOT_EXTENDED = 510;

    /**
     * 511 Network Authentication Required
     * 
     * The client needs to authenticate to gain network access.
     */
    const NETWORK_AUTHENTICATION_REQUIRED = 511;

}
