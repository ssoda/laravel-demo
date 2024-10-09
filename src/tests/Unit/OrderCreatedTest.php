<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Events\OrderCreated;

class OrderCreatedTest extends TestCase
{
    public function test_event_contains_correct_data()
    {
        $currency = 'twd';
        $orderData = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road',
            'price' => '2050'
        ];

        $event = new OrderCreated($currency, $orderData);

        $this->assertEquals($currency, $event->currency);
        $this->assertEquals($orderData, $event->order);
    }
}
