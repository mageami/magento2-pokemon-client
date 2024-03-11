<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Api\Data;

interface RequestInterface
{
    public const METHOD_GET_NAME = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string;

    /**
     * @return string
     */
    public function getUrl(): string;
}
