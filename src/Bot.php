<?php

namespace Merus\WAB;

use Exception;
use Merus\WAB\Commands\Registrar;
use Merus\WAB\Database\DB;
use Merus\WAB\Http\Router;
use Merus\WAB\Http\TwilioRequest;

class Bot
{
    /**
     * Application's database connection
     *
     * @var DB
     */
    protected DB $db;

    /**
     * @var Registrar
     */
    protected Registrar $registrar;

    /**
     * Bot constructor.
     *
     * @param array $config Key value pairs of configuration values
     *
     * @throws Exception
     */
    public function __construct(array $config)
    {
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
        if (!array_key_exists('database', $config)) return;

        // Create database connection
        $this->database($config['database']);

        // Register commands
        $this->registrar();

        // Register application routes
        $this->router();
    }

    /**
     * Handle the incoming request
     */
    public function handle()
    {
        $route = Router::match();
        $action = (is_array($route) && array_key_exists('action', $route)) ? $route['action'] : null;

        if (!$route || !$action || (!is_callable($action) && !is_array($action))) {
            echo 'Not found!';

            http_response_code(404);

            $this->exit();
        }

        // Execute the action
        call_user_func($action);

        // Close the application
        $this->exit();
    }

    protected function exit()
    {
        // Close the PDO connection
        $this->db->closeConnection();
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

    /**
     * Initiates the commands registrar and registers the commands
     *
     * @return void
     */
    protected function registrar() : void
    {
        // Instantiate the command registrar
        $this->registrar = new Registrar($this->db);

        // Register commands
        $this->registrar->register();
    }

    /**
     * Registers the application routes and
     */
    protected function router()
    {
        // Incoming message handler callback
        Router::define('post', '/incoming', [$this, 'incoming']);

        // Handler callback for status updates
        Router::define('post', '/status', [$this, 'updates']);
    }

    public function updates()
    {

    }

    /**
     * Handles incoming messages
     *
     * @return void
     */
    public function incoming()
    {
        $request = new TwilioRequest(
            $_POST['MessageSid'],
            $_POST['AccountSid'],
            $_POST['MessagingServiceSid'],
            $_POST['From'],
            $_POST['To'],
            $_POST['Body']
        );

        $this->registrar->request($request);
    }
}