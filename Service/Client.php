<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Service;

use Magento\Framework\HTTP\ClientInterface;
use Pokemon\Client\Api\Data\RequestInterface;
use Pokemon\Client\Api\Data\ResponseInterface;
use Pokemon\Client\Api\Data\ResponseInterfaceFactory;

class Client implements \Pokemon\Client\Api\ClientInterface
{
    /**
     * @param ClientInterface          $client
     * @param ResponseInterfaceFactory $responseFactory
     */
    public function __construct(
        private readonly ClientInterface          $client,
        private readonly ResponseInterfaceFactory $responseFactory
    ) {

    }

    /**
     * @inheritDoc
     */
    public function call(RequestInterface $apiClientRequest): ResponseInterface
    {
        $callable = $this->getHttpCallClosure($apiClientRequest);
        try {
            $callable();
            $this->client->get($apiClientRequest->getUrl());
            $body = $this->client->getBody();
            $statusCode = $this->client->getStatus();
        } catch (\Exception $e) {
            $statusCode = 500;
            $body = $e->getMessage();
        }

        return $this->responseFactory->create([
            'statusCode' => $statusCode,
            'body' => $body
        ]);
    }

    /**
     * @param RequestInterface $apiClientRequest
     *
     * @return \Closure
     */
    private function getHttpCallClosure(RequestInterface $apiClientRequest): \Closure
    {
        return match ($apiClientRequest->getRequestMethod()) {
            RequestInterface::METHOD_GET_NAME => fn() => $this->client->get($apiClientRequest->getUrl()),
            default => static fn() => throw new \Exception(
                sprintf('Unsupported HTTP method %s', $apiClientRequest->getRequestMethod())
            ),
        };
    }
}
