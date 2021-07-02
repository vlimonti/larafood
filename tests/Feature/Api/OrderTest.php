<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testValidationCreateNewOrder()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422);
    }

    public function testCreateNewOrder()
    {
        $tenant = factory(Tenant::class)->create();
        
        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 10)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();
        
        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 2)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
                ->assertJsonPath('data.total', 42);
    }

    public function testOrderNotFound()
    {
        $order = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }

    public function testGetOrder()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    public function testCreateNewOrderAuth()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = factory(Tenant::class)->create();
        
        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 1)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(201);
    }
}
