<?php

namespace Slipsr\Http\Message\Builder;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

interface RequestBuilderInterface extends MessageBuilderInterface
{
    /**
     * @param string $method
     */
    public function setMethod(string $method): void;

    /**
     * @param string|UriInterface $uri
     */
    public function setUri($uri): void;

    /**
     * @return RequestInterface
     */
    public function getMessage(): MessageInterface;
}
