@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mb-3">
            <a href="{{ route('books.index') }}" class="btn btn-link text-decoration-none p-0">
                <i class="bi bi-arrow-left"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Libro: {{ $book->title }}</h5>
            </div>
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label fw-bold">Título del Libro</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="author" class="form-label fw-bold">Autor</label>
                            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="publisher" class="form-label fw-bold">Editorial</label>
                            <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="published_year" class="form-label fw-bold">Año de Publicación</label>
                            <input type="number" name="published_year" id="published_year" class="form-control" value="{{ old('published_year', $book->published_year) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="category" class="form-label fw-bold">Categoría</label>
                            <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $book->category) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="stock" class="form-label fw-bold">Cantidad disponible</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label for="is_active" class="form-label fw-bold">Estado del Libro</label>
                            <select name="is_active" id="is_active" class="form-select">
                                <option value="1" {{ old('is_active', $book->is_active) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('is_active', $book->is_active) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-arrow-clockwise me-1"></i> Actualizar Información
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection