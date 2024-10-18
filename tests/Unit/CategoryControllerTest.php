<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_index_returns_successful_response()
    {
        Category::factory(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

//    public function test_store_creates_new_product()
//    {
//        $category = Category::factory()->create();
//        $response = $this->postJson('/api/categories', [
//            'name' => 'New Category',
//            'description' => 'This is a new product',
//            'price' => 100,
//            'category_id' => $category->id,
//        ]);
//        $response->assertStatus(201)
//            ->assertJsonFragment(['name' => 'New Category']);
//    }

    public function test_store_fails_with_invalid_data()
    {
        $response = $this->postJson('/api/categories', [
            'name' => '',

        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_show_returns_product()
    {
        $product = Category::factory()->create();

        $response = $this->getJson("/api/categories/$product->id");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $product->name]);
    }

    public function test_show_fails_for_nonexistent_product()
    {
        $response = $this->getJson('/api/categories/8');

        $response->assertStatus(404);
    }

//    public function test_update_modifies_existing_product()
//    {
//        $categories = Category::factory()->create();
//
//        $response = $this->putJson("/api/categories/{$categories->id}", [
//            'name' => 'Updated Category',
//            'description' => 'This is a new product',
//            'image' => 'image.png',
//            'parent_id' => $categories->parent_id,
//        ]);
//
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => 'Updated Category']);
//    }

    public function test_update_fails_with_invalid_data()
    {
        $product = Category::factory()->create();

        $response = $this->putJson("/api/categories/$product->id", [
            'name' => '', // Invalid name
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_destroy_removes_product()
    {
        $categories = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$categories->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $categories->id]);
    }

    public function test_destroy_fails_for_nonexistent_product()
    {
        $response = $this->deleteJson('/api/categories/999');

        $response->assertStatus(404);
    }
}
