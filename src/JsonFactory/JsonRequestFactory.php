<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\RequestInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteRequestFactoryInterface;

class JsonRequestFactory implements JsonRequestFactoryInterface
{
    /**
     * @var CompleteRequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var JsonStreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(CompleteRequestFactoryInterface $requestFactory, JsonStreamFactoryInterface $streamFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    public function createJsonRequest(string $method, $uri, $json, array $headers = []): RequestInterface
    {
        $body = $this->streamFactory->createJsonStream($json);
        $headers['Content-Type'] = 'application/json';
        return $this->requestFactory->createRequest($method, $uri, $headers, $body);
    }
}
