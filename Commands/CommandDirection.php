<?php

namespace Commands;

use Exception\CommandException;
use Validate\CommandValidate;

/**
 * Class CommandDirection
 * @package Commands
 */
class CommandDirection
{
    /**
     * @var array
     */
    private $commands = ['parse', 'report', 'help'];

    /**
     * @var ParseCommand
     */
    private $parse;

    /**
     * @var ReportCommand
     */
    private $report;

    /**
     * @var HelpCommand
     */
    private $help;

    /**
     * CommandDirection constructor.
     */
    public function __construct()
    {
        $this->parse = new ParseCommand();
        $this->report = new ReportCommand();
        $this->help = new HelpCommand();
    }

    /**
     * @param array $arguments
     */
    public function executeDirection(array $arguments)
    {
        $command = $arguments[1];
        try {
            (new CommandValidate($this->commands))->validate($command);
            if ($command === 'help') {
                $this->{$command}->execute();
            } else {
                $this->{$command}->execute($arguments);
            }
        } catch (CommandException $exception) {
            trigger_error($exception->notValidCommand($command), E_USER_ERROR);
        }
    }
}