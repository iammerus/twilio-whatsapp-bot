<?php


namespace Merus\WAB\Commands;


trait CanSendMessages
{
    public function sendMessage(string $body)
    {
        return send_message($body);
    }

    public function randomElement(array &$array)
    {
        if(count($array) === 0) {
            return null;
        }

        return $array[array_rand($array)];
    }

    /**
     * Helper method for sending status update to registrar
     *
     * @param string $status The status of execution
     * @param array $meta The meta information about the execution
     *
     * @return array
     */
    public function status(string $status, array $meta)
    {
        return [
            'result' => $status,
            'meta' => $meta
        ];
    }
}