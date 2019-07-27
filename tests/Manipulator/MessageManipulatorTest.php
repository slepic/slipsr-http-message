<?php

namespace Slipsr\Tests\Http\Message\Manipulator;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\MessageBuilderInterface;
use Slipsr\Http\Message\Manipulator\MessageManipulator;

class MessageManipulatorTest extends TestCase
{
    public function testImplements(): void
    {
        $message = $this->createMock(MessageInterface::class);
        $builder = new MessageManipulator($message);
        $this->assertInstanceOf(MessageBuilderInterface::class, $builder);
    }

    public function testGetMessage(): void
    {
        $message = $this->createMock(MessageInterface::class);
        $builder = new MessageManipulator($message);
        $this->assertSame($message, $builder->getMessage());
    }

    public function testSetBody(): void
    {
        $message = $this->createMock(MessageInterface::class);
        $body = $this->createMock(StreamInterface::class);
        $newMessage = $this->createMock(MessageInterface::class);

        $message->expects($this->once())
            ->method('withBody')
            ->with($body)
            ->willReturn($newMessage);

        $builder = new MessageManipulator($message);
        $builder->setBody($body);

        $output = $builder->getMessage();
        $this->assertSame($newMessage, $output);
    }

    public function testAddHeaders(): void
    {
        $message = $this->createMock(MessageInterface::class);
        $newMessage = $this->createMock(MessageInterface::class);
        $finalMessage = $this->createMock(MessageInterface::class);

        $message->expects($this->once())
            ->method('withHeader')
            ->with('x', 'y')
            ->willReturn($newMessage);

        $newMessage->expects($this->once())
            ->method('withAddedHeader')
            ->with('a', 'b')
            ->willReturn($finalMessage);

        $builder = new MessageManipulator($message);
        $builder->addHeaders(['x' => 'y', 'a' => ['b']]);
        $output = $builder->getMessage();
        $this->assertSame($finalMessage, $output);
    }
}
