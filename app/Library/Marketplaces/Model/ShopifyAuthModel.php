<?php

namespace App\Library\Marketplaces\Model;

class ShopifyAuthModel
{
    private ?string $storeName;

    private ?string $adminToken;

    /**
     * @return string|null
     */
    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    /**
     * @param string|null $storeName
     * @return ShopifyAuthModel
     */
    public function setStoreName(?string $storeName): ShopifyAuthModel
    {
        $this->storeName = $storeName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdminToken(): ?string
    {
        return $this->adminToken;
    }

    /**
     * @param string|null $adminToken
     * @return ShopifyAuthModel
     */
    public function setAdminToken(?string $adminToken): ShopifyAuthModel
    {
        $this->adminToken = $adminToken;
        return $this;
    }


}
