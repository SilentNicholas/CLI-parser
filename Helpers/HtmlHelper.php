<?php

namespace Helpers;

use DOMDocument;

/**
 * Class HtmlHelper
 * @package Helpers
 */
class HtmlHelper implements DomInterface
{
    /**
     * @var DOMDocument
     */
    private $dom;

    /**
     * HtmlHelper constructor.
     */
    public function __construct()
    {
        $this->dom = new DOMDocument();
    }

    /**
     * @param string $document
     */
    public function loadDocument(string $document)
    {
        libxml_use_internal_errors(true);
        if(!$this->dom->loadHTML($document)) {
            libxml_clear_errors();
        }
    }

    /**
     * @param string $tagName
     * @return \DOMNodeList
     */
    public function getDocumentTagsByName($tagName)
    {
        return $this->dom->getElementsByTagName($tagName);
    }
}