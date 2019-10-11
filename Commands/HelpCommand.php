<?php

namespace Commands;

use Output\HelpOutput;

/**
 * Class HelpCommand
 * @package Commands
 */
class HelpCommand
{
    /**
     * @var HelpOutput
     */
    private $output;

    /**
     * HelpCommand constructor.
     */
    public function __construct()
    {
        $this->output = new HelpOutput();
    }

    /**
     * Print console text
     */
    public function execute()
    {
        echo $this->output->getHelpText();
    }
}