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
        $books = [
            [
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'publisher' => 'Editorial Sudamericana',
                'published_year' => 1967,
                'category' => 'Novela',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'El amor en los tiempos del cólera',
                'author' => 'Gabriel García Márquez',
                'publisher' => 'Editorial Oveja Negra',
                'published_year' => 1985,
                'category' => 'Novela',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Rayuela',
                'author' => 'Julio Cortázar',
                'publisher' => 'Editorial Sudamericana',
                'published_year' => 1963,
                'category' => 'Novela',
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'La casa de los espíritus',
                'author' => 'Isabel Allende',
                'publisher' => 'Editorial Plaza & Janés',
                'published_year' => 1982,
                'category' => 'Novela',
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'El túnel',
                'author' => 'Ernesto Sábato',
                'publisher' => 'Editorial Sur',
                'published_year' => 1948,
                'category' => 'Novela',
                'stock' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Ficciones',
                'author' => 'Jorge Luis Borges',
                'publisher' => 'Editorial Sur',
                'published_year' => 1944,
                'category' => 'Cuento',
                'stock' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'El Aleph',
                'author' => 'Jorge Luis Borges',
                'publisher' => 'Editorial Losada',
                'published_year' => 1949,
                'category' => 'Cuento',
                'stock' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Pedro Páramo',
                'author' => 'Juan Rulfo',
                'publisher' => 'Fondo de Cultura Económica',
                'published_year' => 1955,
                'category' => 'Novela',
                'stock' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'La sombra del viento',
                'author' => 'Carlos Ruiz Zafón',
                'publisher' => 'Editorial Planeta',
                'published_year' => 2001,
                'category' => 'Novela',
                'stock' => 14,
                'is_active' => true,
            ],
            [
                'title' => 'El nombre del viento',
                'author' => 'Patrick Rothfuss',
                'publisher' => 'Editorial Plaza & Janés',
                'published_year' => 2007,
                'category' => 'Fantasía',
                'stock' => 13,
                'is_active' => true,
            ],
            [
                'title' => 'Crónica de una muerte anunciada',
                'author' => 'Gabriel García Márquez',
                'publisher' => 'Editorial La Oveja Negra',
                'published_year' => 1981,
                'category' => 'Novela',
                'stock' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Los detectives salvajes',
                'author' => 'Roberto Bolaño',
                'publisher' => 'Editorial Anagrama',
                'published_year' => 1998,
                'category' => 'Novela',
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'title' => '2666',
                'author' => 'Roberto Bolaño',
                'publisher' => 'Editorial Anagrama',
                'published_year' => 2004,
                'category' => 'Novela',
                'stock' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'El laberinto de la soledad',
                'author' => 'Octavio Paz',
                'publisher' => 'Fondo de Cultura Económica',
                'published_year' => 1950,
                'category' => 'Ensayo',
                'stock' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Veinte poemas de amor y una canción desesperada',
                'author' => 'Pablo Neruda',
                'publisher' => 'Editorial Nascimento',
                'published_year' => 1924,
                'category' => 'Poesía',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Cien sonetos de amor',
                'author' => 'Pablo Neruda',
                'publisher' => 'Editorial Losada',
                'published_year' => 1959,
                'category' => 'Poesía',
                'stock' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'La tregua',
                'author' => 'Mario Benedetti',
                'publisher' => 'Editorial Alfa',
                'published_year' => 1960,
                'category' => 'Novela',
                'stock' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'El otoño del patriarca',
                'author' => 'Gabriel García Márquez',
                'publisher' => 'Editorial Sudamericana',
                'published_year' => 1975,
                'category' => 'Novela',
                'stock' => 3,
                'is_active' => false,
            ],
            [
                'title' => 'La ciudad y los perros',
                'author' => 'Mario Vargas Llosa',
                'publisher' => 'Editorial Seix Barral',
                'published_year' => 1963,
                'category' => 'Novela',
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Conversación en La Catedral',
                'author' => 'Mario Vargas Llosa',
                'publisher' => 'Editorial Seix Barral',
                'published_year' => 1969,
                'category' => 'Novela',
                'stock' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
