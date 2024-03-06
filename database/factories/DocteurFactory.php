<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Docteur>
 */
class DocteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'utilisateur_id'=>Utilisateur::factory()->create()->id,
            'specialite_id' => 2,
            'annee_experience' => $this->faker->numberBetween(1, 30),
            'statut' => $this->faker->randomElement(['disponible', 'indisponible']),
            ];
            
            
    }
}
