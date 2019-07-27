<?php

namespace Slipsr\Http\Message\CompleteFactory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderFactoryInterface;

class CompleteResponseFactory implements CompleteResponseFactoryInterface
{
    private $builderFactory;

    /**
     * @var array|string[]|string[][]|array<string, string|iterable<mixed, string>>
     */
    private $headers = [];

    public function __construct(ResponseBuilderFactoryInterface $builderFactory, array $headers = [])
    {
        $this->builderFactory = $builderFactory;
        $this->headers = \array_merge($this->headers, $headers);
    }

    public function getResponseBuilderFactory(): ResponseBuilderFactoryInterface
    {
        return $this->builderFactory;
    }

    public function createResponse(int $statusCode = self::DEFAULT_STATUS, array $headers = [], StreamInterface $body = null): ResponseInterface
    {
        $builder = $this->builderFactory->createResponseBuilder();
        $builder->setStatusCode($statusCode);
        $builder->addHeaders(\array_merge($this->headers, $headers));
        if ($body !== null) {
            $builder->setBody($body);
        }
        return $builder->getMessage();
    }
}
