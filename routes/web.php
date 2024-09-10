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
use App\Http\Controllers\GerenteController;

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
    Route::post('/financeiro/sincronizar_baixas/ja_existente',[FinanceiroController::class,'sincronizarBaixasJaExiste'])->name('financeiro.sincronizar.baixas.jaexiste');

    Route::get('/contratos/cadastrar/coletivo',[FinanceiroController::class,'formCreateColetivo'])->name('contratos.create.coletivo');
    Route::post('/contratos/montarPlanos',[FinanceiroController::class,'montarPlanos'])->name('contratos.montarPlanos');
    Route::post('/contratos',[FinanceiroController::class,'store'])->name('contratos.store');

    Route::get('/financeiro/detalhes/coletivo/{id}',[FinanceiroController::class,'detalhesContratoColetivo'])->name('financeiro.detalhes.contrato.coletivo');

    Route::post('/financeiro/modal/coletivo',[FinanceiroController::class,'modalColetivo'])->name('financeiro.modal.contrato.coletivo');
    Route::post('/financeiro/modal/empresarial',[FinanceiroController::class,'modalEmpresarial'])->name('financeiro.modal.contrato.empresarial');

    Route::post('/financeiro/excluir',[FinanceiroController::class,'excluirCliente'])->name('financeiro.excluir.cliente');

    Route::post('/financeiro/mudarEstadosColetivo',[FinanceiroController::class,'mudarEstadosColetivo'])->name('financeiro.mudarStatusColetivo');

    Route::post('/financeiro/cancelados',[FinanceiroController::class,'cancelarContrato'])->name('financeiro.contrato.cancelados');
    Route::post('/financeiro/baixaDaData',[FinanceiroController::class,'baixaDaData'])->name('financeiro.baixa.data');
    Route::post('/financeiro/empresarial/baixaDaDataEmpresarial',[FinanceiroController::class,'baixaDaDataEmpresarial'])->name('financeiro.baixa.data.empresarial');
    Route::post('/financeiro/editarCampoIndividualmente',[FinanceiroController::class,'editarCampoIndividualmente'])->name('financeiro.editar.campoIndividualmente');

    Route::post('/financeiro/sincronizar',[FinanceiroController::class,'sincronizarDados'])->name('financeiro.sincronizar');
    Route::get('/financeiro/detalhes/{id}',[FinanceiroController::class,'detalhesContrato'])->name('financeiro.detalhes.contrato');

    Route::post('/financeiro/analise/coletivo',[FinanceiroController::class,'emAnaliseColetivo'])->name('financeiro.analise.coletivo');
    Route::post('/financeiro/analise/empresarial',[FinanceiroController::class,'emAnaliseEmpresarial'])->name('financeiro.analise.empresarial');
    Route::post('/financeiro/boleto/coletivo',[FinanceiroController::class,'emissaoColetivo'])->name('financeiro.analise.boleto');

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

    /******Gerente*****/
    Route::get('/gerente',[GerenteController::class,'index'])->name('gerente.index');
    Route::post('/gerente/pegartodos',[GerenteController::class,'pegarTodososDados'])->name('gerente.todos.valores.usuario');
    Route::get('/gerente/listagem',[GerenteController::class,'listagem'])->name('gerente.listagem.em_geral');
    Route::get('/gerente/concluidos',[GerenteController::class,'concluidos'])->name('gerente.listagem.concluidos');
    Route::get('/gerente/comissao/{id}',[GerenteController::class,'listarComissao'])->name('gerente.comissao.listar');
    Route::get('/gerente/detalhe/{id_contrato}',[GerenteController::class,'detalhe'])->name('gerente.listagem.detalhe');
    Route::get('/gerente/pagos/detalhe/{id_contrato}',[GerenteController::class,'detalhePagos'])->name('gerente.pagos.listagem.detalhe');
    Route::post('/gerente/informacoes/corretor',[GerenteController::class,'infoCorretor'])->name('gerente.informacoes.quantidade.corretor');
    Route::post('/gerente/pegar/todos/mes/corrente',[GerenteController::class,'pegarTodosMesCorrente'])->name('gerente.pegar.todos.mes.corrente');
    Route::post('/gerente/historico/informacoes/corretor',[GerenteController::class,'infoCorretorHistorico'])->name('gerente.historico.informacoes.corretor');
    Route::get('/gerente/listar/comissao',[GerenteController::class,'listarUserComissoesAll'])->name('gerente.listagem.comissao');
    Route::get('/gerente/listagem/comissao_mes_atual/{id}',[GerenteController::class,'comissaoMesAtual'])->name('gerente.listagem.comissao_mes_atual');
    Route::get('/gerente/listagem/recebidas/coletivo/{id}',[GerenteController::class,'recebidasColetivo'])->name('gerente.listagem.recebidas.coletivo');
    Route::get('/gerente/listagem/zerar/tabelas',[GerenteController::class,'zerarTabelas'])->name('gerente.listagem.zerar.tabelas');
    Route::post('/gerente/mudar/para_a_nao_pago',[GerenteController::class,'mudarStatusParaNaoPago'])->name('gerente.mudar.para_a_nao_pago');
    Route::get('/gerente/comissao/confirmadas/{id}/{mes?}/{ano?}',[GerenteController::class,'comissaoListagemConfirmadas'])->name('gerente.listagem.confirmadas');
    Route::get('/gerente/estorno/coletivo/{id}',[GerenteController::class,'estornoColetivo'])->name('gerente.estorno.coletivo');
    Route::get('/gerente/estorno/empresarial/{id}',[GerenteController::class,'estornoEmpresarial'])->name('gerente.estorno.empresarial');
    Route::get('/gerente/geral/estorno/{id}',[GerenteController::class,'geralEstorno'])->name('gerente.geral.estorno.listar');
    Route::get('/gerente/mes/geral/estorno/{mes}',[GerenteController::class,'geralEstornoMes'])->name('gerente.mes.geral.estorno.listar');
    Route::post('/gerente/estorno/valor/voltar',[GerenteController::class,'estornoVoltar'])->name('gerente.estorno.valor.voltar');
    Route::post('/gerente/mes/especifico/comissao/confirmadas',[GerenteController::class,'comissaoListagemConfirmadasMesEspecifico'])->name('gerente.listagem.confirmadas.especifica');
    Route::get('/gerente/mes/fechados/confirmados/{ano}/{mes}/{plano}',[GerenteController::class,'comissaoListagemConfirmadasMesFechado'])->name('gerente.mes.fechados.confirmados');
    Route::post('/gerente/totalizar/mes',[GerenteController::class,'totalizarMes'])->name('totalizar.mes.gerente');
    Route::post('/gerente/contrato/estorno',[GerenteController::class,'contratoEstorno'])->name('gerente.contrato.estorno');
    Route::post('/gerente/salario/historico',[GerenteController::class,'salarioUserHistorico'])->name('gerente.salario.user.historico');
    Route::get('/gerente/search/historico',[GerenteController::class,'gerenteBuscarHistorico'])->name('gerente.buscar.historico');
    Route::get('/gerente/comissao/coletivo/confirmadas/{id?}/{mes?}/{ano?}',[GerenteController::class,'comissaoListagemConfirmadasColetivo'])->name('gerente.listagem.coletivo.confirmadas');
    Route::get('/gerente/comissao/empresarial/confirmadas/{id}/{mes?}/{ano?}',[GerenteController::class,'comissaoListagemConfirmadasEmpresarial'])->name('gerente.listagem.empresarial.confirmadas');
    Route::get('/gerente/listagem/empresarial/recebidas/{id}',[GerenteController::class,'recebidoEmpresarial'])->name('gerente.listagem.empresarial.recebidas');
    Route::get('/gerente/listagem/comissao_mes_diferente/{id}',[GerenteController::class,'comissaoMesDiferente'])->name('gerente.listagem.comissao_mes_diferente');





    Route::get('/gerente/coletivo/listar/{id}',[GerenteController::class,'coletivoAReceber'])->name('gerente.listagem.coletivo.areceber');
    Route::get('/gerente/empresarial/listar/{id}',[GerenteController::class,'empresarialAReceber'])->name('gerente.listagem.empresarial.areceber');
    Route::post('/gerente/aplicar/desconto/corretor',[GerenteController::class,'aplicarDescontoCorretor'])->name('gerente.aplicar.desconto');
    Route::post('/gerente/mudar_status',[GerenteController::class,'mudarStatus'])->name('gerente.mudar_status');
    Route::get('/gerente/criar_pdf_pagamento',[GerenteController::class,'criarPdfPagamento'])->name('comissao.create.pdf');
    Route::post('/gerente/mudarcomisao/corretora',[GerenteController::class,'mudarComissaoCorretora'])->name('gerente.mudar.valor.corretora');
    Route::post('/gerente/mudarcomisao/corretor/gerente',[GerenteController::class,'mudarComissaoCorretor'])->name('gerente.mudar.valor.corretor');
    Route::post('/gerente/mudarcomisao/corretor/pago',[GerenteController::class,'mudarComissaoCorretorGerente'])->name('gerente.mudar.valor.pago');
    Route::post('/gerente/administradorapagou/comissao',[GerenteController::class,'administradoraPagouComissao'])->name('gerente.administradorapagoucomissao');
    Route::post('/gerente/pagos/administradorapagou/comissao',[GerenteController::class,'administradoraPagouComissaoPagos'])->name('gerente.administradorapagoucomissao.pagos');
    Route::post('/gerente/finalizar/pagamento',[GerenteController::class,'finalizarPagamento'])->name('gerente.finalizar.pagamento');
    Route::post('/gerente/mes/encerrar',[GerenteController::class,'pagamentoMesFinalizado'])->name('gerente.pagamento.mes.finalizado');
    Route::get('/gerente/finalizar/criarpdf',[GerenteController::class,'criarPDFUser'])->name('gerente.finalizar.criarpdf');
    Route::get('/gerente/historico/finalizar/criarpdf',[GerenteController::class,'criarPDFUserHistorico'])->name('gerente.historico.finalizar.criarpdf');
    Route::post('/gerente/montar/mes/tabela/modal',[GerenteController::class,'montarTabelaMesModal'])->name('montar.tabela.mes.modal');
    Route::get('/gerente/listarcontratosemgeral',[GerenteController::class,'listarcontratos'])->name('gerente.listarcontratos.geral');
    Route::get('/gerente/contrato/{id}',[GerenteController::class,'listarcontratosDetalhe'])->name('gerente.contrato.detalhe');
    Route::get('/gerente/ver/{id_plano?}/{id_tipo?}/{ano?}/{mes?}/{id_user?}',[GerenteController::class,'verDetalheCard'])->name('gerente.contrato.ver.detalhe.card');
    Route::get('/gerente/show/{id_plano?}/{id_tipo?}/{ano?}/{mes?}/{id_user?}',[GerenteController::class,'showDetalheCard'])->name('gerente.contrato.show.detalhe.card');
    Route::get('/gerente/all/ver/{id_estagio}',[GerenteController::class,'showDetalhesDadosTodosAll'])->name('gerente.contrato.show.detalhes.todos.visualizar');
    Route::get('/gerente/all/todos/show/{estagio}',[GerenteController::class,'showTodosDetalheCard'])->name('gerente.contrato.show.detalhes.todos');
    Route::post('/gerente/antecipar/parcela',[GerenteController::class,'aptarPagamento'])->name('gerente.aptar.pagamento');
    Route::post('/gerente/folha_mes/inserir',[GerenteController::class,'cadastrarFolhaMes'])->name('gerente.cadastrar.folha_mes');
    Route::post('/gerente/historico/folha_mes/inserir',[GerenteController::class,'cadastrarHistoricoFolhaMes'])->name('gerente.historico.cadastrar.folha_mes');
    Route::get('/gerente/tabelas/vazias',[GerenteController::class,'tabelaVazia'])->name('gerente.tabelas.vazias');
    Route::get('/listar/gerente/cadastrados',[GerenteController::class,'listarGerenteCadastrados'])->name('listar.gerente.cadastrados');
    Route::post('/gerente/geral/folha/mes/especifica',[GerenteController::class,'geralFolhaMesEspecifica'])->name('geral.folha.mes.especifica');
    Route::post('/gerente/mudar/salario',[GerenteController::class,'mudarSalario'])->name('gerente.mudar.salario');
    Route::post('/gerente/change/premiacao',[GerenteController::class,'mudarPremiacao'])->name('gerente.mudar.premiacao');
    Route::get('/gerente/excel/exportar/{mes}',[GerenteController::class,'exportarContratoExcel'])->name('gerente.excel.exportar');
    Route::get('/gerente/estorno/individual/{id}',[GerenteController::class,'estornoIndividual'])->name('gerente.estorno.individual');
    /******Fim Gerente*****/


});

require __DIR__.'/auth.php';
