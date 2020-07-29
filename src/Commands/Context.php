<?php


namespace Merus\WAB\Commands;


use Merus\WAB\Database\DB;
use Merus\WAB\ExecutionResult;
use Merus\WAB\Commands\Interfaces\CommandContextInterface;

class Context implements CommandContextInterface
{
    /**
     * User's input text
     *
     * @var string
     */
    protected string $input;

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

    /**
     * The user of the current request
     *
     * @var User
     */
    private User $user;

    /**
     * Context constructor.
     *
     * @param User $user
     * @param string $input User's input text
     * @param DB $db Database connection
     * @param ExecutionResult $result Result of previous execution
     */
    public function __construct( User $user, string $input, DB $db, ExecutionResult $result)
    {
        $this->input = $input;
        $this->db = $db;
        $this->result = $result;
        $this->user = $user;
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

    /**
     * Get the user's input text
     *
     * @return string
     */
    public function getUserInput(): string
    {
        return $this->input;
    }

    /**
     * @inheritDoc
     */
    public function getUser(): User
    {
        return $this->user;
    }
}