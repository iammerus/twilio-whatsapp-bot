<?php


namespace Merus\WAB\Commands\Defaults;


use Merus\WAB\Commands\CanSendMessages;
use Merus\WAB\Commands\CommandOutput;
use Merus\WAB\Commands\Interfaces\CommandInterface;
use Merus\WAB\Commands\Interfaces\CommandContextInterface;

class FallbackCommand implements CommandInterface
{
    /**
     * @param CommandContextInterface $context
     * @return array
     */
    public function execute(CommandContextInterface $context): array
    {
        return CommandOutput::create(
            $this->getRandomFallbackResponse(),
            COMMAND_EXECUTION_COMPLETE,
            [],
        );
    }

    /**
     * Get a random fallback response
     *
     * @return string
     */
    protected function getRandomFallbackResponse()
    {
        // Collection of responses
        $responses = [
            "Sorry, I don't understand what you mean",
            "I'm sorry, can you please say that some other way?",
            "I'm sorry, can you please rephrase that?"
        ];

        // Pick random array key
        $key = array_rand($responses);

        return $responses[$key];
    }

    /**
     * Get information about the command
     *
     * @return array|string[]
     */
    public static function meta(): array
    {
        return [
            // Key is the unique identifier of the command. Can be anything. Only used internally
            'key' => 'default.fallback',

            // The user friendly name of the command
            'name' => 'Fallback command',

            // User friendly description of the command
            'description' => 'A default fallback for when we fail to match any commands',

            // Pattern to match or array of patterns to match
            'match' => null
        ];
    }
}