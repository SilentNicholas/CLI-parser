<?php

namespace Output;

use Input\ParseInput;

/**
 * Class ParseOutput
 * @package Output
 */
class ParseOutput
{
    /**
     * @var ParseInput
     */
    private $input;

    /**
     * ParseOutput constructor.
     * @param ParseInput $input
     */
    public function __construct(ParseInput $input)
    {
        $this->input = $input;
    }

    /**
     * @return string
     */
    public function getCsvLink()
    {
        return $this->input->getFileName();
    }
}