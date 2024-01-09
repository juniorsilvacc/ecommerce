<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = Category::factory()->create()->id;

        return [
            'name' => fake()->unique()->name(),
            'price' => fake()->randomFloat(2, 10, 100),
            'description' => fake()->sentence(20),
            'category_id' => $category_id,
            'image' => fake()->image('public/storage/products', 400, 300, null, false),
        ];
    }
}
