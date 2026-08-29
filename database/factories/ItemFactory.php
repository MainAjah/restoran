<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->unique()->word(),
            'category_id' => \App\Models\Category::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'food', true),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence(),
            'is_available' => $this->faker->boolean(),
        ];
    }
}
