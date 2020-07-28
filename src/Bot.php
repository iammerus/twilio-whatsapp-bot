<?php

namespace Merus\WAB;

use Exception;
use Merus\WAB\Database\DB;

class Bot
{
    /**
     * Application's database connection
     *
     * @var DB
     */
    protected $db;

    public function __construct(array $config) {
        $this->bootstrap($config);
    }

    /**
     * Bootstrap the app's services and get's it ready to intercept requests
     *
     * @param array $config
     *
     * @throws Exception When the app fails to connect to the database
     */
    public function bootstrap(array $config)
    {
        if(array_key_exists('database', $config)) return;

        // Create database connection
        $this->database($config['database']);
    }

    /**
     * Handle the incoming request
     */
    public function handle()
    {
        // TODO: Implement
    }

    /**
     *
     * Connect to the app's database
     *
     * @param array $args Database connection settings
     *
     * @throws Exception When we fail to connect to the database
     */
    protected function database(array $args)
    {
        try {
            $this->db = new DB($args);
        } catch (Exception $exception) {
            throw new Exception("Failed to connect to database. Reason: {$exception->getMessage()}");
        }
    }
}