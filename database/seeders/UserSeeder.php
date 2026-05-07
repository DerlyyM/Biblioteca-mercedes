<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear coordinadora con acceso administrativo
        User::create([
            'name' => 'Coordinadora Mercedes',
            'email' => 'coordinadora@example.com',
            'password' => Hash::make('coordinadora123'),
            'role' => 'coordinator',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Crear 10 estudiantes aleatorios
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Contraseña por defecto
                'role' => 'student',
                'is_active' => $faker->boolean(80),
                'email_verified_at' => now(),
            ]);
        }
    }
}