<?php

namespace Saver;

/**
 * Interface SaverInterface
 * @package Saver
 */
interface SaverInterface
{
    /**
     * @param array $data
     */
    public function save(array $data);
}