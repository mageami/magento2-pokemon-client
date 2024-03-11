<?php
/**
 * Copyright © AmiCode All rights reserved.
 */

declare(strict_types=1);

namespace Pokemon\Client\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config
{
    private const XML_PATH_POKEMON_API_GENERAL_ENABLED = 'pokemon_api/general/enabled';
    private const XML_PATH_POKEMON_API_GENERAL_ENDPOINT = 'pokemon_api/general/endpoint';

    /**
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface  $scopeConfig
     */
    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        private readonly ScopeConfigInterface  $scopeConfig
    ) {
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_POKEMON_API_GENERAL_ENABLED);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_POKEMON_API_GENERAL_ENDPOINT);
    }
}
