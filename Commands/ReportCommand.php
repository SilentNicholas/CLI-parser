<?php

namespace Commands;

use Exception\ReportException;
use Validate\ReportValidate;
use Input\ReportInput;
use Output\ReportOutput;

/**
 * Class ReportCommand
 * @package Commands
 */
class ReportCommand
{
    /**
     * @var string
     */
    private $command;

    /**
     * @var string
     */
    private $url;

    /**
     * @var ReportValidate
     */
    private $validate;

    /**
     * @var ReportInput
     */
    private $input;

    /**
     * @var ReportOutput
     */
    private $output;

    /**
     * ReportCommand constructor.
     */
    public function __construct()
    {
        $this->validate = new ReportValidate();
        $this->input = new ReportInput();
        $this->output = new ReportOutput();
    }


    /**
     * @param array $arguments
     */
    public function execute($arguments)
    {
        $this->command = $arguments[1];
        $this->url = $arguments[2];
        try {
            $this->validate->validateExistingDomainData($this->url);
            $this->input->setUrl($this->url);
            echo $this->output->printParseResult($this->input);
            $this->output->printParseResult($this->input);
        } catch (ReportException $exception) {
            trigger_error($exception->getMessage());
        }
    }
}