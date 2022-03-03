<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(10_000, 20_000),
            'description' => $this->faker->name(),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
