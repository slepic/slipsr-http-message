<?php

namespace Slipsr\Http\Message\JsonFactory;

use Psr\Http\Message\StreamInterface;

/**
 * Encapsulates creation of PSR-7 streams with json content.
 */
interface JsonStreamFactoryInterface
{
    /**
     * Create a PSR-7 stream containing valid json body.
     *
     * To make sure the json is valid, the serialization must be handled by the implementation.
     *
     * @param mixed $json
     * @return StreamInterface
     */
    public function createJsonStream($json): StreamInterface;
}
