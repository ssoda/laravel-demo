<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreOrder
{
    protected $orderService;

    /**
     * Create the event listener.
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $obj = $event->order;
        $currency = $event->currency;
        $this->orderService->createOrder($currency, $obj);
    }
}
