<?php

namespace Merus\WAB\Commands;


use Merus\WAB\Commands\Interfaces\CommandInterface;

class Registrar
{
    public function execute(CommandInterface $command)
    {
        $result = $command->execute();
    }


    public function register()
    {

    }
}