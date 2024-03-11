<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Model;

use Pokemon\Client\Api\Data\RequestInterface;
use Pokemon\Client\Api\Data\RequestInterfaceFactory;
use Pokemon\Client\Api\RequestBuilderInterface;

class RequestBuilder implements RequestBuilderInterface
{
    private string $method = RequestInterface::METHOD_GET_NAME;
    private string $uri = '';

    /**
     * @param Config                  $config
     * @param RequestInterfaceFactory $requestFactory
     */
    public function __construct(
        private readonly Config                  $config,
        private readonly RequestInterfaceFactory $requestFactory
    ) {

    }

    /**
     * @inheritDoc
     */
    public function setRequestMethod(string $method): RequestBuilderInterface
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUri(string $uri): RequestBuilderInterface
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function create(): RequestInterface
    {
        try {
            /** @var RequestInterface $request */
            $request = $this->requestFactory->create([
                "url" => $this->getUrl(),
                "method" => $this->method ?? RequestInterface::METHOD_GET_NAME
            ]);
        } finally {
            $this->reset();
        }

        return $request;
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->method = '';
        $this->uri = '';
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        $apiHostName = rtrim($this->config->getEndpoint(), '/');

        if (empty($this->uri)) {
            throw new \InvalidArgumentException('Missing URI for request !');
        }

        $uri = ltrim($this->uri, '/');

        return implode('/', [$apiHostName, $uri]);
    }
}
