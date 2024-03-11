<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Api\Data;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function getBody(): string;


    /**
     * @return int
     */
    public function getStatusCode(): int;
}
