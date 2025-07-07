<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test API get orders
     * @return void
     */
    public function test_api_get_orders(): void
    {
        Order::factory()->count(100)->create();

        $orders = $this->getJson(route('api.orders.index'));

        $orders->assertStatus(200);

        $orders->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'bl_release_date',
                    'bl_release_user_id',
                    'freight_payer_self',
                    'contract_number',
                    'bl_number',
                    'notification_sent'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    /**
     * Test API create order and queue
     * @return void
     */
    public function test_api_create_order_and_queue(): void
    {
        $user = User::factory()->create();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = [
            'bl_release_date' => $now,
            'bl_release_user_id' => $user->id,
            'freight_payer_self' => false,
            'contract_number' => 12345,
            'bl_number' => 12345
        ];

        $response = $this->postJson(route('api.orders.create'), $data);

        $this->assertEquals($response['bl_release_date'], $now);
        $this->assertEquals($response['bl_release_user_id'], $user->id);
        $this->assertEquals($response['freight_payer_self'], false);
        $this->assertEquals($response['contract_number'], 12345);
        $this->assertEquals($response['bl_number'], 12345);
        $this->assertEquals($response['notification_sent'], true);
    }

    /**
     * Test API create order and not queue
     * @return void
     */
    public function test_api_create_order_and_not_queue(): void
    {
        $user = User::factory()->create();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = [
            'bl_release_date' => $now,
            'bl_release_user_id' => $user->id,
            'freight_payer_self' => true,
            'contract_number' => 12345,
            'bl_number' => 12345
        ];

        $response = $this->postJson(route('api.orders.create'), $data);

        $order = Order::find($response['id']);
        $this->assertEquals($order['bl_release_date'], $now);
        $this->assertEquals($order['bl_release_user_id'], $user->id);
        $this->assertEquals($order['freight_payer_self'], true);
        $this->assertEquals($order['contract_number'], 12345);
        $this->assertEquals($order['bl_number'], 12345);
        $this->assertEquals($order['notification_sent'], false);
    }
}
