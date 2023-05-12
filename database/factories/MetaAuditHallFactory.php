<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaAuditHall>
 */
class MetaAuditHallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hall_title' => $this->faker->word,
            'hall_location' => $this->faker->sentence,
            'hall_desc' => $this->faker->sentence,
            'group_name' => $this->faker->randomElement(['group1', 'group2']),

        ];
    }
}