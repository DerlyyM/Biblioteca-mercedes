<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Redirigir la página de inicio a la lista de libros
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Ruta tipo Resource para todas las operaciones CRUD
Route::resource('books', BookController::class);