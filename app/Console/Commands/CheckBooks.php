<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckBooks extends Command
{
    /**
     * consola
     *
     * @var string
     */
    protected $signature = 'app:check-books';

    /**
     *descripción de la consola
     *
     * @var string
     */
    protected $description = 'Mostrar información de los libros en la base de datos';

    /**
     * ejcutar la consola
     */
    public function handle()
    {
        $books = \App\Models\Book::query()->latest('created_at')->take(5)->get();

        $this->info('Últimos 5 libros en la base de datos:');
        $this->table(
            ['ID', 'Título', 'Autor', 'Categoría', 'Stock', 'Activo'],
            $books->map(function ($book) {
                return [
                    $book->id,
                    $book->title,
                    $book->author,
                    $book->category,
                    $book->stock,
                    $book->is_active ? 'Sí' : 'No'
                ];
            })
        );

        $this->info('Total de libros: ' . \App\Models\Book::query()->count('*'));
    }
}
