<?php


namespace Merus\WAB\Commands\Interfaces;


interface CommandInterface
{
    public function execute(CommandContextInterface $context);
}