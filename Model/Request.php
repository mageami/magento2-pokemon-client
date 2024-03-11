<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Model;

use Pokemon\Client\Api\Data\RequestInterface;

class Request implements RequestInterface
{
    /**
     * @param string $url
     * @param string $method
     */
    public function __construct(
        private readonly string $url,
        private readonly string $method = self::METHOD_GET_NAME
    ) {

    }

    /**
     * @inheritDoc
     */
    public function getRequestMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
