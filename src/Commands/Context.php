<?php


namespace Merus\WAB\Commands;


use Merus\WAB\Database\DB;
use Merus\WAB\ExecutionResult;

class Context implements Interfaces\CommandContextInterface
{
    /**
     * Database connection
     *
     * @var DB
     */
    private DB $db;

    /**
     * The result of the last execution
     *
     * @var ExecutionResult
     */
    private ExecutionResult $result;

    public function __construct(DB $db, ExecutionResult $result)
    {
        $this->db = $db;
        $this->result = $result;
    }

    /**
     * Get the database connection
     *
     * @return DB
     */
    public function getDatabase(): DB
    {
        return $this->db;
    }

    /**
     * Get the result of the last execution, used for continuing conversations
     *
     * @return ExecutionResult
     */
    public function getExecutionResult(): ExecutionResult
    {
        return $this->result;
    }
}