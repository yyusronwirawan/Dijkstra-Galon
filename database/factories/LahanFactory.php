<?php

namespace Database\Factories;

use App\Models\Node;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lahan>
 */
class LahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'node_id' => Node::factory(),
            'user_id' => User::factory(),
            'nama' => 'Lahan ' . rand(10, 20),
            'komoditas' => 'Komoditas ' . rand(10, 20),
            'luas' => '200m2',
            'nama_pemilik' => fake()->name(),
            'alamat_pemilik' => fake()->name(),
            'no_hp' => fake()->phoneNumber(),
            'harga' => 'Rp 200.000 / kg',
            'estimasi_panen' => ' Bulan',
        ];
    }
}
