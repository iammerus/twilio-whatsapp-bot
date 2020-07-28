<?php

use Merus\WAB\Http\Router;

if(!function_exists('array_find')) {
    /**
     * Find an array element using the given callback
     * 
     * @return mixed|null
     */
    function array_find(array $array, callable $callback) {
        foreach ($array as $item) {
            if (call_user_func($callback, $item) === true) {
                return $item;
            }
        }
        return null;
    }
}


if(!function_exists('route')) {
    /**
     * Helper method for defining routes
     * 
     * @return object
     */
    function route() {
        return (object)[
            'get' => function(string $path, $action) { Router::define('get', $path, $action); },
            'post' => function(string $path, $action) { Router::define('post', $path, $action); }
        ];
    }
}


if(!function_exists('config')) {
    function config($key) {
        // Require in config array
        $config = require_once __DIR__ . '/config.php';

        if(!$key) return $config;


    }
}