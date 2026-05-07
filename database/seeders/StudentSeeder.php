<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Estudiante de Prueba',
            'email' => 'estudiante@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}