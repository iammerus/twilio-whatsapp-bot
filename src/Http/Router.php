<?php

namespace Merus\WAB\Http;

use InvalidArgumentException;

class Router
{
    /**
     * A list of routes defined
     */
    protected static array $routes = [];

    private function __construct()
    {
    }

    /**
     * Define a route
     *
     * @param string $method The HTTP method of this route
     * @param string $path The path of the route
     *
     * @param $action callable Action to execute when
     */
    public static function define(string $method, string $path, callable $action): void
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
     * @return array|null An array with the route information if found, null otherwise
     */
    public static function match(): array
    {
        $path = self::resolvePath();
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        return array_find(self::$routes, function ($route) use ($method, $path) {
            if ($route['path'] === $path && $route['method'] === strtoupper($method)) {
                return true;
            }

            return false;
        });
    }

    /**
     * Resolve the path of the request
     *
     * @return string
     */
    protected static function resolvePath(): string
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $scriptName = $_SERVER['SCRIPT_NAME'];

        $pathName = dirname($scriptName);

        if (strpos($requestUri, $scriptName) === 0) {
            $requestUri = substr($requestUri, strlen($scriptName));
        } else if (strpos($requestUri, $pathName) === 0) {
            $requestUri = substr($requestUri, strlen($pathName));
        }

        if (($requestUri == '/') || empty($requestUri)) {
            return '/';
        }

        $uri = parse_url($requestUri, PHP_URL_PATH);

        return "/" . str_replace(array('//', '../'), '/', ltrim($uri, '/'));
    }

    /**
     * Checks if an action for a route has been added
     *
     * @param string $method The HTTP method of this route
     * @param string $path The path of the route
     *
     * @return bool
     */
    private static function exists(string $method, string $path): bool
    {
        return !!array_find(self::$routes, function ($route) use ($method, $path) {
            if ($route['path'] === $path && $route['method'] === strtoupper($method)) {
                return true;
            }

            return false;
        });
    }

    /**
     * Validate an HTTP method
     *
     * @param string $method The HTTP method of this route
     *
     * @return bool
     */
    private static function validateMethod($method): bool
    {
        // We're only supporting get and post requests in our little router
        return in_array(strtoupper($method), [
            'POST',
            'GET'
        ]);
    }
}