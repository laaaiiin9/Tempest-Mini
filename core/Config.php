<?php

class Config
{

    protected static array $configs = [];

    public static function set($key, $config = [])
    {
        self::$configs[$key] = $config;
    }

    public static function get(string $key, $default = null)
    {
        $keys = explode('.', $key);

        $value = self::$configs;

        foreach ($keys as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }

    public static function getAll()
    {
        return self::$configs;
    }
}
