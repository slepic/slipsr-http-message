<?php

namespace Slipsr\Http\Message\CompleteFactory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Simplifies creation of PSR-7 responses by server request handlers / controllers.
 */
interface CompleteResponseFactoryInterface
{
    /**
     * The default status value
     */
    const DEFAULT_STATUS = 204;

    /**
     * Creates a PSR-7 response with all parts given in advance.
     *
     * Opposed to PSR-17 ResponseFactoryInterface, this one expects all parts of the response to be given in advance.
     * Only minor or no changes at all are expected to be made to the response after it is created.
     *
     * @param int $statusCode
     * @param array $headers
     * @param StreamInterface|null $body If the body stream is not provided an empty stream must be created by the implementation.
     * @return ResponseInterface
     */
    public function createResponse(int $statusCode = self::DEFAULT_STATUS, array $headers = [], StreamInterface $body = null): ResponseInterface;
}
