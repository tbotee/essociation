<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WaterMeterTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'order' => fake()->numberBetween(1, 100),
            'read_only' => false
        ];
    }

    public function associationMeter(): Factory
    {
        return $this->state([
            'name' => 'association_meter',
            'slug' => 'association-meter',
            'order' => 1,
            'read_only' => true,
        ]);
    }

    public function unitMeter(): Factory
    {
        return $this->state([
            'name' => 'unit_meter',
            'slug' => 'unit-meter',
            'order' => 2,
            'read_only' => true,
        ]);
    }
}
