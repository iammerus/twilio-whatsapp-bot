<?php

namespace Merus\WAB;

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

    public function last()
    {

    }
}