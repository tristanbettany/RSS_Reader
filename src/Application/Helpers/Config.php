<?php

namespace RSSReader\Application\Helpers;

/**
 * App Config Class
 */
final class Config
{
    /** @var array */
    private static $config;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        static::$config = $config;
    }

    /**
     * Get the app config
     *
     * @param $offset
     *
     * @return array
     */
    public static function get($offset = null)
    {
        if ($offset === null) {
            return static::$config;
        }

        if (isset(static::$config[$offset]) === false) {
            return static::$config;
        }

        return static::$config[$offset];
    }
}