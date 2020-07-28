<?php


namespace Merus\WAB\Commands;


use Merus\WAB\Commands\Interfaces\CommandContextInterface;

class CommandOutput
{
    /**
     * The command that was being executed
     *
     * @var string
     */
    private string $command;

    /**
     * The output of the command
     *
     * @var string
     */
    private string $output;

    /**
     *
     * @var string
     */
    private string $status;
    private string $meta;
    private string $context;

    private function __construct(string $command, string $output, string $status, string $meta, CommandContextInterface $context)
    {
        $this->command = $command;
        $this->output = $output;
        $this->status = $status;
        $this->meta = $meta;
        $this->context = $context;
    }

    /**
     * Create an instance of the output class
     *
     * @param string $command The command being executed
     * @param string $output The output of the command
     * @param string $status The status of the execution
     * @param string $meta The meta information of the command
     *
     * @param Interfaces\CommandContextInterface $context
     * @return CommandOutput
     */
    public static function create(string $command, string $output, string $status, string $meta, CommandContextInterface $context)
    {
        return new CommandOutput($command, $output, $status, $meta, $context);
    }
}