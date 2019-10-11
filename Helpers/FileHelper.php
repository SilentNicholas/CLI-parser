<?php

namespace Helpers;

/**
 * Class FileHelper
 * @package Helpers
 */
class FileHelper
{
    /**
     * @var UrlHelper
     */
    private $urlHelp;

    /**
     * FileHelper constructor.
     */
    public function __construct()
    {
        $this->urlHelp = new UrlHelper();
    }

    /**
     * @param string $url
     * @return string
     */
    public function generateFileName(string $url)
    {
        $fileName = sha1($this->urlHelp->getDomainFromUrl($url));
        return $fileName;
    }
}