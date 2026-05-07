<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Notifications\NewBookCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::check()) {
                return redirect()->route('login');
            }

            return $next($request);
        });
    }

    /**
     * Mostrar un listado del recurso.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Book::query();

        if (Auth::user()->role !== 'coordinator') {
            $query->where('is_active', true);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        $books = $query->paginate(5);

        return view('books.index', compact('books'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:255',
            'author' => 'required|string|min:4|max:255',
            'publisher' => 'required|string|min:4|max:255',
            'published_year' => 'required|integer|digits:4',
            'category' => 'required|string|min:4|max:255',
            'stock' => 'required|integer|min:0',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser texto.',
            'title.min' => 'El título debe tener al menos 4 caracteres.',
            'author.required' => 'El autor es obligatorio.',
            'author.string' => 'El autor debe ser texto.',
            'author.min' => 'El nombre del autor debe tener al menos 4 caracteres.',
            'publisher.required' => 'La editorial es obligatoria.',
            'publisher.string' => 'La editorial debe ser texto.',
            'publisher.min' => 'La editorial debe tener al menos 4 caracteres.',
            'published_year.required' => 'El año de publicación es obligatorio.',
            'published_year.integer' => 'El año debe ser un número entero.',
            'published_year.digits' => 'El año debe tener 4 dígitos.',
            'category.required' => 'La categoría es obligatoria.',
            'category.string' => 'La categoría debe ser texto.',
            'category.min' => 'La categoría debe tener al menos 4 caracteres.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'stock.integer' => 'La cantidad debe ser un número entero.',
            'stock.min' => 'La cantidad no puede ser negativa.',
        ]);

        $book = Book::create($request->all());

        if (Auth::user()->role !== 'coordinator') {
            $coordinators = User::query()->where('role', '=', 'coordinator', 'and')->get();
            if ($coordinators->isNotEmpty()) {
                Notification::send($coordinators, new NewBookCreated($book, Auth::user()));
            }
        }

        return redirect('/books')->with('success', 'Libro creado correctamente');
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:255',
            'author' => 'required|string|min:4|max:255',
            'publisher' => 'required|string|min:4|max:255',
            'published_year' => 'required|integer|digits:4',
            'category' => 'required|string|min:4|max:255',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser texto.',
            'title.min' => 'El título debe tener al menos 4 caracteres.',
            'author.required' => 'El autor es obligatorio.',
            'author.string' => 'El autor debe ser texto.',
            'author.min' => 'El nombre del autor debe tener al menos 4 caracteres.',
            'publisher.required' => 'La editorial es obligatoria.',
            'publisher.string' => 'La editorial debe ser texto.',
            'publisher.min' => 'La editorial debe tener al menos 4 caracteres.',
            'published_year.required' => 'El año de publicación es obligatorio.',
            'published_year.integer' => 'El año debe ser un número entero.',
            'published_year.digits' => 'El año debe tener 4 dígitos.',
            'category.required' => 'La categoría es obligatoria.',
            'category.string' => 'La categoría debe ser texto.',
            'category.min' => 'La categoría debe tener al menos 4 caracteres.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'stock.integer' => 'La cantidad debe ser un número entero.',
            'stock.min' => 'La cantidad no puede ser negativa.',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Elimine el recurso especificado del almacenamiento.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->update(['is_active' => false]);

        return redirect()->route('books.index')->with('success', 'El libro ha sido inactivado correctamente.');
    }
}
