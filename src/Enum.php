<?php

declare(strict_types=1);

namespace DDDTW\DDD\Common;

use BadMethodCallException;
use ReflectionClass;
use ReflectionException;
use UnexpectedValueException;

/**
 * Class Enum
 *
 * This is just a simple Enum class only has minimum methods for practicing
 *
 * Example:
 *   class OrderStatus extends Enum
 *   {
 *       private const Initial = 0;
 *       private const Processing = 1;
 *   }
 *
 *   OrderStatus::Initial(); // return OrderStatus
 *   $orderStatus->getValue() // return 0
 */
abstract class Enum
{
    protected static $cache = [];
    protected $value;

    /**
     * Enum constructor.
     * @param $value
     * @throws ReflectionException
     */
    public function __construct($value)
    {
        if (!static::isValid($value)) {
            throw new UnexpectedValueException("Value '$value' is not part of the enum " . static::class);
        }

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return Enum
     * @throws ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        if (array_key_exists($name, $array) || isset($array[$name])) {
            return new static($array[$name]);
        }

        throw new BadMethodCallException("No static method or enum constant '$name' in class " . \get_called_class());
    }

    /**
     * @param $value
     * @return bool
     * @throws ReflectionException
     */
    public static function isValid($value)
    {
        return in_array($value, static::toArray(), true);
    }

    /**
     * @return mixed
     * @throws ReflectionException
     */
    public static function toArray()
    {
        $class = static::class;
        if (!isset(static::$cache[$class])) {
            $reflection = new ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }
        return static::$cache[$class];
    }
}