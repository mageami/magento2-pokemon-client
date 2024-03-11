<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Api;

use Pokemon\Client\Api\Data\RequestInterface;
use Pokemon\Client\Api\Data\ResponseInterface;

interface ClientInterface
{
    /**
     * @param RequestInterface $apiClientRequest
     *
     * @return ResponseInterface
     */
    public function call(RequestInterface $apiClientRequest): ResponseInterface;
}
