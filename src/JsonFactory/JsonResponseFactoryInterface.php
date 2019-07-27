<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\ResponseInterface;

/**
 * Simplifies creation of PSR-7 responses with json body.
 */
interface JsonResponseFactoryInterface
{

    /**
     * Default status code
     */
    const DEFAULT_STATUS = 200;

    /**
     * Creates a PSR-7 response with valid json body.
     *
     * If you need empty body, this is not for you.
     *
     * @param mixed $json Response body, can be anything that can be serialized to json.
     * 		But be aware that null will not yield an empty body. If you want empty body, use a different factory.
     * @param int $statusCode
     * @param string[]|string[][]|array<string, string|iterable<mixed, string>> $headers
     * @return ResponseInterface
     */
    public function createJsonResponse($json, int $statusCode = self::DEFAULT_STATUS, array $headers = []): ResponseInterface;
}
