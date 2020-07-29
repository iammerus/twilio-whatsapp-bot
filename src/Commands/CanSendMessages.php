<?php


namespace Merus\WAB\Commands;


trait CanSendMessages
{
    public function sendMessage(string $body)
    {
        return send_message($body);
    }
}