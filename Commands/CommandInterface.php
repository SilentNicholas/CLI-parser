<?php

namespace Commands;

/**
 * Interface CommandInterface
 * @package Commands
 */
interface CommandInterface
{
    /**
     * @param array $arguments
     */
    public function execute(array $arguments);
}