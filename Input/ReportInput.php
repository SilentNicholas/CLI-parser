<?php

namespace Input;

use Helpers\FileHelper;

/**
 * Class ReportInput
 * @package Input
 */
class ReportInput
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var FileHelper
     */
    private $fileHelp;

    /**
     * ReportInput constructor.
     */
    public function __construct()
    {
        $this->fileHelp = new FileHelper();
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getParseResult()
    {
        $fileData = $this->delimitStringsArray($this->getFileData());
        $totalImg = count($fileData['images']);
        $totalUrls = $this->getUniqueElements($fileData['urls']);
        $uniqueImg = $this->getUniqueElements($fileData['images']);
        return ['total_img' => $totalImg, 'total_urls' => $totalUrls, 'unique_img' => $uniqueImg];
    }

    /**
     * @param array $stringsArray
     * @param string $delimiter
     * @return array
     */
    public function delimitStringsArray(array $stringsArray, $delimiter = ',')
    {
        $images = [];
        $urls = [];
        foreach ($stringsArray as $value) {
            $delimit = explode($delimiter, $value);
            $images[] = $delimit[0];
            $urls[] = $delimit[1];
        }
        return ['images' => $images, 'urls' => $urls];
    }

    /**
     * @param array $array
     * @return int
     */
    public function getUniqueElements(array $array)
    {
        return count(array_unique($array));
    }

    /**
     * @return array|bool
     */
    public function getFileData()
    {
        $filePath = 'storage/'. $this->fileHelp->generateFileName($this->url). '.csv';
        $file = file($filePath);
        return $file;
    }
}