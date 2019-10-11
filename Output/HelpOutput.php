<?php

namespace Output;

/**
 * Class HelpOutput
 * @package Output
 */
class HelpOutput
{
    /**
     * @return string
     */
    public function getHelpText() : string
    {
        return file_get_contents('commands.txt');
    }
}