<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaRiskLevel>
 */
class MetaRiskLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'risk_level_title' => $this->faker->word,
            'risk_level_desc' => $this->faker->sentence,
            'days_required' => $this->faker->numberBetween(1, 30),
            'group_name' => $this->faker->randomElement(['group1', 'group2']),
        ];
    }
}