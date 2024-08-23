<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\EstrelaController;
use App\Http\Controllers\RankingController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/orcamento',[OrcamentoController::class,'index'])->name('orcamento');
    Route::post('/buscar_planos',[OrcamentoController::class,'buscar_planos'])->middleware(['auth', 'verified'])->name('buscar_planos');
    Route::post('/dashboard/orcamento',[OrcamentoController::class,'orcamento'])->name('orcamento.montarOrcamento');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/financeiro',[FinanceiroController::class,'index'])->name('financeiro.index');

    Route::get('/contratos/cadastrar/individual',[FinanceiroController::class,'formCreate'])->name('financeiro.formCreate');
    Route::get("/financeiro/individual/em_geral/{mes?}",[FinanceiroController::class,'geralIndividualPendentes'])->name('financeiro.individual.geralIndividualPendentes');
    Route::post('/contratos/montarPlanosIndividual',[FinanceiroController::class,'montarPlanosIndividual'])->name('contratos.montarPlanosIndividual');
    Route::post('/contratos/individual',[FinanceiroController::class,'storeIndividual'])->name('individual.store');

    Route::post("/pdf",[ImagemController::class,'criarPDF'])->name('gerar.imagem');

    Route::get("/estrela",[EstrelaController::class,'index'])->name('estrela.index');

    Route::get('/ranking',[RankingController::class,'index'])->name('ranking.index');
    Route::get('/dashboard/filtragem',[RankingController::class,'filtragem'])->name('ranking.filtragem');
    Route::post('/ranking/cadastrar-concessionaria', [RankingController::class, 'cadastrarConcessionaria'])->name('cadastrar.concessionaria');




});

require __DIR__.'/auth.php';
