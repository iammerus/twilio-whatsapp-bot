<?php


namespace Merus\WAB\Helpers;


class Log {
    private string $filename = ROOT_PATH . '/error.log';
    private $handle = null;


    protected static ?Log $instance = null;


    /**
     * Get an instance of the logger
     * @return Log
     */
    public static function get()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        $this->logOpen();
    }

    function __destruct() {
        fclose($this->handle);
    }

    private function logOpen(){
        $this->handle = fopen($this->filename, 'a') or exit("Can't open " . $this);
    }

    public function logWrite($message){
        $time = date('H:i:s -');
        fwrite($this->handle, $time . " " . $message . "\n");
    }

    //Clear Logfile
    public function logClear(){
        ftruncate($this->handle, 0);
    }
}