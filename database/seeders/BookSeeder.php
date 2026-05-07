<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear 20 libros aleatorios
        for ($i = 0; $i < 20; $i++) {
            Book::create([
                'title' => $faker->sentence(3), // Título de 3 palabras
                'author' => $faker->name,
                'publisher' => $faker->company,
                'published_year' => $faker->numberBetween(1900, 2023),
                'category' => $faker->randomElement(['Novela', 'Ciencia Ficción', 'Historia', 'Biografía', 'Poesía', 'Ensayo']),
                'stock' => $faker->numberBetween(1, 50),
                'is_active' => $faker->boolean(90), // 90% de probabilidad de activo
            ]);
        }
    }
}
