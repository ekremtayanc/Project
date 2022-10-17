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
    public function definition()
    {
        return [
            //
            'identity_number' => fake()->unique()->numerify('###########'),
            'student_name' => fake()->firstName(),
            'student_surname' => fake()->lastName(),
            'school_name' => fake()->company(),
            'student_number' => fake()->unique()->numerify('###########'),
        ];
    }
}
