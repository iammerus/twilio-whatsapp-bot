<?php

namespace Merus\WAB\Http;

use InvalidArgumentException;

class Router
{
    /**
     * A list of routes defined
     */
    protected static array $routes = [];

    private function __construct() {}

    /**
     * Define a route
     *
     * @param string $method The HTTP method of this route
     * @param string $path The path of the route
     *
     * @param $action callable Action to execute when
     */
    public static function define( string $method, string $path, callable $action) : void
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
     * @param string $method The HTTP method of this route
     * @param string $path The path of the route
     *
     * @return array|null An array with the route information if found, null otherwise
     */
    public static function match(string $method, string $path) : array
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
     * @param string $method The HTTP method of this route
     * @param string $path The path of the route
     *
     * @return bool
     */
    private static function exists(string $method, string $path) : bool
    {
        return !!self::match($method, $path);
    }

    /**
     * Validate an HTTP method
     *
     * @param string $method The HTTP method of this route
     *
     * @return bool
     */
    private static function validateMethod($method) : bool
    {
        // We're only supporting get and post requests in our little router
        return in_array(strtoupper($method), [
            'POST',
            'GET'
        ]);
    }
}