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
            'item_name' => $this->faker->unique()->words(2, true),
            'category_id' => \App\Models\Category::inRandomOrder()->value('id') ?? 1,
            'image' => fake()->randomElement(['https://images.unsplash.com/photo-1550547660-d9450f859349', 'https://images.unsplash.com/photo-1708651343383-2d52c606d981', 'https://images.unsplash.com/photo-1579751626657-72bc17010498']),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'description' => $this->faker->sentence(),
            'is_available' => $this->faker->boolean(),
        ];
    }
}
