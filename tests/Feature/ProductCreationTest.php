<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class ProductCreationTest extends TestCase
{
    // use RefreshDatabase;

    public function test_authenticated_user_can_create_product()
    {
        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        $category = Category::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'price' => 45000,
            'description' => 'This is a test product',
            'category_id' => $category->id,
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/products', $productData);

        $response->assertStatus(200)->assertJson([
            'status' => true,
            'data' => [
                'name' => 'Test Product',
                'price' => 45000,
                'description' => 'This is a test product',
                'category_id' => $category->id,
            ],
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 45000,
            'category_id' => $category->id,
        ]);
    }
}
