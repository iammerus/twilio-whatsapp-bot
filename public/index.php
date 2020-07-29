<?php

use Merus\WAB\Bot;

// Define path constants
define('ROOT_PATH', dirname(__DIR__));
define('APP_ROOT', ROOT_PATH . '/src');

require_once APP_ROOT . '/Helpers/constants.php';

// Require in composer autoloader
require_once ROOT_PATH . '/vendor/autoload.php';

// Load configuration file
$config = require_once APP_ROOT . '/Helpers/config.php';

try {
    // Instantiate the bot handler app
    $bot = new Bot($config);

    // Handle the incoming request
    $bot->handle();
} catch (\Exception $e) {
    send_message("Yikes! Something wen't wrong in the application. This error has been logged and the developers notified");

    $log = new \Merus\WAB\Helpers\Log();

    $log->logWrite($e->getMessage());
}