<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/galery/{id}', [MainController::class, 'galery'])->name('galery');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        ['label' => 'Адрес',   'value' => 'г. Москва, ул. Большая Семёновская, д. 38'],
        ['label' => 'Телефон', 'value' => '+7 (495) 223-05-23'],
        ['label' => 'E-mail',  'value' => 'info@news-laravel.local'],
        ['label' => 'Часы работы', 'value' => 'Пн-Пт: 9:00–18:00'],
    ];

    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');

Route::middleware('guest')->group(function () {
    Route::get('/signin', [AuthController::class, 'create'])->name('signin');
    Route::post('/signin', [AuthController::class, 'registration'])->name('signin.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
