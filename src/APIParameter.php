<?php

namespace devt045t;

/**
 * Class APIParameter
 * 
 * This class represents an API parameter that can be used to define the required 
 * attributes for query parameters in HTTP requests, such as GET or POST parameters.
 * It allows you to specify the name of the parameter, whether it is mandatory or optional, 
 * and the expected data type (e.g., string, integer, boolean). The class also provides methods 
 * for setting these attributes and for returning them as structured metadata, which can be 
 * useful for validating and processing API requests.
 * 
 * @package PHP-API
 * @author t045t
 * @link https://t045t.dev
 * @license MIT
 */
class APIParameter
{
    /**
     * This is the key that will be used in the request (GET or POST).
     * 
     * @var string $parameterName The name of the API parameter.
     */
    private string $parameterName;

    /**
     * If set to true, the parameter must be provided; if false, it is optional.
     * 
     * @var bool $required Indicates whether the parameter is mandatory in the API request.
     */
    private bool $required = false;

    /**
     * This could be 'string', 'int', 'bool', or any other data type to validate the parameter's value.
     * 
     * @var string $dataType The expected data type of the parameter.
     */
    private string $dataType;

    /**
     * Returns an associative array containing the metadata for the parameter.
     * This includes the parameter's name, whether it is required, and its expected data type.
     * The metadata is useful for validation, documentation, and debugging purposes.
     * 
     * @return array An array with the following keys: 
     *               'parameter_name', 'is_required', 'data_type'.
     */
    public function returnMeta(): array
    {
        return [
            "parameter_name" => $this->parameterName,
            "is_required" => $this->required,
            "data_type" => $this->dataType,
        ];
    }

    /**
     * Sets the name of the parameter.
     * This name will be used to identify the parameter in requests.
     * 
     * @param string $property The name of the parameter (e.g., 'user_id', 'email').
     * @return self Returns the current instance of the class to allow method chaining.
     */
    public function name(string $property): self
    {
        $this->parameterName = $property;
        return $this;
    }

    /**
     * Sets whether the parameter is required in the API request.
     * If set to true, the parameter must be included in the request.
     * 
     * @param bool $property Set to true if the parameter is required, false if optional.
     * @return self Returns the current instance of the class to allow method chaining.
     */
    public function required(bool $property): self
    {
        $this->required = $property;
        return $this;
    }

    /**
     * Sets the expected data type for the parameter.
     * This can be used to validate the parameter's value (e.g., ensuring that an integer is provided 
     * when the data type is set to 'int').
     * 
     * @param string $property The expected data type (e.g., 'string', 'int', 'boolean').
     * @return self Returns the current instance of the class to allow method chaining.
     */
    public function type(string $property): self
    {
        $this->dataType = $property;
        return $this;
    }
}
