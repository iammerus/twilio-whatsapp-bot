<?php


namespace Merus\WAB\Commands\Defaults;


use Merus\WAB\Commands\CanSendMessages;
use Merus\WAB\Commands\Interfaces\CommandContextInterface;

class SessionExpiryCommand implements \Merus\WAB\Commands\Interfaces\CommandInterface
{
    use CanSendMessages;

    /**
     * @inheritDoc
     */
    public function execute(CommandContextInterface $context): array
    {
        $responses = [
            "Welp! It looks like your session expired due to inactivity since your last message. Send hello to start a new one",
            "Unfortunately, it appears as if your session expired due to inactivity since your last message. Send hello to start a new one"        ];

        $this->sendMessage($this->randomElement($responses));

        return $this->status(COMMAND_EXECUTION_COMPLETE, []);
    }

    /**
     * @inheritDoc
     */
    public static function meta(): array
    {
        return [
            // Key is the unique identifier of the command. Can be anything. Only used internally
            'key' => 'default.expired',

            // The user friendly name of the command
            'name' => 'Fallback command',

            // User friendly description of the command
            'description' => 'Command sends ',

            // Pattern to match or array of patterns to match
            'match' => null
        ];
    }
}