<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // Capturamos lo que el usuario escribe en el buscador
        $search = $request->input('search');

        // Buscamos libros por Título, Autor o Categoría (Requerimiento #5)
        $books = Book::where('title', 'LIKE', "%{$search}%")
                    ->orWhere('author', 'LIKE', "%{$search}%")
                    ->orWhere('category', 'LIKE', "%{$search}%")
                    ->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validaciones del SENA
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
        ]);

        // Crear el registro en la base de datos
        Book::create($request->all());

        return redirect('/books')->with('success', 'Libro creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscamos el libro por su ID, si no existe lanza error 404
        $book = Book::findOrFail($id);
        
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validamos nuevamente para cumplir requerimientos del SENA
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
        ]);

        $book = Book::findOrFail($id);
        
        // Actualizamos todos los campos enviados
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        
        // Cambiamos el estado a Inactivo (false) en lugar de borrarlo
        $book->update(['is_active' => false]);

        return redirect()->route('books.index')->with('success', 'El libro ha sido inactivado correctamente.');
    }
}
