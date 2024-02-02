<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HopitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom_hopital' => $this->faker->word,
            'description' => $this->faker->sentence,
            'lattitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'horaire' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'localite_id' => function () {
                // Return the id of an existing localite or create a new one
                return \App\Models\Localite::factory()->create()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
