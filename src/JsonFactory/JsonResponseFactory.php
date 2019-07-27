<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteResponseFactoryInterface;

class JsonResponseFactory implements JsonResponseFactoryInterface
{
    /**
     * @var CompleteResponseFactoryInterface
     */
    private $responseFactory;

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

    public function __construct(CompleteResponseFactoryInterface $responseFactory, JsonStreamFactoryInterface $streamFactory, array $headers = [])
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        $this->headers = \array_merge($this->headers, $headers);
    }

    public function createJsonResponse($json, int $statusCode = self::DEFAULT_STATUS, array $headers = []): ResponseInterface
    {
        return $this->responseFactory->createResponse(
            $statusCode,
            \array_merge($this->headers, $headers),
            $this->streamFactory->createJsonStream($json)
        );
    }
}
