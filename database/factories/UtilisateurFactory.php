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
        'nom' => $this->faker->name(),
        'prenom' => $this->faker->name(),
        'sexe' => $this->faker->randomElement(['homme', 'femme']),
        'age' => $this->faker->numberBetween(18, 80),
        'telephone' => $this->faker->phoneNumber(),
        'role_id' => $this->faker->randomElement([1,2,3]),
        'email' => $this->faker->unique()->safeEmail,
        'adresse' => $this->faker->city(),
        'photo_profil' => $this->faker->imageUrl(),
        'password' => bcrypt('password'), 
        ];

    }
}
