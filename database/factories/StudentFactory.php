<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "dni"=>$this->faker->numberBetween(1,99999999),
            "name"=> $this->faker->firstName(),
            "surname"=> $this->faker->lastName(),
            "group"=>$this->faker->randomElement(['A','B']),
            "academic_year"=>$this->faker->numberBetween(1,5),
            "birth"=>$this->faker->dateTime($max = 'now'),
        ];
    }
}
