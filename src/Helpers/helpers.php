<?php

use Merus\WAB\Http\Router;
use Twilio\TwiML\MessagingResponse;


if(!function_exists('array_find')) {
    /**
     * Find an array element using the given callback
     *
     * @param array $array
     * @param callable $callback
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


if(!function_exists('send_message')) {
    /**
     * Send a WhatsApp message to the specified number
     *
     * @param string $body The body of the message
     *
     * @return void
     */
    function send_message($body)
    {
        $response = new MessagingResponse();

        // Print out the TwiML for the response
        $response->message($body);

        echo $response;
    }
}