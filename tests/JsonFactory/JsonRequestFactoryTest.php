<?php

namespace Slipsr\Tests\Http\Message;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteRequestFactoryInterface;
use Slipsr\Http\Message\JsonFactory\JsonRequestFactory;
use Slipsr\Http\Message\JsonFactory\JsonRequestFactoryInterface;
use Slipsr\Http\Message\JsonFactory\JsonStreamFactoryInterface;

class JsonRequestFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $requestFactory = $this->createMock(CompleteRequestFactoryInterface::class);
        $streamFactory = $this->createMock(JsonStreamFactoryInterface::class);
        $factory = new JsonRequestFactory($requestFactory, $streamFactory);
        $this->assertInstanceOf(JsonRequestFactoryInterface::class, $factory);
    }

    /**
     * @param string $method
     * @param $uri
     * @param $json
     * @param array $headers
     * @dataProvider provideCreateData
     */
    public function testCreate(string $method, $uri, $json, array $headers): void
    {
        $requestFactory = $this->createMock(CompleteRequestFactoryInterface::class);
        $streamFactory = $this->createMock(JsonStreamFactoryInterface::class);
        $request = $this->createMock(RequestInterface::class);
        $body = $this->createMock(StreamInterface::class);

        $streamFactory->expects($this->once())
            ->method('createJsonStream')
            ->with($json)
            ->willReturn($body);

        $requestFactory->expects($this->once())
            ->method('createRequest')
            ->with($method, $uri, $headers + ['Content-Type' => 'application/json'], $body)
            ->willReturn($request);


        $factory = new JsonRequestFactory($requestFactory, $streamFactory);
        $output = $factory->createJsonRequest($method, $uri, $json, $headers);
        $this->assertSame($request, $output);
    }

    public function provideCreateData(): array
    {
        return [
            ['GET', '/path', [], []],
            ['GET', '/path', ['x' => 'y'], ['h', 'x']],
        ];
    }
}
