<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\EstrelaController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\HomeController;

//Route::get('/', function () {
//    return view('welcome');
//});

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
    Route::get('/contratos/cadastrar/empresarial',[FinanceiroController::class,'formCreateEmpresarial'])->name('contratos.create.empresarial');
    //Route::post('/ranking/cadastrar-concessionaria', [RankingController::class, 'cadastrarConcessionaria'])->name('cadastrar.concessionaria');
    Route::post('/ranking/cadastrar-concessionaria', [RankingController::class, 'cadastrarConcessionaria'])->name('cadastrar.concessionaria');
    Route::post('/financeiro/sincronizar_baixas/ja_existente',"App\Http\Controllers\Admin\FinanceiroController@sincronizarBaixasJaExiste")->name('financeiro.sincronizar.baixas.jaexiste');

    Route::get('/contratos/cadastrar/coletivo',[FinanceiroController::class,'formCreateColetivo'])->name('contratos.create.coletivo');
    Route::post('/contratos/montarPlanos',[FinanceiroController::class,'montarPlanos'])->name('contratos.montarPlanos');
    Route::post('/contratos',[FinanceiroController::class,'store'])->name('contratos.store');

    Route::get('/financeiro/detalhes/coletivo/{id}',[FinanceiroController::class,'detalhesContratoColetivo'])->name('financeiro.detalhes.contrato.coletivo');

    Route::post('/financeiro/excluir',[FinanceiroController::class,'excluirCliente'])->name('financeiro.excluir.cliente');

    Route::post('/financeiro/mudarEstadosColetivo',[FinanceiroController::class,'mudarEstadosColetivo'])->name('financeiro.mudarStatusColetivo');

    Route::post('/financeiro/cancelados',[FinanceiroController::class,'cancelarContrato'])->name('financeiro.contrato.cancelados');
    Route::post('/financeiro/baixaDaData',[FinanceiroController::class,'baixaDaData'])->name('financeiro.baixa.data');
    Route::post('/financeiro/editarCampoIndividualmente',[FinanceiroController::class,'editarCampoIndividualmente'])->name('financeiro.editar.campoIndividualmente');

    Route::post('/financeiro/sincronizar',[FinanceiroController::class,'sincronizarDados'])->name('financeiro.sincronizar');
    Route::get('/financeiro/detalhes/{id}',[FinanceiroController::class,'detalhesContrato'])->name('financeiro.detalhes.contrato');

    Route::get('/financeiro/zerar/tabela',[FinanceiroController::class,'zerarTabelaFinanceiro'])->name('financeiro.zerar.financeiro');
    Route::get('/financeiro/coletivo/em_geral',[FinanceiroController::class,'coletivoEmGeral'])->name('financeiro.coletivo.em_geral');
    Route::get('/contratos/empendentes/empresarial',[FinanceiroController::class,'listarContratoEmpresaPendentes'])->name('contratos.listarEmpresarial.listarContratoEmpresaPendentes');
    Route::post('/financeiro/sincronizar/cancelados',[FinanceiroController::class,'sincronizarCancelados'])->name('financeiro.sincronizar.cancelados');
    Route::post('/financeiro/atualizar_dados',[FinanceiroController::class,'atualizarDados'])->name('financeiro.atualizar.dados');
    Route::post('/financeiro/sincronizar_baixas',[FinanceiroController::class,'sincronizarBaixas'])->name('financeiro.sincronizar.baixas');
    Route::post('/financeiro/sincronizar/coletivo',[FinanceiroController::class,'sincronizarDadosColetivo'])->name('financeiro.sincronizar.coletivo');


    Route::post('/contratos/empresarial/financeiro',[FinanceiroController::class,'storeEmpresarialFinanceiro'])->name('contratos.storeEmpresarial.financeiro');



    /************* Home *************/
    Route::get("/",[HomeController::class,'index'])->name("home.index");
    Route::get("/tabela_preco",[HomeController::class,'search'])->name('orcamento.search.home');
    Route::post("/tabela_preco",[HomeController::class,'tabelaPrecoResposta'])->name('tabela.preco.resposta');
    Route::post("/tabela_preco/cidade/resposta",[HomeController::class,'tabelaPrecoRespostaCidade'])->name('tabela.preco.resposta.cidade');
    Route::get("/consultar",[HomeController::class,'consultar'])->name('home.administrador.consultar');
    Route::post("/consultar",[HomeController::class,'consultarCarteirnha'])->name('consultar.carteirinha');
    Route::post("/dashboard/filtrar/user",[HomeController::class,'dashboardFiltrarUser'])->name("dashboard.filtrar.user");
    Route::post("/dashboard/semestre",[HomeController::class,'dashboardSemestre'])->name("dashboard.semestre");
    Route::post("/dashboard/mes",[HomeController::class,'dashboardMes'])->name("dashboard.mes");
    Route::post("/dashboard/ano",[HomeController::class,'dashboardAno'])->name("dashboard.ano");
    Route::post("/dashboard/ranking/semestral",[HomeController::class,'dashboardRankingSemestral'])->name("dashboard.ranking.semestral");
    Route::post("/dashboard/ranking/mes",[HomeController::class,'dashboardRankingmes'])->name("dashboard.ranking.mes");
    Route::post("/dashboard/tabela/ranking/mes",[HomeController::class,'dashboardTabelaRankingmes'])->name("dashboard.tabela.ranking.mes");
    Route::post("/dashboard/ranking/ano",[HomeController::class,'dashboardRankingano'])->name("dashboard.ranking.ano");
    Route::post("/dashboard/grafico/ano",[HomeController::class,'dashboardGraficoAno'])->name("grafico.mudar.ano");
    /******Fim Home*****/




});

require __DIR__.'/auth.php';
