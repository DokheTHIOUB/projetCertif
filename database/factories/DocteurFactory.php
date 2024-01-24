<?php

namespace Database\Factories;

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
            'nom' => $this->faker->nom,
            'prenom' => $this->faker->prenom,
            'sexe' => $this->faker->randomElement(['homme', 'femme']),
            'age' => $this->faker->numberBetween(18, 80),
            'telephone' => $this->faker->telephone,
            'role' => $this->faker->randomElement('docteur'),
            'email' => $this->faker->unique()->safeEmail,
            'adresse' => $this->faker->addresse,
            'photo_profil' => $this->faker->imageUrl(),
            'password' => bcrypt('password'), 
            'diplome' => $this->faker->word, 
            'specialite' => $this->faker->word,
            'numero_licence' => $this->faker->randomNumber(),
            'annee_experience' => $this->faker->numberBetween(1, 30),
            'statut' => $this->faker->randomElement(['disponible', 'indisponible']),
            ];
            
            
    }
}
