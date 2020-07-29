<?php

namespace App;

use Merus\WAB\Commands\CanSendMessages;
use Merus\WAB\Commands\Interfaces\CommandContextInterface;
use Merus\WAB\Commands\Interfaces\CommandInterface;

class ExampleCommand implements CommandInterface
{
    use CanSendMessages;

    /**
     * @inheritDoc
     */
    public function execute(CommandContextInterface $context): array
    {
        $this->sendMessage("This is an example message");

        return $this->status(COMMAND_EXECUTION_COMPLETE, []);
    }

    /**
     * @inheritDoc
     */
    public static function meta(): array
    {
        return [
            // Key is the unique identifier of the command. Can be anything. Only used internally
            'key' => 'app.example',

            // The user friendly name of the command
            'name' => 'Fallback command',

            // User friendly description of the command
            'description' => 'An example command',

            // Pattern to match or array of regexp patterns to match
            'match' => 'Yo+'
        ];
    }
}