<?php

namespace WebLabLv\ProxyService;

use GuzzleHttp\Client;
use InvalidArgumentException;

class ProxyServiceClient
{
    /**
     * @var string|null $proxy
     */
    private $proxy;
    /**
     * @var string $url
     */
    private $url;
    /**
     * @var Client $httpClient
     */
    private $httpClient;

    /**
     * @param string $url
     * @param array  $httpClientConfig
     */
    public function __construct(string $url, array $httpClientConfig = [])
    {
        $this->url        = $url;
        $this->httpClient = new Client($httpClientConfig);
    }

    /**
     * @param string $url
     * @return ProxyServiceClient
     */
    public static function initialize(string $url): ProxyServiceClient
    {
        return new self($url);
    }

    /**
     * @return string
     */
    public function getProxy(): string
    {
        null === $this->proxy && $this->setProxy();
        return $this->proxy;
    }


    /**
     * @throws InvalidArgumentException if response content is not valid json
     */
    private function setProxy()
    {
        $response = $this->httpClient->get($this->url);
        $contents = $response->getBody()->getContents();

        $this->proxy = \GuzzleHttp\json_decode($contents)->ip;
    }
}
