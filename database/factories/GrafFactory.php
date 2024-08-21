<?php

namespace Database\Factories;

use App\Models\Lahan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Graf>
 */
class GrafFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => Lahan::factory(),
            'end' => Lahan::factory(),
            'jarak' => rand(1000, 5000),
            'rute' => '1',
        ];
    }
}
