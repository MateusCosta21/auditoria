<?php

use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::prefix('auditorias')->name('auditorias.')->group(function () {
        Route::get('/', [AuditoriaController::class, 'index'])->name('index');
        Route::get('/criar', [AuditoriaController::class, 'create'])->name('create');
        Route::post('/store', [AuditoriaController::class, 'store'])->name('store');
        Route::get('/{id}/pdf', [RelatorioController::class, 'gerarPDF'])->name('pdf');
    });

    Route::prefix('clientes')->name('clientes.')->group(function () {
        Route::get('/criar-cliente', [ClienteController::class, 'create'])->name('create');
        Route::post('/store', [ClienteController::class, 'store'])->name('store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
