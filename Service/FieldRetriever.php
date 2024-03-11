<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

namespace Pokemon\Client\Service;

use Pokemon\Client\Api\FieldRetrieverInterface;

class FieldRetriever implements FieldRetrieverInterface
{
    /**
     * @param string $fieldName
     * @param string $path
     * @param bool   $returnDataAsArray
     */
    public function __construct(
        private readonly string $fieldName,
        private readonly string $path,
        private readonly bool   $returnDataAsArray = false
    ) {

    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @param array $data
     *
     * @return array|int|float|bool|string|null
     */
    public function getValue(array $data): array|int|float|bool|string|null
    {
        $path = explode('/', $this->path);

        foreach ($path as $part) {
            if ($data === null || is_scalar($data)) {
                return $this->prepareAndReturn($data);
            }
            if (is_array($data) && !array_key_exists($part, $data)) {
                return $this->prepareAndReturn(null);
            }
            $data = $data[$part];
        }

        return $this->prepareAndReturn($data);
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    private function prepareAndReturn(mixed $data): mixed
    {
        if ($data === null) {
            return null;
        }
        if ($this->returnDataAsArray) {
            $data = [$data];
        }

        return $data;
    }
}
