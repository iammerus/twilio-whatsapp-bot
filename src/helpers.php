<?php

use Merus\Bot\Http\Router;

if(!function_exists('array_find')) {
    function array_find($xs, $f) {
        foreach ($xs as $x) {
            if (call_user_func($f, $x) === true) {
                return $x;
            }
        }
        return null;
    }
}


if(!function_exists('route')) {
    function route() {
        return (object)[
            'get' => function(string $path, $action) { Router::define('get', $path, $action); },
            'post' => function(string $path, $action) { Router::define('post', $path, $action); }
        ];
    }
}