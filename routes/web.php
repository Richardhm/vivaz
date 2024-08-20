<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceiroController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/buscar_planos',[DashboardController::class,'buscar_planos'])->middleware(['auth', 'verified'])->name('buscar_planos');
    Route::post('/dashboard/orcamento',[DashboardController::class,'orcamento'])->name('orcamento.montarOrcamento');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/financeiro',[FinanceiroController::class,'index'])->name('financeiro.index');
});

require __DIR__.'/auth.php';
