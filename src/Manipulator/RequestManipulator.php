<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;

/**
 * @method RequestInterface getMessage()
 */
class RequestManipulator extends MessageManipulator implements RequestBuilderInterface
{
    public function __construct(RequestInterface $message)
    {
        parent::__construct($message);
    }

    public function setMethod(string $method): void
    {
        $this->setMessage($this->getMessage()->withMethod($method));
    }

    public function setUri($uri): void
    {
        $this->setMessage($this->getMessage()->withUri($uri));
    }

    public function setMessage(MessageInterface $message): void
    {
        if (!$message instanceof RequestInterface) {
            throw new \InvalidArgumentException('Message must be a RequestInterface instance.');
        }
        parent::setMessage($message);
    }
}
