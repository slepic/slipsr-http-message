<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteResponseFactoryInterface;

class JsonResponseFactory implements JsonResponseFactoryInterface
{
    private $responseFactory;
    private $streamFactory;

    public function __construct(CompleteResponseFactoryInterface $responseFactory, JsonStreamFactoryInterface $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function createJsonResponse($json, int $statusCode = self::DEFAULT_STATUS, array $headers = []): ResponseInterface
    {
        $body = $this->streamFactory->createJsonStream($json);
        $headers['Content-Type'] = 'application/json';
        return $this->responseFactory->createResponse($statusCode, $headers, $body);
    }
}
