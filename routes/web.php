<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');

// Exemplo de rota para processar a submissão do formulário de criação (POST)
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');