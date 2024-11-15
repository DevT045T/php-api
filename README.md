# PHP-Api

## Description

This is a lightweight and extendable **PHP-Api Framework** designed to help developers quickly build RESTful APIs. It provides easy management of API parameters (GET, POST) with support for defining allowed parameters, their required status, and data types. It also allows for flexible response formatting, making it easy to create custom APIs.

This framework can be easily integrated into any PHP project using Composer.

## Features

- **Standardized API Parameter Handling**: Easily manage allowed API parameters, including data types and required status.
- **Flexible Parameter Validation**: Validate that only expected parameters are included, check for required parameters, and validate parameter data types.
- **Custom Response Wrapper**: Define a custom response structure using a flexible wrapper.
- **Flexible HTTP Method Support**: Supports GET, POST, PUT, DELETE HTTP methods.
- **Meta Data**: The response includes metadata such as response code, server host, number of results, and script execution time.
- **Data Type Management**: Support for defining and managing data types for each parameter.

## Installation via Composer

To use the **PHP-Api Framework** in your project, follow these steps:

### 1. Install Composer

Ensure that [Composer](https://getcomposer.org/) is installed on your system. If it's not installed yet, you can install it using the following command:

```bash
curl -sS https://getcomposer.org/installer | php
```

### 2. Add the Framework to Your Project

To install the framework from GitHub, specify the `develop` branch. You can do this by running the following command:

```bash
composer require devt045t/php-api:develop
```

Alternatively, if the package is not listed on Packagist, you can add the GitHub repository manually in your `composer.json` under the `"repositories"` section:

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/DevT045T/php-api.git"
        }
    ],
    "require": {
        "devt045t/php-api": "develop"
    }
}
```

Then run:

```bash
composer install
```

This will install the framework from the `develop` branch and download all necessary files.

### 3. Enable Autoloading

Ensure that Composer's autoloader is included in your project. Add this line at the beginning of your PHP file:

```php
require 'vendor/autoload.php';
```

### 4. Use the Framework

You can now use the framework in your project. For more information on how to use it, refer to the [Usage](#Usage) section of this documentation.

## Usage

### Example: Define Allowed Parameters and Handle API Request

```php
use devt045t\Api;
use devt045t\ApiParameter;
use devt045t\DataTypes;
use devt045t\HttpStatusCodes;
use devt045t\HttpMethods;

$api = new Api();

// Define allowed parameters
$param1 = new ApiParameter();
$param1
  ->name('username')
  ->required(true)
  ->type(DataTypes::STRING);

$param2 = new ApiParameter();
$param2
  ->name('password')
  ->required(true)
  ->type(DataTypes::INT);

// Add parameters to API instance
$api
  ->addParameter($param1)
  ->addParameter($param2);

// Set the allowed request methods
$api->setAllowedRequestMethod([HttpMethods::OPTIONS, HttpMethods::POST]);

// Validate parameters
$api->validate();

// Set the response data
$api->setResponse(['message' => 'Parameters received successfully']);

// Set the custom response code (optional)
$api->setResponseCode(HttpStatusCodes::OK);

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
    "message": "Parameters received successfully"
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
$api->setResponse(['message' => 'Parameters received successfully']);
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
    "message": "Parameters received successfully"
  }
}
```

## Available Methods

- **Parameter Management**:
  - `addParameter(ApiParameter $parameter)`: Adds an allowed API parameter to the API instance, defining its name, required status, and data type.
  - `getAllParameters()`: Returns all given GET and POST parameters as an array.
  - `getGETParameters()`: Returns all given GET parameters as an array.
  - `getPOSTParameters()`: Returns all given POST parameters as an array.

- **Validation**:
  - `validate()`: Validates that all required data is correct and in the expected format. It checks:
    - If only allowed parameters are present.
    - If all required parameters are provided.
    - If parameter data types match the expected types.
  - `sendErrorResponse(int $responseCode, string $errorMessage, array $errorDetails = [])`: Sends an error response if validation fails, with the status code, error message, and details of the error.

- **Response Management**:
  - `setResponse($data)`: Sets the response data. The data can be any type (array, object, string, etc.).
  - `setResponseCode(int $code)`: Sets the HTTP response code. Defaults to `200`.
  - `send()`: Sends the response to the client. Automatically formats the response in JSON.
  - `setCustomWrapper(array $wrapper)`: Sets a custom wrapper for the response. If no custom wrapper is provided, the default one is used.
  - `prepareResponseWrapper()`: Prepares the response based on the current wrapper settings.

- **Request Information**:
  - `getRequestMethod()`: Returns the HTTP request method (GET, POST, PUT, DELETE).
  - `__get(string $property)`: ✨Magic✨ getter method for accessing properties dynamically through the `$parameters` array. Returns the property’s value or null if not found.

## API Parameter Management

The `ApiParameter` class helps you define the parameters for your API. Each parameter can be configured with the following properties:

- **Name**: The name of the parameter (e.g., `username`, `age`).
- **Required**: Whether the parameter is required for the request. Default is `false`.
- **Data Type**: The data type for the parameter (e.g., `string`, `integer`, `boolean`).

### Example of `ApiParameter`:

```php
use devt045t\ApiParameter;
use devt045t\DataTypes;

$param = new ApiParameter();
$param->name('username')->required(true)->type(DataTypes::STRING);
```

### Supported Data Types

- The framework provides data type validation using `DataTypes::isType($value, $dataType)`, ensuring that each parameter's value matches its defined type.

## Configuration Options

- **Custom Wrapper**: Allows you to define the format of the API response (metadata, count, host, runtime, etc.). This is ideal for adjusting the structure of the response to match your front-end or external service requirements.

Example of custom wrapper placeholders:
- `{{ response_code }}`
- `{{ host }}`
- `{{ count }}`
- `{{ runtime }}`
- `{{ data }}`

You can use these placeholders to customize the structure of the API response.

## License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

### Contributing

Feel free to fork this project, make improvements, and submit pull requests. Contributions are always welcome!

---