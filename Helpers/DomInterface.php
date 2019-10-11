<?php

namespace Helpers;

/**
 * Interface DomInterface
 * @package Helpers
 */
interface DomInterface
{
    /**
     * @param string $document
     */
    public function loadDocument(string $document);

    /**
     * @param string $tagName
     */
    public function getDocumentTagsByName(string $tagName);
}