<?php

namespace aps\router;

class Router
{
    private string $url;
    private string $method;
    private array $requestUrl;

    public function __construct(string $url, string $method)
    {
        $this->url =  $url;
        $this->method =  $method;
        $this->requestUrl = explode("/", $this->url);
        unset($this->requestUrl[0]);
    }

    public function getMethod()
    {
        return $this->method;
    }


}