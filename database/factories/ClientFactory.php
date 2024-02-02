<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    public function definition(): array
    {
        return [
          'utilisateur_id'=>Utilisateur::factory()->create()->id 
        ];
    }
}
