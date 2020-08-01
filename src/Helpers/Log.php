<?php


namespace Merus\WAB\Helpers;


class Log
{
    private string $filename = ROOT_PATH . '/error.log';
    private string $statusFilename = ROOT_PATH . '/status.log';

    private $handle = null;
    private $statusHandle = null;


    protected static ?Log $instance = null;


    /**
     * Get an instance of the logger
     * @return Log
     */
    public static function get()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->logOpen();
    }

    function __destruct()
    {
        fclose($this->handle);
    }

    private function logOpen()
    {
        $this->handle = fopen($this->filename, 'a') or exit("Can't open " . $this);
        $this->statusHandle = fopen($this->statusFilename, 'a') or exit("Can't open " . $this);
    }

    public function logWrite($message, $error = true)
    {
        $time = date('H:i:s -');

        fwrite($error ? $this->handle : $this->statusHandle, $time . " " . $message . "\n");
    }

    //Clear Logfile
    public function logClear()
    {
        ftruncate($this->handle, 0);
    }
}