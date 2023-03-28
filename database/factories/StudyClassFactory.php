<?php

namespace Database\Factories;

use App\Models\StudyClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudyClass>
 */
class StudyClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Class ' . fake()->jobTitle(),
            'desc' => fake()->paragraph(),
            'status' => fake()->numberBetween(-1, 1)
        ];
    }
}
