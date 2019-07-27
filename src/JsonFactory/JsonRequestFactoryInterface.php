<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

interface JsonRequestFactoryInterface
{
    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param $json
     * @param array $headers
     * @return RequestInterface
     */
    public function createJsonRequest(string $method, $uri, $json, array $headers = []): RequestInterface;
}
