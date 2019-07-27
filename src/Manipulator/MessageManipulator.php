<?php

namespace Slipsr\Http\Message\Manipulator;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\MessageBuilderInterface;

class MessageManipulator implements MessageBuilderInterface
{
    private $message;

    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    public function getMessage(): MessageInterface
    {
        return $this->message;
    }

    public function setMessage(MessageInterface $message): void
    {
        $this->message = $message;
    }

    public function addHeaders(array $headers): void
    {
        foreach ($headers as $key => $value) {
            if (\is_iterable($value)) {
                foreach ($value as $v) {
                    $this->message = $this->message->withAddedHeader($key, $v);
                }
            } else {
                $this->message = $this->message->withHeader($key, $value);
            }
        }
    }

    public function setBody(StreamInterface $body): void
    {
        $this->message = $this->message->withBody($body);
    }
}
