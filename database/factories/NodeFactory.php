<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'latitude' => fake()->latitude(-7.264891730445153, -7.284891730445153),
            'longitude' => fake()->longitude(112.73671634308987, 112.75671634308987),
            'tipe' => 'lahan',
        ];
    }
}
