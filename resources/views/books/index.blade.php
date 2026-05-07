@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 font-weight-bold text-primary">Catálogo de Libros</h5>
        <a href="{{ route('books.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle"></i> Registrar Nuevo Libro
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('books.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por título, autor o categoría..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td><strong>{{ $book->title }}</strong></td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge bg-info text-dark">{{ $book->category }}</span></td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            @if($book->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('¿Inactivar este libro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Inactivar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron libros.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection