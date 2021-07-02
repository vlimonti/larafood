<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    public function testAuthClientFake()
    {
        $payload = [
            'email' => 'zazazaz@email.com.br',
            'password' => '99999',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                ->assertExactJson([
                    'message' => 'Credenciais Inválidas',
                ]);
    }

    public function testAuthSuccessClient()
    {
        $client = factory(Client::class)->create();
        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
                ->assertJsonStructure(['token']);
    }

    public function testErrorGetMe()
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    public function testGetMe()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [
                        'name' => $client->name,
                        'email' => $client->email,
                    ]
                ]);
    }

    public function testLogout()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}
