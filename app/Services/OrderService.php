<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    /**
     * @param string|int $companyId
     * @return LengthAwarePaginator
     */
    public function orderList(string|int $companyId): LengthAwarePaginator
    {
        return Order::query()
            ->where('company_id', $companyId)
            ->paginate(15);
    }

    /**
     * @param array $orders
     * @return void
     */
    public function syncBulkOrder(array $orders): void
    {
        $chunkedOrders = array_chunk($orders, 100);
        foreach ($chunkedOrders as $order) {
            Order::query()
                ->upsert($order, $order);
        }
    }
}
