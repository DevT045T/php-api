# PHP-API

## Description

This is a lightweight and extendable **PHP-API Framework** designed to help developers quickly build RESTful APIs. It provides easy management of API parameters (GET, POST) with support for defining allowed parameters, their required status, and data types. It also allows for flexible response formatting, making it easy to create custom APIs.

This framework can be easily integrated into any PHP project using Composer.

## Features

- **Standardized API Parameter Handling**: Easily manage allowed API parameters, including data types and required status.
- **Custom Response Wrapper**: Define a custom response structure using a flexible wrapper.
- **Flexible HTTP Method Support**: Supports GET, POST, PUT, DELETE HTTP methods.
- **Meta Data**: The response includes metadata such as response code, server host, number of results, and script execution time.
- **Data Type Management**: Support for defining and managing data types for each parameter.

## Usage

Here is how you can use the `API` class along with `APIParameter` in your project.

### Example: Define Allowed Parameters and Handle API Request

```php
use devt045t\API;
use devt045t\APIParameter;
use devt045t\DataTypes;
use devt045t\HTTPStatusCodes;

$api = new API();

// Define allowed parameters
$param1 = new APIParameter();
$param1
  ->setName('username')
  ->required(true)
  ->type(DataTypes::STRING);

$param2 = new APIParameter();
$param2
  ->setName('password')
  ->required(true)
  ->type(DataTypes::INT);

// Add parameters to API instance
$api
  ->addParameter($param1)
  ->addParameter($param2);

// Retrieve all parameters
$parameters = $api->getAllParameters();

// Set the response data
$api->setResponse(['message' => 'Parameters received successfully']);

// Set the custom response code (optional)
$api->setResponseCode(HTTPStatusCodes::OK);

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

### Available Methods

- `setResponse($data)`: Sets the response data. The data can be any type (array, object, string, etc.).
- `setResponseCode(int $code)`: Sets the HTTP response code. Defaults to `200`.
- `send()`: Sends the response to the client. Automatically formats the response in JSON.
- `setCustomWrapper(array $wrapper)`: Sets a custom wrapper for the response. If no custom wrapper is provided, the default one is used.
- `getRequestMethod()`: Returns the HTTP request method (GET, POST, PUT, DELETE).
- `prepareResponseWrapper()`: Prepares the response based on the current wrapper settings.
- `getAllParameters()`: Returns all given GET and POST parameters as an array.
- `getGETParameters()`: Returns all given GET parameters as an array.
- `getPOSTParameters()`: Returns all given POST parameters as an array.
- `__get(string $property)`: ✨Magic✨ getter method for accessing properties dynamically through the `$parameters` array. Returns the property’s value or null if not found.
- `addParameter(APIParameter $parameter)`: Adds an allowed API parameter to the API instance. This defines the name, required status, and data type of the parameter.

## API Parameter Management

The `APIParameter` class helps you define the parameters for your API. Each parameter can be configured with the following properties:

- **Name**: The name of the parameter (e.g., `username`, `age`).
- **Required**: Whether the parameter is required for the request. Default is `false`.
- **Data Type**: The data type for the parameter (e.g., `string`, `integer`, `boolean`).

### Example of `APIParameter`:

```php
use devt045t\APIParameter;

$param = new APIParameter();
$param->setName('username')->required(true)->type('string');
```

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