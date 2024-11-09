<?php

namespace devt045t;

/**
 * Class DataTypes
 * 
 * This class provides a list of common data types that can be used for Api parameters or
 * validation purposes. It acts as a central reference for various data types such as 
 * string, integer, boolean, and more.
 * 
 * @package PHP-Api
 * @author t045t
 * @link https://t045t.dev
 * @license MIT
 */
class DataTypes
{
    /**
     * @var string STRING Represents a string data type.
     */
    public const STRING = 'string';

    /**
     * @var string INT Represents an integer data type.
     */
    public const INT = 'int';

    /**
     * @var string BOOL Represents a boolean data type.
     */
    public const BOOL = 'bool';

    /**
     * @var string FLOAT Represents a floating-point number data type.
     */
    public const FLOAT = 'float';

    /**
     * @var string ARRAY Represents an array data type.
     */
    public const ARRAY = 'array';

    /**
     * @var string OBJECT Represents an object data type.
     */
    public const OBJECT = 'object';

    /**
     * @var string DATE Represents a date data type (e.g., in "Y-m-d" format).
     */
    public const DATE = 'date';

    /**
     * @var string DATETIME Represents a datetime data type (e.g., in "Y-m-d H:i:s" format).
     */
    public const DATETIME = 'datetime';

    /**
     * @var string NULL Represents a null data type.
     */
    public const NULL = 'null';

    /**
     * Returns a list of all available data types.
     * 
     * @return array An array containing all the available data types as strings.
     */
    public static function getAllTypes(): array
    {
        return [
            self::STRING,
            self::INT,
            self::BOOL,
            self::FLOAT,
            self::ARRAY,
            self::OBJECT,
            self::DATE,
            self::DATETIME,
            self::NULL
        ];
    }

    /**
     * Checks if a given value is of the specified data type.
     * 
     * @param mixed $value The value to check.
     * @param string $type The data type to compare against.
     * 
     * @return bool Returns true if the value matches the type, false otherwise.
     */
    public static function isType($value, string $type): bool
    {
        switch ($type) {
            case self::STRING:
                return is_string($value);
            case self::INT:
                return is_int($value);
            case self::BOOL:
                return is_bool($value);
            case self::FLOAT:
                return is_float($value);
            case self::ARRAY:
                return is_array($value);
            case self::OBJECT:
                return is_object($value);
            case self::DATE:
                return strtotime($value) !== false;
            case self::DATETIME:
                return strtotime($value) !== false;
            case self::NULL:
                return is_null($value);
            default:
                return false;
        }
    }
}
