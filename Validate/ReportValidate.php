<?php

namespace Validate;

use Exception\ReportException;
use Helpers\UrlHelper;

/**
 * Class ReportValidate
 * @package Validate
 */
class ReportValidate
{
    /**
     * @var UrlHelper
     */
    private $urlHelp;

    /**
     * ReportValidate constructor.
     */
    public function __construct()
    {
        $this->urlHelp = new UrlHelper();
    }

    /**
     * @param $url
     * @throws ReportException
     */
    public function validateExistingDomainData(string $url)
    {
        $fileName = sha1($this->urlHelp->getDomainFromUrl($url)). '.csv';
        if (!file_exists('storage/'. $fileName)) {
            throw new ReportException('This domain has not been parsed yet');
        }
    }
}