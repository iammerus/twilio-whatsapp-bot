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


    /**
     * Insert an execution record
     *
     * @param string $command
     * @param array $information
     * @param User $user
     *
     * @return string
     */
    public function create(string $command, array $information, User $user): string
    {
        $id = -1;

        if (array_key_exists('last_id', $information)) {
            $id = intval($information['last_id']);
            unset($information['last_id']);
        }

        $information['command'] = $command;
        $information['uid'] = $user->getNumber();
        $information['meta'] = json_encode($information['meta']);

        if ($id === -1) return $this->db->insert($this->table, $information);

        return $this->db->update($this->table, $information, [
            'id' => $id
        ]);
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