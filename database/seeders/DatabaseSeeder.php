<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionDemoSeeder::class
        ]);

        \App\Models\Lahan::factory(5)->create();
        // \App\Models\Graf::factory(5)->create();
    }
}
