<?php


namespace Merus\WAB\Commands\Interfaces;


use Merus\WAB\Database\DB;
use Merus\WAB\ExecutionResult;

interface CommandContextInterface
{
    public function getDatabase(): DB;

    public function getExecutionResult(): ExecutionResult;
}