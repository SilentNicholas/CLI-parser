<?php

namespace Parser;

use Exception;

/**
 * Class Curl
 * @package Parser
 */
class Curl
{
    /**
     * @var array
     */
    private $curlOptions;

    /**
     * Curl constructor.
     */
    public function __construct()
    {
        $this->curlOptions = include(dirname(__FILE__) . '/curl_options.php');
    }

    /**
     * @param null $url
     * @return false|resource
     */
    public function initCurl($url = null)
    {
        if ($url !== null) {
            return curl_init($url);
        }
        return curl_init();
    }

    /**
     * @param resource $connect
     * @param array $options
     * @return bool
     */
    public function setCurlOptions($connect, $options = [])
    {
        if (!empty($options)) {
            return curl_setopt_array($connect, array_merge($options, $this->curlOptions));
        }
        return curl_setopt_array($connect, $this->curlOptions);
    }

    /**
     * @param $connect
     * @return bool|string
     */
    public function executeCurl($connect)
    {
        return curl_exec($connect);
    }

    /**
     * @param resource $connect
     */
    public function closeCurl($connect)
    {
        curl_close($connect);
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function getUrlContent(string $url)
    {
        try {
            $connect = $this->initCurl($url);
            $this->setCurlOptions($connect);
            $content = $this->executeCurl($connect);
            $this->closeCurl($connect);
            return $content;
        } catch (Exception $exception) {
            trigger_error($exception->getMessage(),E_USER_ERROR);
        }
    }
}