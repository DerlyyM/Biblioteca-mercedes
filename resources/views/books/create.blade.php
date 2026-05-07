@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Registrar Nuevo Libro</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Autor</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Editorial</label>
                            <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Año de Publicación</label>
                            <input type="number" name="published_year" class="form-control" value="{{ old('published_year') }}" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Categoría</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cantidad (Stock)</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                        </div>
                    </div>
                    <div class="mt-4 border-top pt-3">
                        <button type="submit" class="btn btn-primary">Guardar Libro</button>
                        <a href="{{ route('books.index') }}" class="btn btn-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection