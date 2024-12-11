<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\FactoryService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected FactoryService $factoryService
    )
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        return view('pages.order');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchOrders(Request $request): JsonResponse
    {
        try {
            $orders = $this->orderService
                ->orderList($this->companyId);

            return response()
                ->json([
                    'success' => true,
                    'data' => $orders
                ]);

        } catch (Exception $exception) {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'An error occurred while receiving orders'
                ], 400);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function fetchMarketPlaceOrders(Request $request): JsonResponse
    {
        try {
            $marketPlace = $request->get('marketPlace');
            $result = $this->factoryService
                ->creator($marketPlace, $this->companyId)
                ->fetchOrders($this->companyId);

            return response()
                ->json($result);

        } catch (Exception $exception) {
            return response()
                ->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ], 400);
        }
    }
}
