<?php

use App\Http\Controllers\AuditoriaController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/auditorias', [AuditoriaController::class, 'index'])->name('auditorias.index');
    Route::get('/criar', [AuditoriaController::class, 'create'])->name('auditorias.create');
    Route::post('/store', [AuditoriaController::class, 'store'])->name('auditorias.store');
    Route::get('/auditoria/{id}/pdf', [RelatorioController::class, 'gerarPDF'])->name('auditoria.pdf');

});

require __DIR__.'/auth.php';
