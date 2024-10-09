<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $orderUID = $this->orderService->getOrderUID($id);
        if (empty($orderUID)) {
            return response()->json([
                'message' => 'not found order',
            ], 404);
        }

        $order = $this->orderService->getOrderDetail($orderUID->currency, $id);
        if (empty($order)) {
            return response()->json([
                'message' => 'not found order',
            ], 404);
        }

        return response()->json([
            'id' => $id,
            'name' => $order->name,
            'address' => [
                'city' => $order->city,
                'district' => $order->district,
                'street' => $order->street,
            ],
            'price' => $order->price,
            'currency' => strtoupper($orderUID->currency)
        ]);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $validated = $request->safe()->all();

        $orderUID = $this->orderService->getOrderUID($validated['id']);
        if (!empty($orderUID)) {
            return response()->json([
                'message' => 'duplicate order id',
            ], 409);
        }

        $currency = strtolower($validated['currency']);
        $obj = [
            'id' => $validated['id'],
            'name' => $validated['name'],
            'city' => $validated['address']['city'],
            'district' => $validated['address']['district'],
            'street' => $validated['address']['street'],
            'price' => $validated['price'],
        ];

        OrderCreated::dispatch($currency, $obj);

        return response()->json([
            'message' => 'ok',
        ]);
    }
}
