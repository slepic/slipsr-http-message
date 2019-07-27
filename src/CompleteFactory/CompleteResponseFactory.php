<?php

namespace Slipsr\Http\Message\CompleteFactory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderFactoryInterface;

class CompleteResponseFactory implements CompleteResponseFactoryInterface
{
    private $builderFactory;

    public function __construct(ResponseBuilderFactoryInterface $builderFactory)
    {
        $this->builderFactory = $builderFactory;
    }

    public function getResponseBuilderFactory(): ResponseBuilderFactoryInterface
    {
        return $this->builderFactory;
    }

    public function createResponse(int $statusCode = self::DEFAULT_STATUS, array $headers = [], StreamInterface $body = null): ResponseInterface
    {
        $builder = $this->builderFactory->createResponseBuilder();
        $builder->setStatusCode($statusCode);
        $builder->addHeaders($headers);
        if ($body !== null) {
            $builder->setBody($body);
        }
        return $builder->getMessage();
    }
}
