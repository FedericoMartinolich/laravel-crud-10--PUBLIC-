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
    public function definition(): array
    {
        return [
            "code"=> $this->faker->numberBetween(1,1000),
            "name"=>$this->faker->colorName(),
            "quantity"=>$this->faker->numberBetween(1,10),
            "price"=>$this->faker->numberBetween(1,1000),
            "description"=>$this->faker->sentence(),
        ];
    }
}
