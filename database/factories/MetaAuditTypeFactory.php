<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaAuditType>
 */
class MetaAuditTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'audit_title' => $this->faker->word,
            'audit_desc' => $this->faker->sentence,
            'group_name' => $this->faker->randomElement(['group1', 'group2']),

        ];
    }
}