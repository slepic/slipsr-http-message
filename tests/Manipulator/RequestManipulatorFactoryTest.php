<?php

namespace Slipsr\Tests\Http\Message\Manipulator;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;
use Slipsr\Http\Message\Manipulator\RequestManipulatorFactory;
use Slipsr\Http\Message\Manipulator\RequestManipulatorFactoryInterface;

class RequestManipulatorFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $factory = new RequestManipulatorFactory();
        $this->assertInstanceOf(RequestManipulatorFactoryInterface::class, $factory);
    }

    public function testCreate()
    {
        $request = $this->createMock(RequestInterface::class);
        $factory = new RequestManipulatorFactory();
        $manipulator = $factory->createRequestManipulator($request);
        $this->assertInstanceOf(RequestBuilderInterface::class, $manipulator);
        $this->assertSame($request, $manipulator->getMessage());
    }
}
