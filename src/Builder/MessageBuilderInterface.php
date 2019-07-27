<?php

namespace Slipsr\Http\Message\Builder;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

interface MessageBuilderInterface
{
    /**
     * @param array|string[]|string[][] $headers
     */
    public function addHeaders(array $headers): void;

    /**
     * @param StreamInterface $body
     */
    public function setBody(StreamInterface $body): void;

    /**
     * @return MessageInterface
     */
    public function getMessage(): MessageInterface;
}
