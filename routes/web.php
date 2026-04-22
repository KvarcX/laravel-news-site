<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/galery/{id}', [MainController::class, 'galery'])->name('galery');

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

Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.store');
