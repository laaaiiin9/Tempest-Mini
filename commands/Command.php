<?php

abstract class Command
{
    protected array $args = [];

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    abstract public function handle(): void;
}