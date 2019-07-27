<?php

namespace Slipsr\Tests\Http\Message;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderFactoryInterface;
use Slipsr\Http\Message\Builder\ResponseBuilderInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteResponseFactory;
use Slipsr\Http\Message\CompleteFactory\CompleteResponseFactoryInterface;

class ResponseFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $builderFactory = $this->createMock(ResponseBuilderFactoryInterface::class);
        $factory = new CompleteResponseFactory($builderFactory);
        $this->assertInstanceOf(CompleteResponseFactoryInterface::class, $factory);
    }

    /**
     * @param int $statusCode
     * @param array $headers
     * @param StreamInterface|null $body
     * @dataProvider provideResponseData
     */
    public function testCreateResponse(int $statusCode, array $headers, StreamInterface $body = null): void
    {
        $builder = $this->createMock(ResponseBuilderInterface::class);

        $builder->expects($this->once())
            ->method('setStatusCode')
            ->with($statusCode);

        $builder->expects($this->once())
            ->method('addHeaders')
            ->with($headers);

        if ($body !== null) {
            $builder->expects($this->once())
                ->method('setBody')
                ->with($body);
        } else {
            $builder->expects($this->never())
                ->method('setBody');
        }

        $response = $this->createMock(ResponseInterface::class);
        $builder->expects($this->once())
            ->method('getMessage')
            ->with()
            ->willReturn($response);

        $builderFactory = $this->createMock(ResponseBuilderFactoryInterface::class);
        $builderFactory->expects($this->once())
            ->method('createResponseBuilder')
            ->with()
            ->willReturn($builder);

        $factory = new CompleteResponseFactory($builderFactory);
        $output = $factory->createResponse($statusCode, $headers, $body);
        $this->assertSame($response, $output);
    }

    public function provideResponseData(): array
    {
        return [
            [200, []],
            [200, [], $this->createMock(StreamInterface::class)],
            [301, ['Location' => '/path'], $this->createMock(StreamInterface::class)],
        ];
    }
}
