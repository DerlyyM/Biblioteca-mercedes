<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirigir la página de inicio a la lista de libros
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas de libros y usuarios
Route::resource('books', BookController::class);
Route::get('/students', [UserController::class, 'index'])->name('students.index');
Route::get('/students/create', [UserController::class, 'create'])->name('students.create');
Route::post('/students', [UserController::class, 'store'])->name('students.store');
Route::post('/students/{id}/toggle', [UserController::class, 'toggle'])->name('students.toggle');

// Notificaciones
Route::middleware('auth')->post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
