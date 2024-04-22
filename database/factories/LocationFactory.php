<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titles = ['Αθήνα', 'Θεσσαλονίκη', 'Πάτρα', 'Ηράκλειο'];

        return [
            'title' => $titles[$this->faker->unique()->numberBetween(0, count($titles) - 1)],
        ];
    }
}
