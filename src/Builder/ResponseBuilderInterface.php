<?php

namespace Slipsr\Http\Message\Builder;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;

interface ResponseBuilderInterface extends MessageBuilderInterface
{
    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * @return ResponseInterface
     */
    public function getMessage(): MessageInterface;
}
