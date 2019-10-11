<?php

namespace Input;

use Parser\Curl;
use Helpers\HtmlHelper;
use Helpers\UrlHelper;
use Helpers\FileHelper;
use Saver\CSVSaver;
use Exception\CsvException;

/**
 * Class ParseInput
 * @package Input
 */
class ParseInput
{
    /**
     * @const int
     */
    private const MAX_NESTING = 5;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Curl
     */
    private $parser;

    /**
     * @var HtmlHelper
     */
    private $htmlHelp;

    /**
     * @var UrlHelper
     */
    private $urlHelp;

    /**
     * @var FileHelper
     */
    private $fileHelp;

    /**
     * @var CSVSaver
     */
    private $csv;

    /**
     * @var array
     */
    private $pagesData;

    /**
     * @var string
     */
    private $fileName;

    /**
     * ParseInput constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parser = new Curl();
        $this->htmlHelp = new HtmlHelper();
        $this->urlHelp = new UrlHelper();
        $this->csv = new CSVSaver();
        $this->fileHelp = new FileHelper();
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $filename
     */
    public function setFileName(string $filename)
    {
        $this->fileName = $filename;
    }

    /**
     * @param string $pageUrl
     * @return array
     */
    public function getPageLinks(string $pageUrl)
    {
        $links = [];
        $content = $this->parser->getUrlContent($pageUrl);
        $this->htmlHelp->loadDocument($content);
        $tagsLink = $this->htmlHelp->getDocumentTagsByName('a');
        foreach ($tagsLink as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, 'javascript:') !== false || strpos($href, '#') !== false) {
                continue;
            } elseif (strpos($href, 'http') === false) {
                $links[] = $this->urlHelp->getLinkFullPath($this->urlHelp->getDomainFromUrl($pageUrl), $href);
            } elseif (strpos($href, $this->urlHelp->getDomainFromUrl($pageUrl)) !== false) {
                $links[] = $href;
            }
        }
        return $links;
    }

    /**
     * @param string $pageUrl
     * @param int $nestingCount
     * @param null $nestingLinks
     * @return array|null
     */
    public function getNestingLinks(string $pageUrl, $nestingCount = 0, $nestingLinks = null)
    {
        $pageLinks = $this->getPageLinks($pageUrl);
        if ($nestingCount >= self::MAX_NESTING) {
            return array_merge($pageLinks, $nestingLinks);
        }
        foreach ($pageLinks as $link) {
            $nestingLinks = $this->getNestingLinks($link, $nestingCount += 1, $pageLinks);
        }
        return $nestingLinks;
    }

    /**
     * @param string $pageUrl
     * @return array
     */
    public function getPageImages(string $pageUrl)
    {
        $images = [];
        $content = $this->parser->getUrlContent($pageUrl);
        $this->htmlHelp->loadDocument($content);
        $tagsImg = $this->htmlHelp->getDocumentTagsByName('img');
        foreach ($tagsImg as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'http') === false) {
                $images[] = [$this->urlHelp->getLinkFullPath($this->urlHelp->getDomainFromUrl($pageUrl), $src), $pageUrl];
            } else {
                $images[] = $src;
            }
        }
        return $images;
    }

    /**
     * Get require data from all web pages
     * and set it to $pagesData
     */
    public function getAllPagesData()
    {
        $allPages = $this->getNestingLinks($this->url);
        $result = [];
        foreach ($allPages as $page) {
            $result = array_merge($result, $this->getPageImages($page));
        }
        $this->pagesData = $result;
    }

    /**
     * Save handled data to CSV
     */
    public function saveDataToCsv()
    {
        try {
            $this->setFileName($this->fileHelp->generateFileName($this->url). '.csv');
            $this->csv->openFile('storage/'. $this->getfileName());
            $this->csv->save($this->pagesData);
            $this->csv->closeFile();
        } catch (CsvException $exception) {
            trigger_error($exception->getMessage());
        }
    }
}