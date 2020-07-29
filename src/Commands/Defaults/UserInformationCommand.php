<?php


namespace Merus\WAB\Commands\Defaults;


use Merus\WAB\Commands\CanSendMessages;
use Merus\WAB\Commands\Interfaces\CommandContextInterface;
use Merus\WAB\Commands\Interfaces\CommandInterface;
use Merus\WAB\Commands\User;

class UserInformationCommand implements CommandInterface
{
    use CanSendMessages;

    /**
     * @inheritDoc
     */
    public function execute(CommandContextInterface $context): array
    {
        $exec = $context->getExecutionResult();

        $user = $context->getUser();
        $result = $exec->last($user);

        if ($result && $result->command === 'default.information') {
            $this->update($user, $context);

            return $this->success($user->getName());
        }

        // Ask the user for their name
        $this->ask();

        // Return meta information for the registrar to save
        return $this->status(COMMAND_EXECUTION_INCOMPLETE, []);
    }

    /**
     * Ask the user for their name
     */
    protected function ask()
    {
        $responses = [
            "Hi there! To get started, can you please tell me your name?",
            "It looks like this is your first time texting me. Can you please tell me your name?",
            "Hmm. I haven't seen you before. Could you please tell me your name?"
        ];

        $key = array_rand($responses);

        $this->sendMessage($responses[$key]);
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

    protected function update(User $user, CommandContextInterface $context)
    {
        $user->setName($context->getUserInput());

        $user->update($context->getDatabase());
    }

    /**
     * When the command has been executed successfully to completion
     *
     * @param string|null $name
     * @return array
     */
    protected function success(?string $name)
    {
        $responses = [
            "Awesome! I'll call you {$name} from now on",
            "Got it, {$name}. I'll remember your name",
            "Okay, {$name}. I'll make sure to remember your name"
        ];

        $key = array_rand($responses);

        $this->sendMessage($responses[$key] . ". To see what I can do, just send the message hello");

        return $this->status(COMMAND_EXECUTION_COMPLETE, []);
    }
}