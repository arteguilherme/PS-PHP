<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'type_vehicle_id' => fake()->numberBetween(1, 3),
            'placa' => fake()->regexify('[A-Z]{3}[0-9]{4}'),
            'marca' => fake()->word(),
            'modelo' => fake()->word(),
            'ano' => fake()->year(),
            'cor' => fake()->colorName(),
            'criado_em' => Carbon::parse(fake()->dateTimeBetween('-3 weeks')),
        ];
    }
}
