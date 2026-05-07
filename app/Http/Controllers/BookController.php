<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

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

    private function requireCoordinator()
    {
        if (Auth::user()->role !== 'coordinator') {
            abort(403, 'Acceso no autorizado.');
        }
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
        $this->requireCoordinator();

        return view('books.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        $this->requireCoordinator();

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
        ]);

        Book::create($request->all());

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
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'published_year' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
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
