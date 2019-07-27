<?php

namespace Slipsr\Tests\Http\Message\Manipulator;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;
use Slipsr\Http\Message\Manipulator\ResponseManipulatorFactory;
use Slipsr\Http\Message\Manipulator\ResponseManipulatorFactoryInterface;

class ResponseManipulatorFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $factory = new ResponseManipulatorFactory();
        $this->assertInstanceOf(ResponseManipulatorFactoryInterface::class, $factory);
    }

    public function testCreate()
    {
        $response = $this->createMock(ResponseInterface::class);
        $factory = new ResponseManipulatorFactory();
        $manipulator = $factory->createResponseManipulator($response);
        $this->assertInstanceOf(ResponseBuilderInterface::class, $manipulator);
        $this->assertSame($response, $manipulator->getMessage());
    }
}
