<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition(): array
        {
            return [
                'title'       => fake()->sentence(3), // Génère un titre (ex: "Apprendre Laravel AJAX")
                'description' => fake()->paragraph(),
                'status'      => fake()->randomElement(['todo', 'in_progress', 'completed']),
                'progress'    => fake()->numberBetween(0, 100),
                'image'       => null, // On laisse null pour le moment
                'user_id'     => \App\Models\User::factory(), // Crée un user auto si non spécifié
            ];
        }
}
