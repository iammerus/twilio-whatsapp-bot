<?php


namespace Merus\WAB\Commands\Interfaces;


use Merus\WAB\Database\DB;
use Merus\WAB\ExecutionResult;

interface CommandContextInterface
{
    /**
     * Get the user's input text
     *
     * @return string
     */
    public function getUserInput(): string;

    /**
     * Get the app's database connection
     *
     * @return DB
     */
    public function getDatabase(): DB;

    /**
     * Get the last execution result. Can be null
     *
     * @return ExecutionResult
     */
    public function getExecutionResult(): ExecutionResult;
}