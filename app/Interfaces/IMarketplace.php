<?php

namespace App\Interfaces;

interface IMarketplace
{
    /**
     * @param array $authModel
     * @return void
     */
    public function initClient(array $authModel): void;

    /**
     * @param string|int $companyId
     * @return array
     */
    public function fetchOrders(string|int $companyId): array;
}
