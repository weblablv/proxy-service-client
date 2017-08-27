<?php

namespace WebLabLv\ProxyService;

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
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
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
        if (null === $this->proxy) {
            $this->setProxy();
        }

        return $this->proxy;
    }


    private function setProxy()
    {
        $this->proxy = json_decode(
            file_get_contents($this->url)
        )->ip;
    }
}
