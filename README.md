# PHP-API

## Description

This is a lightweight and extendable **PHP-API Framework** designed to help developers quickly build RESTful APIs. It supports common HTTP methods (GET, POST, PUT, DELETE) and provides a standardized JSON response structure. You can also customize the framework’s response wrapper to meet your specific needs.

This framework can be easily integrated into any PHP project using Composer.

## Features

- **Standardized JSON Response**: All responses are returned in JSON format.
- **Custom Response Wrapper**: Allows you to define a custom response structure using a flexible wrapper.
- **Easy API Integration**: Very easy to use and integrate into any PHP project.
- **Flexible HTTP Method Support**: Supports GET, POST, PUT, DELETE HTTP methods.
- **Meta Data**: The response includes metadata such as response code, server host, number of results, and script execution time.

## Installation

### 1. Install via Composer

Add the PHP-API Framework as a Composer dependency in your project. If you don't have a `composer.json` file yet, you can create one by running the following command:

```bash
composer init
```

Then, add the framework to your project:

```bash
composer require devt045t/php-api
```

This will download the package and install it in your `vendor/` directory.

### 2. Include Composer's Autoloader

Once installed, include Composer’s autoloader at the beginning of your PHP script:

```php
require 'vendor/autoload.php';
```

This ensures that the PHP-API framework is properly loaded and available for use.

---

## Usage

Here is how you can use the `API` class in your project.

### Example: Simple API Request

```php
use devt045t\API;

$api = new API();

// Set the response data
$api->setResponse(['message' => 'Hello, World!']);

// Set the custom response code (optional)
$api->setResponseCode(200);

// Send the response
$api->send();
```

### Example: Custom Response Wrapper

The default response wrapper looks like this:

```json
{
  "meta": {
    "response_code": 200,
    "host": "http://example.com",
    "count": 1,
    "runtime": 0.02
  },
  "data": {
    "message": "Hello, World!"
  }
}
```

You can modify the structure of the response wrapper by setting a custom wrapper:

```php
$customWrapper = [
    "status" => "{{ response_code }}",
    "details" => [
        "host" => "{{ host }}",
        "total_count" => "{{ count }}",
        "execution_time" => "{{ runtime }}"
    ],
    "content" => "{{ data }}"
];

$api->setCustomWrapper($customWrapper);
$api->setResponse(['message' => 'Hello, World!']);
$api->send();
```

The response will be wrapped in the custom format:

```json
{
  "status": 200,
  "details": {
    "host": "http://example.com",
    "total_count": 1,
    "execution_time": 0.02
  },
  "content": {
    "message": "Hello, World!"
  }
}
```

### Available Methods

- `setResponse($data)`: Sets the response data. The data can be any type (array, object, string, etc.).
- `setResponseCode(int $code)`: Sets the HTTP response code. Defaults to `200`.
- `send()`: Sends the response to the client. Automatically formats the response in JSON.
- `setCustomWrapper(array $wrapper)`: Sets a custom wrapper for the response. If no custom wrapper is provided, the default one is used.
- `getRequestMethod()`: Returns the HTTP request method (GET, POST, PUT, DELETE).
- `prepareResponseWrapper()`: Prepares the response based on the current wrapper settings.

## Configuration Options

- **Custom Wrapper**: Allows you to define the format of the API response (metadata, count, host, runtime, etc.). This is ideal for adjusting the structure of the response to match your front-end or external service requirements.

Example of custom wrapper placeholders:
- `{{ response_code }}`
- `{{ host }}`
- `{{ count }}`
- `{{ runtime }}`
- `{{ data }}`

You can use these placeholders to customize the structure of the API response.

---

## License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

### Contributing

Feel free to fork this project, make improvements, and submit pull requests. Contributions are always welcome!

---
