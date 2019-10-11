<?php

namespace Validate;

use Exception\CommandException;

/**
 * Class CommandValidate
 * @package Validate
 */
class CommandValidate
{
    /**
     * @var array
     */
    private $commands;

    /**
     * CommandValidate constructor.
     * @param array $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    /**
     * @param string $command
     * @throws CommandException
     */
    public function validate(string $command)
    {
        if (!in_array($command, $this->commands)) {
            throw new CommandException();
        }
    }
}