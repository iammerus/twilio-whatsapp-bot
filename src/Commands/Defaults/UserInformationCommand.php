<?php


namespace Merus\WAB\Commands\Defaults;


use Merus\WAB\Commands\Interfaces\CommandContextInterface;
use Merus\WAB\Commands\Interfaces\CommandInterface;

class UserInformationCommand implements CommandInterface
{

    /**
     * @inheritDoc
     */
    public function execute(CommandContextInterface $context)
    {
        $db = $context->getDatabase();
        $input = $context->getUserInput();
        $exec = $context->getExecutionResult();

        $exec->last();
    }

    /**
     * @inheritDoc
     */
    public static function meta(): array
    {
        return [
            // Key is the unique identifier of the command. Can be anything. Only used internally
            'key' => 'default.information',

            // The user friendly name of the command
            'name' => 'User Information Command',

            // User friendly description of the command
            'description' => 'This command is for retrieving the user\'s information (name, etc)',

            // Pattern to match or array of patterns to match
            'match' => null
        ];
    }
}