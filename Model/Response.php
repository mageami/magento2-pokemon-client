<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Model;

use Pokemon\Client\Api\Data\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @param string $body
     * @param int    $statusCode
     */
    public function __construct(
        private readonly string $body,
        private readonly int    $statusCode
    ) {

    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
