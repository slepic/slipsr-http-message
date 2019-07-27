<?php

namespace Slipsr\Tests\Http\Message\Manipulator;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;
use Slipsr\Http\Message\Manipulator\ResponseManipulator;

class ResponseManipulatorTest extends TestCase
{
    public function testImplements(): void
    {
        $message = $this->createMock(ResponseInterface::class);
        $builder = new ResponseManipulator($message);
        $this->assertInstanceOf(ResponseBuilderInterface::class, $builder);
    }

    public function testSetStatusCode(): void
    {
        $message = $this->createMock(ResponseInterface::class);
        $newMessage = $this->createMock(ResponseInterface::class);

        $message->expects($this->once())
            ->method('withStatus')
            ->with($statusCode = 301)
            ->willReturn($newMessage);

        $builder = new ResponseManipulator($message);
        $builder->setStatusCode($statusCode);

        $output = $builder->getMessage();
        $this->assertSame($newMessage, $output);
    }
}
