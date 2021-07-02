<?php

namespace Tests\Feature\Api;

use App\Models\Tables;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error Get Tables by Tenant
     * ./vendor/bin/phpunit
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    public function testGetTableByIdentifyError()
    {
        $table = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    public function testGetTableByIdentify()
    {
        $table = factory(Tables::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
