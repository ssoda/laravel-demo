<?php

namespace Tests\Unit;

use App\Events\OrderCreated;
use App\Listeners\StoreOrder;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_order_based_on_currency()
    {
        $orderService = new OrderService();

        $listener = new StoreOrder($orderService);

        $orderData = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road',
            'price' => '2050'
        ];

        // JPY
        $event = new OrderCreated('jpy', $orderData);
        $listener->handle($event);

        $this->assertDatabaseHas('orders_jpy', $orderData);
        $this->assertDatabaseHas('orders_uid', ['id' => 'A0000001', 'currency' => 'jpy']);

        // MYR
        $orderData['id'] = 'A0000002';
        $event = new OrderCreated('myr', $orderData);
        $listener->handle($event);

        $this->assertDatabaseHas('orders_myr', $orderData);
        $this->assertDatabaseHas('orders_uid', ['id' => 'A0000002', 'currency' => 'myr']);

        // RMB
        $orderData['id'] = 'A0000003';
        $event = new OrderCreated('rmb', $orderData);
        $listener->handle($event);

        $this->assertDatabaseHas('orders_rmb', $orderData);
        $this->assertDatabaseHas('orders_uid', ['id' => 'A0000003', 'currency' => 'rmb']);

        // TWD
        $orderData['id'] = 'A0000004';
        $event = new OrderCreated('twd', $orderData);
        $listener->handle($event);

        $this->assertDatabaseHas('orders_twd', $orderData);
        $this->assertDatabaseHas('orders_uid', ['id' => 'A0000004', 'currency' => 'twd']);

        // USD
        $orderData['id'] = 'A0000005';
        $event = new OrderCreated('usd', $orderData);
        $listener->handle($event);

        $this->assertDatabaseHas('orders_usd', $orderData);
        $this->assertDatabaseHas('orders_uid', ['id' => 'A0000005', 'currency' => 'usd']);
    }
}
