<?php


namespace Merus\WAB\Commands;


use Merus\WAB\Commands\Interfaces\CommandContextInterface;

class CommandOutput
{
    private function __construct()
    {
    }

    /**
     * Create an output
     *
     * @param string $output The output of the command
     * @param string $status The status of the execution
     * @param array $meta The meta information of the command
     *
     * @return array
     */
    public static function create(string $output, string $status, array $meta)
    {
        send_message($output);

        return [
            'result' => $status,
            'meta' => $meta
        ];
    }
}