<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MetaInternalExternalAuditQuestion>
 */
class MetaInternalExternalAuditQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_audit_type_id' => $this->faker->numberBetween(1, 10),
            'question' => $this->faker->sentence,
            'status' => $this->faker->boolean,
            'weight' => $this->faker->numberBetween(80, 100),
            'group_name' => $this->faker->randomElement(['group1', 'group2']),

        ];
    }
}