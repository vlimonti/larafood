<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Error Get Products by Tenant
     * ./vendor/bin/phpunit
     * @return void
     */
    public function testGetAllProductsTenantError()
    {
        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(422);
    }

    public function testGetAllProductsByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/products?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    public function testGetProductByIdentifyError()
    {
        $product = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/products/{$product}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    public function testGetProductByIdentify()
    {
        $product = factory(Product::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/products/{$product->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
