<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        
        return [
        'nom' => $this->faker->nom,
        'prenom' => $this->faker->prenom,
        'sexe' => $this->faker->randomElement(['homme', 'femme']),
        'age' => $this->faker->numberBetween(18, 80),
        'telephone' => $this->faker->telephone,
        'role' => $this->faker->randomElement(['admin', 'client', 'docteur']),
        'email' => $this->faker->unique()->safeEmail,
        'adresse' => $this->faker->addresse,
        'photo_profil' => $this->faker->imageUrl(),
        'password' => bcrypt('password'), 
        ];

    }
}
