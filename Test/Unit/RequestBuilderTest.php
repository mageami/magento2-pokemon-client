<?php

namespace Pokemon\Client\Test\Unit;

use PHPUnit\Framework\TestCase;
use Pokemon\Client\Api\Data\RequestInterface;
use Pokemon\Client\Api\RequestBuilderInterface;
use Pokemon\Client\Model\Request;
use Pokemon\Client\Model\RequestBuilder;
use Pokemon\Client\Model\Config;

class RequestBuilderTest extends TestCase
{
    private ?RequestBuilderInterface $requestBuilder = null;
    private $configMock;

    protected function setUp(): void
    {
        $requestFactoryMock = $this->createMock('Pokemon\Client\Api\Data\RequestInterfaceFactory');
        $requestFactoryMock->method('create')->willReturnCallback(
            static fn($args) => new Request(
                url: $args['url'] ?? null,
                method: $args['method'] ?? null
            )
        );

        $this->configMock = $this->createMock(Config::class);
        $this->configMock->method('getEndpoint')
            ->willReturn('https://test.localhost');

        $this->requestBuilder = new RequestBuilder(
            requestFactory: $requestFactoryMock,
            config: $this->configMock
        );

        parent::setUp();
    }

    public function testThrowExceptionWhenNoURIProvided(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing URI for request !');
        $this->requestBuilder->create();
    }

    /**
     * @dataProvider requestConfigurationProvider
     */
    public function testBuildUrl(string $expected, string $uri, string $method): void
    {
        $this->requestBuilder->setUri($uri);
        $this->requestBuilder->setRequestMethod($method);

        $request = $this->requestBuilder->create();

        $this->assertEquals(
            $expected,
            $request->getUrl()
        );
    }

    public function requestConfigurationProvider(): array
    {
        return [
            [
                'https://test.localhost/api/v2/pokemon/clefairy/',
                'api/v2/pokemon/clefairy/',
                RequestInterface::METHOD_GET_NAME
            ]
        ];
    }
}
