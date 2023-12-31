<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->randomNumber(3),
            'active' => $this->faker->boolean(80)
        ];
    }
}
