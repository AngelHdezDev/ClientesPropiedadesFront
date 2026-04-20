<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Catalog\AutoController;
use App\Http\Controllers\Dashboard\PropertyController;

Route::get('/', [DashboardController::class, 'index'])->name('client.dashboard');
Route::get('/propiedades', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/propiedad/{slug}', [PropertyController::class, 'show'])->name('properties.show');


Route::get('/autos', [AutoController::class, 'index'])->name('autos.index');

// Usamos un nombre de ruta para referenciarlo fácilmente en la vista
Route::get('/auto/{id}', [AutoController::class, 'show'])->name('autos.show');


