<?php

namespace App\Services;

use App\Models\OrderJPY;
use App\Models\OrderMYR;
use App\Models\OrderRMB;
use App\Models\OrderTWD;
use App\Models\OrderUSD;
use App\Models\OrderUID;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function getOrderUID(string $orderId)
    {
        return OrderUID::where('id', $orderId)->first();
    }

    public function getOrderDetail(string $currency, string $orderId)
    {
        $order = collect();
        switch ($currency) {
            case 'jpy':
                $order = OrderJPY::where('id', $orderId)->get();
                break;
            case 'myr':
                $order = OrderMYR::where('id', $orderId)->get();
                break;
            case 'rmb':
                $order = OrderRMB::where('id', $orderId)->get();
                break;
            case 'twd':
                $order = OrderTWD::where('id', $orderId)->get();
                break;
            case 'usd':
                $order = OrderUSD::where('id', $orderId)->get();
                break;

            default:
                Log::error('cannot parse currency: {currency}, order id: {orderId}', [
                    'currency' => $currency,
                    'orderId' => $orderId
                ]);
                break;
        }

        return $order->first();
    }

    public function createOrder(string $currency, array $data)
    {
        switch ($currency) {
            case 'jpy':
                OrderJPY::create($data);
                break;
            case 'myr':
                OrderMYR::create($data);
                break;
            case 'rmb':
                OrderRMB::create($data);
                break;
            case 'twd':
                OrderTWD::create($data);
                break;
            case 'usd':
                OrderUSD::create($data);
                break;

            default:
                Log::error('cannot parse currency: {currency}, data: {data}', [
                    'currency' => $currency,
                    'data' => $data
                ]);
                break;
        }

        OrderUID::create([
            'id' => $data['id'],
            'currency' => $currency,
        ]);

        return;
    }
}
