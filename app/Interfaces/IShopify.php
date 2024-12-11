<?php

namespace App\Interfaces;

use App\Library\Marketplaces\Model\ShopifyAuthModel;

interface IShopify
{
    /**
     * @param string $query
     * @param array $variables
     * @return array|string|null
     */
    public function query(string $query, array $variables = []): array|string|null;

    /**
     * @param ShopifyAuthModel $authModel
     * @return void
     */
    public function initClient(ShopifyAuthModel $authModel): void;

    /**
     * @param string|int $companyId
     * @return ShopifyAuthModel
     */
    public function authHandle(string|int $companyId): ShopifyAuthModel;
}
