<?php

namespace App\Library\Marketplaces;

use App\Interfaces\IMarketplace;
use App\Interfaces\IShopify;
use App\Library\Marketplaces\Model\ShopifyAuthModel;
use App\Models\Setting;
use App\Services\OrderService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use JsonException;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Graphql;
use Shopify\Context;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\MissingArgumentException;

class Shopify implements IMarketplace, IShopify
{
    public Graphql $client;

    /**
     * @param string $query
     * @param array $variables
     * @return array|string|null
     * @throws JsonException
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function query(string $query, array $variables = []): array|string|null
    {
        $params['query'] = $query;
        if (!empty($variables)) {
            $params['variables'] = $variables;
        }

        $response = $this->client->query(
            $params,
            extraHeaders: ['Accept-Language' => 'tr-TR']
        );

        return $response->getDecodedBody();
    }

    /**
     * @param ShopifyAuthModel|array $authModel
     * @return void
     * @throws MissingArgumentException
     * @throws Exception
     */
    public function initClient(ShopifyAuthModel|array $authModel): void
    {
        if (!$authModel->getStoreName() || !$authModel->getAdminToken()) {
            throw new Exception(
                'Shopify api failed to initialize. Check store name or admin token'
            );
        }

        Context::initialize(
            $authModel->getAdminToken(),
            $authModel->getAdminToken(),
            ['read_orders'],
            $authModel->getStoreName(),
            new FileSessionStorage(storage_path('framework/sessions')),
            apiVersion: '2024-01'
        );

        $this->client = new Graphql(
            $authModel->getStoreName(),
            $authModel->getAdminToken()
        );
    }

    /**
     * @param string|int $companyId
     * @return array
     * @throws HttpRequestException
     * @throws JsonException
     * @throws MissingArgumentException
     * @throws Exception
     */
    public function fetchOrders(string|int $companyId): array
    {
        $hasNextPage = true;
        $cursor = null;
        $totalOrders = 0;

        $lastYear = now()->subYear()->toDateString();
        $allOrders = [];
        while ($hasNextPage) {
            $filter = 'query: "created_at:>=' . $lastYear . '",first: 250';
            if ($cursor) {
                $filter = 'query: "created_at:>=' . $lastYear . '",first: 250, after: "' . $cursor . '"';
            }
            $query = <<<GRAPHQL
            query {
              orders($filter) {
                pageInfo {
                  hasNextPage
                  endCursor
                }
                edges {
                  cursor
                  node {
                    id
                    name
                    email
                    customer {
                        email
                    }
                    createdAt
                    totalPriceSet {
                      shopMoney {
                        amount
                      }
                    }
                  }
                }
              }
            }
            GRAPHQL;

            $data = $this->query($query);

            if (!isset($data['data']['orders'])) {
                throw new Exception('Shopify no orders found.');
            }

            $orders = $data['data']['orders']['edges'];
            $pageInfo = $data['data']['orders']['pageInfo'];
            $hasNextPage = $pageInfo['hasNextPage'];
            $cursor = $pageInfo['endCursor'];

            foreach ($orders as $order) {
                $node = $order['node'];
                $allOrders[] = [
                    'customer_email_address' => $node['customer']['email'] ?? ($node['email'] ?? 'N/A'),
                    'total_amount' => (float)$node['totalPriceSet']['shopMoney']['amount'],
                    'ordered_date' => Carbon::create($node['createdAt'])->toDateTime(),
                    'company_id' => $companyId,
                    'external_order_number' => $this->gidToShopifyId($node['id']),
                    'order_number' => 'INS-' . Str::random()
                ];
            }

            $totalOrders += count($orders);
        }

        $orderService = new OrderService();
        $orderService->syncBulkOrder($allOrders);

        return [
            'message' => "$totalOrders orders have been synced.",
            'success' => true
        ];
    }

    /**
     * @param string|int $companyId
     * @return ShopifyAuthModel
     */
    public function authHandle(string|int $companyId): ShopifyAuthModel
    {
        $shopifySetting = Setting::query()
            ->where('company_id', $companyId)
            ->get()
            ->first();

        $authModel = new ShopifyAuthModel();
        $authModel
            ->setStoreName($shopifySetting?->shopify_store)
            ->setAdminToken($shopifySetting?->shopify_token);

        return $authModel;
    }

    private function gidToShopifyId(string $gid): string
    {
        return last(explode('/', $gid));
    }
}
