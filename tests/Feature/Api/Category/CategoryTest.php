<?php

namespace Tests\Feature\Api\Category;

use App\Models\Category;
use Tests\Feature\Trait\Utils;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use Utils;

    public function testFailCreateCategory(): void
    {
        $user = $this->defaultHeaders();

        $response = $this->postJson('/api/v1/categories/create', [], $user);

        $response->assertStatus(422);
    }

    public function testFailUnauthenticatedCreateCategory(): void
    {
        $response = $this->postJson('/api/v1/categories/create', [
            'name' => 'Name Test',
            'description' => 'Description Test',
        ]);

        $response->assertStatus(401);
    }

    public function testCreateCategory(): void
    {
        $user = $this->defaultHeaders();

        $response = $this->postJson('/api/v1/categories/create', [
            'name' => 'Name Test',
            'description' => 'Description Test',
        ], $user);

        $response->assertStatus(201);
    }

    public function testFailUnauthenticatedGetCategory(): void
    {
        $response = $this->postJson('/api/v1/categories/create', [
            'name' => 'Name Test',
            'description' => 'Description Test',
        ]);

        $response->assertStatus(401);
    }

    public function testFailNotFoundGetCategory(): void
    {
        $user = $this->defaultHeaders();

        $nonExistentCategoryId = -1;

        $response = $this->getJson("/api/v1/categories/$nonExistentCategoryId/details", $user);

        $response->assertStatus(404);
    }

    public function testGetCategory(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->id}/details", $user);

        $response->assertStatus(200);
    }

    public function testFailUnauthenticatedGetAllCategory(): void
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(401);
    }

    public function testGetAllCategory(): void
    {
        $user = $this->defaultHeaders();

        $categories = Category::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/categories', $user);

        $response->assertStatus(200)
            ->assertJsonCount(count($categories), 'data');
    }

    public function testFailUnauthenticatedUpdateCategory(): void
    {
        $category = Category::factory()->create();

        // Novos dados para fazer o update
        $newData = [
            'name' => 'Novo Name Test',
            'description' => 'Nova Description Test',
        ];

        $response = $this->putJson("/api/v1/categories/{$category->id}/update", $newData);

        $response->assertStatus(401);
    }

    public function testFailNotFoundUpdateCategory(): void
    {
        $user = $this->defaultHeaders();

        $nonExistentCategoryId = -1;

        $newData = [
            'name' => 'Novo Name Test',
            'description' => 'Nova Description Test',
        ];

        $response = $this->putJson("/api/v1/categories/{$nonExistentCategoryId}/update", $newData, $user);

        $response->assertStatus(404);
    }

    public function testUpdateCategory(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();

        // Novos dados para fazer o update
        $newData = [
            'name' => 'Novo Name Test',
            'description' => 'Nova Description Test',
        ];

        $response = $this->putJson("/api/v1/categories/{$category->id}/update", $newData, $user);

        $response->assertStatus(200);
    }

    public function testFailUnauthenticatedDestroyCategory(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/v1/categories/{$category->id}/delete");

        $response->assertStatus(401);
    }

    public function testFailNotFoundDestroyCategory(): void
    {
        $user = $this->defaultHeaders();

        $nonExistentCategoryId = -1;

        $response = $this->deleteJson("/api/v1/categories/{$nonExistentCategoryId}/delete", [], $user);

        $response->assertStatus(404);
    }

    public function testDestroyCategory(): void
    {
        $user = $this->defaultHeaders();

        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/v1/categories/{$category->id}/delete", [], $user);

        $response->assertStatus(200); // Usando 204 para indicar uma exclusão bem-sucedida
    }
}
