<?php

namespace Merus\Bot\Http;

use InvalidArgumentException;

class Router
{
    /**
     * A list of routes defined
     */
    protected static $routes = [];

    private function __construct() {}

    /**
     * Define a route 
     */
    public static function define( string $method, string $path, $action ) 
    {
        if (!$method || !$path || $action) throw new InvalidArgumentException($method, $path, $action);

        if (!self::validateMethod($method)) throw new InvalidArgumentException($method);

        if (!self::exists($path, $method)) throw new InvalidArgumentException("An action for this route has already been defined");

        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'action' => $action
        ];
    }

    /**
     * Find an action for the given method and path
     * 
     * @return array|null
     */
    public static function match(string $method, string $path)
    {
        return array_find(self::$routes, function($route) use ($method, $path) {
            if($route['path'] === $path && $route['method'] === strtoupper($method)) {
                return true;
            }

            return false;
        });
    }

    /**
     * Checks if an action for a route has been added
     * 
     * @return bool
     */
    private static function exists(string $method, string $path) 
    {
        return !!self::match($method, $path);
    }

    /**
     * Validate an HTTP method
     */
    private static function validateMethod($method)
    {
        // We're only supporting get and post requests in our little router
        return in_array(strtoupper($method), [
            'POST',
            'GET'
        ]);
    }
}