<?php

namespace Exception;

use Exception;

/**
 * Class CommandException
 * @package Exception
 */
class CommandException extends Exception
{
    /**
     * @param string $command
     * @return string
     */
    public function notValidCommand(string $command)
    {
        return 'The command "'. $command .'" is invalid';
    }

    /**
     * @param string $command
     * @return string
     */
    public function requireUrl(string $command)
    {
        return 'The command "'. $command. '" require missing argument <url>';
    }
}