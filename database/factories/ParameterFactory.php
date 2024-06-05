<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parameter>
 */
class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            "classes"=>$this->faker->numberBetween(1,191),
            "free"=>$this->faker->numberBetween(0,10),
            "regular"=>$this->faker->numberBetween(50,60),
            "promotion"=>$this->faker->numberBetween(70,80),
        ];
    }
}
