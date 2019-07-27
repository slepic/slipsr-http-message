<?php

namespace Slipsr\Tests\Http\Message\Manipulator;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;
use Slipsr\Http\Message\Manipulator\RequestManipulator;

class RequestManipulatorTest extends TestCase
{
    public function testImplements(): void
    {
        $message = $this->createMock(RequestInterface::class);
        $builder = new RequestManipulator($message);
        $this->assertInstanceOf(RequestBuilderInterface::class, $builder);
    }

    public function testSetMethod(): void
    {
        $message = $this->createMock(RequestInterface::class);
        $newMessage = $this->createMock(RequestInterface::class);

        $message->expects($this->once())
            ->method('withMethod')
            ->with($method = 'PUT')
            ->willReturn($newMessage);

        $builder = new RequestManipulator($message);
        $builder->setMethod($method);

        $output = $builder->getMessage();
        $this->assertSame($newMessage, $output);
    }

    public function testSetUri(): void
    {
        $message = $this->createMock(RequestInterface::class);
        $newMessage = $this->createMock(RequestInterface::class);

        $message->expects($this->once())
            ->method('withUri')
            ->with($uri = $this->createMock(UriInterface::class))
            ->willReturn($newMessage);

        $builder = new RequestManipulator($message);
        $builder->setUri($uri);

        $output = $builder->getMessage();
        $this->assertSame($newMessage, $output);
    }
}
