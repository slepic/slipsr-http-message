<?php

namespace Slipsr\Http\Message\CompleteFactory;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

interface CompleteRequestFactoryInterface
{
    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array $headers
     * @param StreamInterface|null $body
     * @return RequestInterface
     */
    public function createRequest(string $method, $uri, array $headers = [], StreamInterface $body = null): RequestInterface;
}
