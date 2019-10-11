<?php

namespace Commands;

use Exception\CommandException;
use Input\ParseInput;
use Output\ParseOutput;

/**
 * Class ParseCommand
 * @package Commands
 */
class ParseCommand
{
    /**
     * @var CommandException
     */
    private $exception;

    /**
     * ParseCommand constructor.
     */
    public function __construct()
    {
        $this->exception = new CommandException();
    }

    /**
     * @param array $arguments
     */
    public function execute(array $arguments)
    {
        $command = $arguments[1];
        try {
            if (!isset($arguments[2])) {throw $this->exception;};
            $url = $arguments[2];
            $parse = new ParseInput($url);
            $parse->getAllPagesData();
            $parse->saveDataToCsv();
            echo (new ParseOutput($parse))->getCsvLink();
        } catch (CommandException $exception) {
            trigger_error($exception->requireUrl($command), E_USER_ERROR);
        }
    }
}