<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashBoardController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [DashBoardController::class, 'profile'])->name('profile');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
    Route::delete('authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    Route::get('/books/create/{authorId}', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

});
