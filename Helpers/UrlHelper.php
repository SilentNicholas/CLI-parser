<?php

namespace Helpers;

/**
 * Class UrlHelper
 * @package Helpers
 */
class UrlHelper
{
    /**
     * @param string $url
     * @return string
     */
    public function getDomainFromUrl(string $url)
    {
        return explode('/', str_replace(['http://', 'https://'], '', $url))[0];
    }

    /**
     * @param string $domain
     * @param string $uri
     * @return string
     */
    public function getLinkFullPath(string $domain, string $uri)
    {
        return 'http://'. $domain. '/'. ltrim($uri, '/');
    }
}