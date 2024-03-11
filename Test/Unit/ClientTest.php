<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Test\Unit;

use Magento\Framework\HTTP\ClientInterface;
use Magento\Framework\Serialize\Serializer\Json;
use PHPUnit\Framework\TestCase;
use Pokemon\Client\Model\Config;
use Pokemon\Client\Model\Request;
use Pokemon\Client\Model\Response;
use Pokemon\Client\Service\Client;

class ClientTest extends TestCase
{
    private ?\Pokemon\Client\Api\ClientInterface $testable = null;
    private ?ClientInterface $httpClientMock = null;
    private ?Config $configMock = null;

    protected function setUp(): void
    {
        $responseFactoryMock = $this->createMock(
            'Pokemon\Client\Api\Data\ResponseInterfaceFactory'
        );
        $responseFactoryMock->method('create')
            ->willReturnCallback(static fn($args) => new Response(
                body: $args['body'],
                statusCode: $args['statusCode']
            ));

        $headerFactory = $this->createMock(
            'Pokemon\Client\Api\Data\HeaderInterfaceFactory'
        );

        $headerFactory->method('create')
            ->willReturnCallback(static fn($args) => new Header(
                name: $args['name'] ?? '',
                value: $args['value'] ?? ''
            ));

        $this->configMock = $this->createMock(
            Config::class
        );

        $this->httpClientMock = $this->getMockForAbstractClass(ClientInterface::class);

        $this->testable = new Client(
            client: $this->httpClientMock,
            responseFactory: $responseFactoryMock
        );

        parent::setUp();
    }

    public function testResponseIsCorrectlyBuild(): void
    {
        $this->httpClientMock->method('getBody')->willReturn('true');
        $this->httpClientMock->method('getStatus')->willReturn(200);

        $response = $this->testable->call(new Request('http://test.localhost', 'GET'));

        $this->assertSame('true', $response->getBody());
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testUnsupportedMethodException(): void
    {
        $response = $this->testable->call(new Request('123', 'PUT'));
        $this->assertSame('Unsupported HTTP method PUT', $response->getBody());
    }
}
