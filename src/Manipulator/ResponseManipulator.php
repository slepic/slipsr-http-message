<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;

class ResponseManipulator extends MessageManipulator implements ResponseBuilderInterface
{
    public function __construct(ResponseInterface $message)
    {
        parent::__construct($message);
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->setMessage($this->getMessage()->withStatus($statusCode));
    }

    public function setMessage(MessageInterface $message): void
    {
        if (!$message instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Message must be a ResponseInterface instance.');
        }
        parent::setMessage($message);
    }
}
