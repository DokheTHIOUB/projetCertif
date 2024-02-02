<?php

namespace Database\Factories;

use App\Models\hopitaux;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'description' => $this->faker->sentence,
            'client_id'=>Utilisateur::factory()->create()->id,
            'hopitauxs_id'=>hopitaux::factory()->create()->id ,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
