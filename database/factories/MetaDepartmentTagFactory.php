<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaDepartmentTag>
 */
class MetaDepartmentTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_tag_title' => $this->faker->word,
            'department_tag_desc' => $this->faker->sentence,
            'group_name' => $this->faker->randomElement(['group1', 'group2']),

        ];
    }
}