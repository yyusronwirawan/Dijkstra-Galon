<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permission
        Permission::create(['name' => 'show dashboard']);
        Permission::create(['name' => 'show lokasi']);
        Permission::create(['name' => 'show profile']);
        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'show graf']);
        Permission::create(['name' => 'logout']);

        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);


        // create role and assign existing permissions
        $admin = Role::create(['name' => 'Super-Admin']);

        $pengguna = Role::create(['name' => 'pengguna']);
        $pengguna->givePermissionTo(['show dashboard', 'show profile', 'show lokasi', 'logout']);

        $superadmin = User::factory()->create(['name' => 'Admin', 'email' => 'admin@app.com']);
        $superadmin->assignRole('Super-Admin');

        $dummyPengguna = User::factory()->count(20)->create();
        $dummyPengguna->map(function ($pengguna, $value) {
            $pengguna->assignRole('Pengguna');
        });
        $pengguna = User::factory()->create(['name' => 'user', 'email' => 'user@app.com']);
        $pengguna->assignRole('Pengguna');
    }
}
