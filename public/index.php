<?php

use Merus\WAB\Bot;

// Define path constants
define('ROOT_PATH', dirname(__DIR__));
define('APP_ROOT', ROOT_PATH . '/src');

// Require in composer autoloader
require_once ROOT_PATH . '/vendor/autoload.php';

// Load configuration file
$config = require_once APP_ROOT . '/config.php';

// Instantiate the bot handler app
$bot = new Bot($config);

// Handle the incoming request
$bot->handle();