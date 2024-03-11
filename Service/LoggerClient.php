<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Service;

use Pokemon\Client\Api\ClientInterface;
use Pokemon\Client\Api\Data\RequestInterface;
use Pokemon\Client\Api\Data\ResponseInterface;
use Psr\Log\LoggerInterface;

class LoggerClient  implements \Pokemon\Client\Api\ClientInterface
{
    /**
     * @param LoggerInterface $logger
     * @param ClientInterface $apiClient
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ClientInterface $apiClient
    ) {

    }

    /**
     * @param RequestInterface $apiClientRequest
     *
     * @return ResponseInterface
     */
    public function call(RequestInterface $apiClientRequest): ResponseInterface
    {
        $this->logger->info(print_r($apiClientRequest, true));

        $response = $this->apiClient->call($apiClientRequest);

        $this->logger->info(print_r($response, true));

        return $response;
    }
}
