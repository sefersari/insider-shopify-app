<?php

namespace App\Services;

use App\Interfaces\IMarketplace;
use App\Interfaces\IShopify;
use App\Library\Marketplaces\Model\ShopifyAuthModel;
use App\Library\Marketplaces\Shopify;
use Exception;
use Shopify\Exception\MissingArgumentException;

class FactoryService
{
    public IMarketplace|IShopify $marketplaceClass;

    /**
     * @param string $class
     * @param string|int $companyId
     * @return $this
     * @throws MissingArgumentException
     * @throws Exception
     */
    public function creator(string $class, string|int $companyId): self
    {
        $this->marketplaceClass = $this->handleClass($class);
        $authModel = $this->handleAuthModel($class, $companyId);

        $this->marketplaceClass->initClient($authModel);

        return $this;
    }

    /**
     * @param string|int $companyId
     * @return array
     * @throws Exception
     */
    public function fetchOrders(string|int $companyId): array
    {
        return $this->marketplaceClass->fetchOrders($companyId);
    }

    /**
     * @param string $class
     * @param string|int $companyId
     * @return array|ShopifyAuthModel
     */
    private function handleAuthModel(
        string     $class,
        string|int $companyId
    ): array|ShopifyAuthModel
    {
        return match ($class) {
            'Shopify' => $this->marketplaceClass->authHandle($companyId),
            'default' => []
        };
    }

    /**
     * @param $class
     * @return Shopify
     * @throws Exception
     */
    private function handleClass($class): Shopify
    {
        return match ($class) {
            'Shopify' => new Shopify(),
            'default' => throw new Exception('This marketplace is not supported')
        };
    }
}
