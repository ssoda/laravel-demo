<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 建立訂單 - 測試輸入參數正確，並成功建立訂單
     */
    public function test_create_order_input_and_order_created_successfully()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD'
        ]);

        $response->assertStatus(200);

        $queryResponse = $this->getJson("/api/orders/A0000001");

        $queryResponse->assertStatus(200);
        $queryResponse->assertJson([
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD'
        ]);
    }

    /**
     * 建立訂單 - 測試缺少參數
     */
    public function test_create_order_missing_required_fields()
    {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['id']);


        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                // 'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['address.district']);
    }

    /**
     * 建立訂單 - 測試無效的幣別
     */
    public function test_create_order_invalid_currency()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'GG',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['currency']);
    }

    /**
     * 建立訂單 - 測試重複輸入的訂單號
     */
    public function test_create_order_id_conflict()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD',
        ]);

        $response->assertStatus(200);

        $conflictResponse = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => '2050',
            'currency' => 'TWD',
        ]);

        $conflictResponse->assertStatus(409);
    }
}
