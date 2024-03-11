<?php
/**
 * Copyright © Fast White Cat S.A. All rights reserved.
 * See LICENSE_FASTWHITECAT for license details.
 */

declare(strict_types=1);

namespace Pokemon\Client\Api;

interface FieldRetrieverInterface
{
    /**
     * @return string
     */
    public function getFieldName(): string;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getValue(array $data): mixed;
}
