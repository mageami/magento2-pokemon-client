<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Api;

use Pokemon\Client\Api\Data\RequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param string $method
     *
     * @return RequestBuilderInterface
     */
    public function setRequestMethod(string $method): RequestBuilderInterface;

    /**
     * @param string $uri
     *
     * @return RequestBuilderInterface
     */
    public function setUri(string $uri): RequestBuilderInterface;

    /**
     * @return RequestInterface
     */
    public function create(): RequestInterface;
}
