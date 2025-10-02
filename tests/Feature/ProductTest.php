<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product_requires_auth_and_valid_data()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $payload = Product::factory()->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => $payload['name']]);

        $this->assertDatabaseHas('products', ['name' => $payload['name']]);
    }

    public function test_get_products_returns_paginated_list()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        Product::factory()->count(3)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'current_page',
                         'data',
                         'per_page',
                         'total',
                         'last_page',
                     ],
                 ]);
    }
}
