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

    /**
     * @var array|string[]|string[][]|array<string, string|iterable<mixed, string>>
     */
    private $headers = [
        'Content-Type' => 'application/json',
    ];

    public function __construct(CompleteRequestFactoryInterface $requestFactory, JsonStreamFactoryInterface $streamFactory, array $headers = [])
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->headers = \array_merge($this->headers, $headers);
    }

    public function createJsonRequest(string $method, $uri, $json, array $headers = []): RequestInterface
    {
        return $this->requestFactory->createRequest(
            $method,
            $uri,
            \array_merge($this->headers, $headers),
            $this->streamFactory->createJsonStream($json)
        );
    }
}
