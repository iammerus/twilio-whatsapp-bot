<?php

namespace Merus\WAB;

use Merus\WAB\Commands\User;
use Merus\WAB\Database\DB;

class ExecutionResult
{
    /**
     * @var DB
     */
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    protected string $table = 'execution_results';


    public function create($command)
    {

    }

    /**
     * Fetch the last execution result for the given user
     *
     * @param User $user The user we're fetch exec result for
     *
     * @return object
     */
    public function last(User $user)
    {
        return $this->db->row("SELECT * FROM `execution_results` 
                                   WHERE `uid` = '{$user->getNumber()}' 
                                   ORDER BY id DESC 
                                   LIMIT 1");
    }
}