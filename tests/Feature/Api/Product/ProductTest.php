<?php

namespace Tests\Feature\Api\Product;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Tests\Feature\Trait\Utils;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use Utils;

    public function testFailCreateProduct(): void
    {
        $user = $this->defaultHeaders();

        $response = $this->postJson('/api/v1/products/create', [], $user);

        $response->assertStatus(422);
    }

    public function testFailUnauthenticatedCreateProduct(): void
    {
        $categoryId = 1;

        $response = $this->postJson('/api/v1/products/create', [
            'category_id' => $categoryId,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => null,
        ]);

        $response->assertStatus(401);
    }

    public function testCreateProduct(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();

        $faker = Factory::create();

        // Crie uma imagem falsa para simular o upload
        $fakeImage = $this->createFakeImage($faker);

        $response = $this->postJson('/api/v1/products/create', [
            'category_id' => $category->id,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => $fakeImage,
        ], $user);

        $response->assertStatus(201);
    }

    public function testFailUnauthenticatedGetProduct(): void
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/v1/products/create', [
            'category_id' => $category->id,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => null,
        ]);

        $response->assertStatus(401);
    }

    public function testFailNotFoundGetProduct(): void
    {
        $user = $this->defaultHeaders();

        $nonExistentProductId = -1;

        $response = $this->getJson("/api/v1/products/$nonExistentProductId/details", $user);

        $response->assertStatus(404);
    }

    public function testGetProduct(): void
    {
        $user = $this->defaultHeaders();

        $product = Product::factory()->create();

        $response = $this->getJson("/api/v1/products/{$product->id}/details", $user);

        $response->assertStatus(200);
    }

    public function testFailUnauthenticatedGetAllProduct(): void
    {
        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(401);
    }

    public function testGetAllProduct(): void
    {
        $user = $this->defaultHeaders();

        $products = Product::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/products', $user);

        $response->assertStatus(200)
            ->assertJsonCount(count($products), 'data');
    }

    public function testFailUnauthenticatedUpdateProduct(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();

        // Novos dados para fazer o update
        $newData = [
            'category_id' => $category->id,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => null,
        ];

        $response = $this->putJson("/api/v1/products/{$product->id}/update", $newData);

        $response->assertStatus(401);
    }

    public function testFailNotFoundUpdateProduct(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();

        $faker = Factory::create();
        $fakeImage = $this->createFakeImage($faker);

        // Tentar atualizar um produto inexistente
        $nonExistentProductId = -1;

        $newData = [
            'category_id' => $category->id,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => $fakeImage,
        ];

        $response = $this->putJson("/api/v1/products/{$nonExistentProductId}/update", $newData, $user);

        $response->assertStatus(404);
    }

    public function testUpdateProduct(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();
        $product = Product::factory()->create();

        $faker = Factory::create();
        $fakeImage = $this->createFakeImage($faker);

        // Novos dados para fazer o update
        $newData = [
            'category_id' => $category->id,
            'name' => 'Name Test',
            'description' => 'Description Test',
            'price' => 20.0,
            'image' => $fakeImage,
        ];

        $response = $this->putJson("/api/v1/products/{$product->id}/update", $newData, $user);

        $response->assertStatus(200);
    }

    public function testFailUnauthenticatedDestroyProduct(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/v1/products/{$product->id}/delete");

        $response->assertStatus(401);
    }

    public function testFailNotFoundDestroyProduct(): void
    {
        $user = $this->defaultHeaders();

        $nonExistentProductId = -1;

        $response = $this->deleteJson("/api/v1/products/{$nonExistentProductId}/delete", [], $user);

        $response->assertStatus(404);
    }

    public function testDestroyProduct(): void
    {
        $user = $this->defaultHeaders();

        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/v1/products/{$product->id}/delete", [], $user);

        $response->assertStatus(200);
    }
}
