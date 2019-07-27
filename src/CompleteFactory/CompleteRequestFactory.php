<?php

namespace Slipsr\Http\Message\CompleteFactory;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\RequestBuilderFactoryInterface;

class CompleteRequestFactory implements CompleteRequestFactoryInterface
{
    private $builderFactory;

    /**
     * @var array|string[]|string[][]|array<string, string|iterable<mixed, string>>
     */
    private $headers = [];

    public function __construct(RequestBuilderFactoryInterface $builderFactory, array $headers = [])
    {
        $this->builderFactory = $builderFactory;
        $this->headers = \array_merge($this->headers, $headers);
    }

    public function getRequestBuilderFactory(): RequestBuilderFactoryInterface
    {
        return $this->builderFactory;
    }

    public function createRequest(string $method, $uri, array $headers = [], StreamInterface $body = null): RequestInterface
    {
        $builder = $this->builderFactory->createRequestBuilder();
        $builder->setMethod($method);
        $builder->setUri($uri);
        $builder->addHeaders(\array_merge($this->headers, $headers));
        if ($body !== null) {
            $builder->setBody($body);
        }
        return $builder->getMessage();
    }
}
