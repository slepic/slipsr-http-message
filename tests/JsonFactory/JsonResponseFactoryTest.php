<?php

namespace Slipsr\Tests\Http\Message;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteResponseFactoryInterface;
use Slipsr\Http\Message\JsonFactory\JsonResponseFactory;
use Slipsr\Http\Message\JsonFactory\JsonResponseFactoryInterface;
use Slipsr\Http\Message\JsonFactory\JsonStreamFactoryInterface;

class JsonResponseFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $responseFactory = $this->createMock(CompleteResponseFactoryInterface::class);
        $streamFactory = $this->createMock(JsonStreamFactoryInterface::class);
        $factory = new JsonResponseFactory($responseFactory, $streamFactory);
        $this->assertInstanceOf(JsonResponseFactoryInterface::class, $factory);
    }

    /**
     * @param int $statusCode
     * @param $json
     * @param array $headers
     * @dataProvider provideCreateData
     */
    public function testCreate(int $statusCode, $json, array $headers): void
    {
        $ResponseFactory = $this->createMock(CompleteResponseFactoryInterface::class);
        $streamFactory = $this->createMock(JsonStreamFactoryInterface::class);
        $Response = $this->createMock(ResponseInterface::class);
        $body = $this->createMock(StreamInterface::class);

        $streamFactory->expects($this->once())
            ->method('createJsonStream')
            ->with($json)
            ->willReturn($body);

        $ResponseFactory->expects($this->once())
            ->method('createResponse')
            ->with($statusCode, $headers + ['Content-Type' => 'application/json'], $body)
            ->willReturn($Response);


        $factory = new JsonResponseFactory($ResponseFactory, $streamFactory);
        $output = $factory->createJsonResponse($json, $statusCode, $headers);
        $this->assertSame($Response, $output);
    }

    public function provideCreateData(): array
    {
        return [
            [200, [], []],
            [201, ['x' => 'y'], ['h', 'x']],
        ];
    }
}
