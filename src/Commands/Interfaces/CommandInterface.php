<?php


namespace Merus\WAB\Commands\Interfaces;


interface CommandInterface
{
    /**
     * Execute a command
     *
     * @param CommandContextInterface $context The context of the execution
     *
     * @return mixed
     */
    public function execute(CommandContextInterface $context);

    /**
     * Get meta information about the command
     *
     * @return array
     */
    public static function meta() : array;
}