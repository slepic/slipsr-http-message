<?php

namespace Slipsr\Tests\Http\Message;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Slipsr\Http\Message\Builder\RequestBuilderFactoryInterface;
use Slipsr\Http\Message\Builder\RequestBuilderInterface;
use Slipsr\Http\Message\CompleteFactory\CompleteRequestFactory;
use Slipsr\Http\Message\CompleteFactory\CompleteRequestFactoryInterface;

class RequestFactoryTest extends TestCase
{
    public function testImplements(): void
    {
        $builderFactory = $this->createMock(RequestBuilderFactoryInterface::class);
        $factory = new CompleteRequestFactory($builderFactory);
        $this->assertInstanceOf(CompleteRequestFactoryInterface::class, $factory);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $headers
     * @param StreamInterface|null $body
     * @dataProvider provideCreateData
     */
    public function testCreate(string $method, $uri, array $headers, StreamInterface $body = null): void
    {
        $builder = $this->createMock(RequestBuilderInterface::class);

        $builder->expects($this->once())
            ->method('setMethod')
            ->with($method);

        $builder->expects($this->once())
            ->method('setUri')
            ->with($uri);

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

        $request = $this->createMock(RequestInterface::class);
        $builder->expects($this->once())
            ->method('getMessage')
            ->with()
            ->willReturn($request);

        $builderFactory = $this->createMock(RequestBuilderFactoryInterface::class);
        $builderFactory->expects($this->once())
            ->method('createRequestBuilder')
            ->with()
            ->willReturn($builder);

        $factory = new CompleteRequestFactory($builderFactory);
        $output = $factory->createRequest($method, $uri, $headers, $body);
        $this->assertSame($request, $output);
    }

    public function provideCreateData(): array
    {
        return [
            ['GET', '/', []],
            ['POST', 'http://localhost/', [], $this->createMock(StreamInterface::class)],
            ['PUT', '/path', ['Content-Type' => 'text/csv'], $this->createMock(StreamInterface::class)],
        ];
    }
}
