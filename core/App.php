<?php

namespace Core;

/**
 * This class is a container of the application's tools.
 *
 * Variant of App class from Laracast:
 * https://github.com/laracasts/The-PHP-Practitioner-Full-Source-Code/blob/master/core/App.php
 */
class App
{
    /**
     * All registered keys.
     *
     * @var array
     */
    protected static $registry = [];



    /**
     * Bind a new key/value into the container.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }



    /**
     * Check if the given key is in the registry.
     *
     * @param  string $key
     * @return boolean
     */
    public static function has($key)
    {
        return array_key_exists($key, static::$registry);
    }



    /**
     * Retrieve a value from the registry.
     *
     * @param  string $key
     * @return void
     */
    public static function get($key)
    {
        if (! self::has($key)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }
}
