<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error Get Categories by Tenant
     * ./vendor/bin/phpunit
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    public function testGetCategoryByIdentifyError()
    {
        $category = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    public function testGetCategoryByIdentify()
    {
        $category = factory(Category::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}