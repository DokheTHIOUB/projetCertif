<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Localite>
 */
class LocaliteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom_localite' => $this->faker->city,
            'code_postal' => $this->faker->postcode,
            'region_id' => function () {
                // Return the id of an existing region or create a new one
                return \App\Models\Region::factory()->create()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
