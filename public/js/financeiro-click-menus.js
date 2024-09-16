$(".btn-atualizar").on('click', function() {
    $("#atualizarModal").removeClass('hidden').addClass('flex');
});

// Fechar a modal ao clicar no botão de fechar
$(".close-modal").on('click', function() {
    $("#atualizarModal").removeClass('flex').addClass('hidden');
});

$(window).on('click', function(event) {
    if ($(event.target).is('#atualizarModal')) {
        $("#atualizarModal").removeClass('flex').addClass('hidden');
    }
});

function atualizarParcelas() {
    let mes = $("#mudar_mes_table").val();
    let dataId = $("#select_usuario_individual").find('option:selected').data('id');

    // Atualizar a contagem de todas as parcelas
    table_individual.column(11).search('').draw();

    atualizarQuantidadeParcela(1, 'Pag. 1º Parcela');
    atualizarQuantidadeParcela(2, 'Pag. 2º Parcela');
    atualizarQuantidadeParcela(3, 'Pag. 3º Parcela');
    atualizarQuantidadeParcela(4, 'Pag. 4º Parcela');
    atualizarQuantidadeParcela(5, 'Pag. 5º Parcela');
}


function atualizarQuantidadeParcela(numeroParcela, filtro) {
    // Filtra a tabela para cada parcela e atualiza a quantidade exibida
    table_individual.column(9).search(filtro).draw();
    let quantidade = table_individual.rows({ filter: 'applied' }).count();

    // Atualiza o valor exibido na UI
    $(".individual_quantidade_" + numeroParcela + "_parcela").text(quantidade);
}


// Função para atualizar a filtragem da tabela
function updateFiltragemParcela(id_lista) {
    if (id_lista == "aguardando_pagamento_1_parcela_individual") {
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 1º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 1º Parcela').draw();
    } else if (id_lista == "aguardando_pagamento_2_parcela_individual") {

        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 2º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 2º Parcela').draw();
    } else if (id_lista == "aguardando_pagamento_3_parcela_individual") {
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 3º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 3º Parcela').draw();
    } else if (id_lista == "aguardando_pagamento_4_parcela_individual") {
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 4º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 4º Parcela').draw();
    } else if (id_lista == "aguardando_pagamento_5_parcela_individual") {
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 5º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 5º Parcela').draw();
    }
}

// Listener para clique nas parcelas


// Listener para mudanças nos selects (mês, ano, usuário)







$('button[data-corretora]').on('click', function() {
    let corretora_id = $(this).data('corretora');
    if($("#janela_atual").val() == "aba_individual") {
        inicializarIndividual(corretora_id);
    } else if($("#janela_atual").val() == "aba_coletivo") {
        inicializarColetivo(corretora_id);
    } else {
        inicializarEmpresarial(corretora_id);
    }
});

$('.modal_upload').on('click', function() {
    $('#uploadModal').addClass('show');
});

$('#uploadModal .close, #uploadModal').on('click', function() {
    $('#uploadModal').removeClass('show');
});


$(".list_abas li").on('click',function(){
    $('li').removeClass('ativo');
    $(this).addClass("ativo");
    let id = $(this).attr('data-id');
    $("#janela_atual").val(id);
    $("#janela_ativa").val(id);
    default_formulario = $('.coluna-right.'+id).html();
    $('.conteudo_abas main').addClass('ocultar');
    $('#'+id).removeClass('ocultar');
    $('#'+id).removeClass('hidden');
    $('.next').attr('data-cliente','');
    $('.next').attr('data-contrato','');
    $('tr').removeClass('textoforte');
    if($(this).attr('data-id') == "aba_individual") {
        inicializarIndividual();
    } else if($(this).attr('data-id') == "aba_coletivo") {
        inicializarColetivo();
        $('#mudar_mes_table').find('option').eq(0).prop('selected', true);
    } else {
        inicializarEmpresarial();
    }
    $("#cliente_id_alvo").val('');
    $("#cliente_id_alvo_individual").val('');
    $("#all_pendentes_individual").removeClass('textoforte-list');
    $("ul#listar li.coletivo").removeClass('textoforte-list');
    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
    $("ul#listar_individual li.individual").removeClass('textoforte-list');
    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
    $("ul#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list');
});







$("#atrasado_corretor_coletivo").on('click',function(){
    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Atrasado</h4>");
    table.column(9).search('').draw();
    table.column(11).search('Atrasado').draw();
    $(".container_edit").addClass('ocultar');
    $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("ul#listar li.coletivo").removeClass('textoforte-list').removeClass('destaque_content');
    $("#grupo_finalizados").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');
});





$("#list_individual_begin").on('click',function(){

    table_individual.column(9).search('').draw();
    table_individual.column(11).search('').draw();
    let mes = $("#mudar_mes_table").val() == '' || $("#mudar_mes_table").val() == null ? '00' : $("#mudar_mes_table").val();
    let valorSelecionado = $("#select_usuario_individual").val();

    $("ul#listar_individual li.individual").removeClass('textoforte-list').removeClass('destaque_content');
    $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
    //$("#content_list_individual_begin").addClass('destaque_content_radius');
    //$('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");

    if(mes != 00) {
        let ano = $("#mudar_ano_table").val();
        table_individual.search('').columns().search('').draw();
        let mesAno = mes + '/' + ano;
        table_individual.column(0).search(mesAno, true, false).draw();
    } else {
        table_individual.column(0).search('').draw();
    }

    if(valorSelecionado != "todos") {
        table_individual.column(2).search(valorSelecionado).draw();
    } else {
        table_individual.column(2).search('').draw();
    }

    let dadosColuna9 = table_individual.column(9,{search: 'applied'}).data();
    let dadosColuna11 = table_individual.column(11,{search: 'applied'}).data();
    let dadosColuna00 = table_individual.column(0,{search: 'applied'}).data();



    let primeiraParcelaIndividual = 0;
    let segundaParcelaIndividual = 0;
    let terceiraParcelaIndividual = 0;
    let quartaParcelaIndividual = 0;
    let quintaParcelaIndividual = 0;
    let sextaParcelaIndividual = 0;
    let canceladosIndividual = 0;
    let atrasadoIndividual = 0;


    dadosColuna9.each(function (valor) {

        if (valor.toLowerCase() == 'pag. 1º parcela') {primeiraParcelaIndividual++;}
        if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcelaIndividual++;}
        if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcelaIndividual++;}
        if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcelaIndividual++;}
        if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcelaIndividual++;}
        if (valor.toLowerCase() == 'finalizado') {sextaParcelaIndividual++;}
        if (valor.toLowerCase() == 'cancelado') {canceladosIndividual++;}

    });

    dadosColuna11.each(function (valor) {
        if (valor.toLowerCase() == 'atrasado') {atrasadoIndividual++;}
    });

    let countAprovado = dadosColuna11.filter((value, index) =>  value === 'Aprovado').length;

    let total = dadosColuna00.count(); // Inicialmente, contamos todas as linhas

    atrasadoIndividual = total - sextaParcelaIndividual - canceladosIndividual - countAprovado;

    $(".individual_quantidade_1_parcela").text(primeiraParcelaIndividual);
    $(".individual_quantidade_2_parcela").text(segundaParcelaIndividual);
    $(".individual_quantidade_3_parcela").text(terceiraParcelaIndividual);
    $(".individual_quantidade_4_parcela").text(quartaParcelaIndividual);
    $(".individual_quantidade_5_parcela").text(quintaParcelaIndividual);
    $(".individual_quantidade_6_parcela").text(sextaParcelaIndividual);
    $(".individual_quantidade_cancelado").text(canceladosIndividual);
    $(".individual_quantidade_atrasado").text(atrasadoIndividual);
});





$("#list_coletivo_begin").on('click',function(){

    table.column(9).search('').draw();
    table.column(11).search('').draw();

    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");
    $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#cancelado_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#emissao_boleto_coletivo").removeClass('textoforte-list').removeClass('destaque_content');
    $('#content_list_coletivo_begin').addClass('destaque_content_radius');



});

$("#list_empresarial_begin").on('click',function(){

    tableempresarial.column(9).search('').draw();
    tableempresarial.column(11).search('').draw();
    tableempresarial.column(7).search('').draw();

    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#content_list_empresarial_begin").addClass('destaque_content_radius');
    //$("#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    //$("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Contratos</h4>");
    //tableempresarial.ajax.url('{{route("contratos.listarEmpresarial.listarContratoEmpresaPendentes")}}').load();
});




$("ul#listar li.coletivo").on('click',function(){
    let id_lista = $(this).attr('id');
    if(id_lista == "em_analise_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Em Análise</h4>");

        table.column(11).search('').draw();
        table.column(9).search('Em Análise').draw();

        $(".container_edit").removeClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#all_pendentes_coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "emissao_boleto_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Emissão Boleto</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Emissão Boleto').draw();

        $(".container_edit").addClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_adesao_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento Adesão</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. Adesão').draw();

        $(".container_edit").addClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_vigencia_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento Vigência</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. Vigência').draw();

        $(".container_edit").addClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_segunda_parcela") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 2º Parcela</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. 2º Parcela').draw();

        $(".container_edit").addClass('ocultar');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_terceira_parcela") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 3º Parcela</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. 3º Parcela').draw();

        $(".container_edit").addClass('ocultar');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_quarta_parcela") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 4º Parcela</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. 4º Parcela').draw();


        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "pagamento_quinta_parcela") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 5º Parcela</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. 5º Parcela').draw();
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');

    } else if(id_lista == "pagamento_sexta_parcela") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 6º Parcela</h4>");
        table.column(11).search('').draw();
        table.column(9).search('Pag. 6º Parcela').draw();
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content');
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else {

    }
});


$("#finalizado_corretor_coletivo").on('click',function(){
    table.search('').columns().search('').draw();
    table.column(9).search('Finalizado').draw();

    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
    $("#grupo_finalizados").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("ul#listar li.coletivo").removeClass('textoforte-list').removeClass('destaque_content');
    $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');
});





$("#all_pendentes_individual").on('click',function(){
    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Contratos</h4>");
    table_individual.ajax.url("{{ route('financeiro.individual.geralIndividualPendentes') }}").load();
    $("ul#listar_individual li.individual").removeClass('textoforte-list');
    $("#atrasado_corretor").removeClass('textoforte-list');
    $(this).addClass('textoforte-list');
});






$("ul#listar_individual li.individual").on('click',function(){
    let id_lista = $(this).attr('id');
    parcelaSelecionada = id_lista;
    //updateFiltragemParcela(id_lista);
    if(id_lista == "aguardando_pagamento_1_parcela_individual") {
        let mes = $("#mudar_mes_table").val();
        let dataId = $("#select_usuario_individual").find('option:selected').data('id');
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 1º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 1º Parcela').draw();
        $(".container_edit").addClass('ocultar');
        $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("ul#listar_individual li.individual").removeClass('textoforte-list');
        $("#all_pendentes_individual").removeClass('textoforte-list');
        $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
        $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
        $("#listar_individual li").removeClass('destaque_content');
        $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $("#finalizado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "aguardando_pagamento_2_parcela_individual") {
        let mes = $("#mudar_mes_table").val();
        let dataId = $("#select_usuario_individual").find('option:selected').data('id');
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 2º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 2º Parcela').draw();
        $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(".container_edit").addClass('ocultar');
        $("ul#listar_individual li.individual").removeClass('textoforte-list');
        $("#all_pendentes_individual").removeClass('textoforte-list');
        $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
        $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#cancelado_individual").removeClass('textoforte-list');
        $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
        $("#listar_individual li").removeClass('destaque_content');
        $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "aguardando_pagamento_3_parcela_individual") {
        //table_individual.clear().draw();
        let mes = $("#mudar_mes_table").val();
        let dataId = $("#select_usuario_individual").find('option:selected').data('id');
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 3º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 3º Parcela').draw();
        $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(".container_edit").addClass('ocultar');
        $("#cancelado_individual").removeClass('textoforte-list');
        //adicionarReadonly();
        $("ul#listar_individual li.individual").removeClass('textoforte-list');
        $("#all_pendentes_individual").removeClass('textoforte-list');
        $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
        $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
        $("#listar_individual li").removeClass('destaque_content');
        $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    } else if(id_lista == "aguardando_pagamento_4_parcela_individual") {
        //table_individual.clear().draw();
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 4º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 4º Parcela').draw();
        $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(".container_edit").addClass('ocultar')
        $("ul#listar_individual li.individual").removeClass('textoforte-list');
        $("#all_pendentes_individual").removeClass('textoforte-list');
        $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
        $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
        $("#listar_individual li").removeClass('destaque_content');
        $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        $("#cancelado_individual").removeClass('textoforte-list');
    } else if(id_lista == "aguardando_pagamento_5_parcela_individual") {
        //table_individual.clear().draw();
        $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 5º Parcela</h4>");
        table_individual.column(11).search('').draw();
        table_individual.column(9).search('Pag. 5º Parcela').draw();
        $(".container_edit").addClass('ocultar');
        $("ul#listar_individual li.individual").removeClass('textoforte-list');
        $("#all_pendentes_individual").removeClass('textoforte-list');
        $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
        $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#cancelado_individual").removeClass('textoforte-list').removeClass('destaque_content_radius')
        $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
        $("#listar_individual li").removeClass('destaque_content');
        $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
        $(this).addClass('textoforte-list').addClass('destaque_content');
    }
});

$("#aguardando_pagamento_6_parcela_individual").on('click',function(){
    //table_individual.clear().draw();
    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 6º Parcela</h4>");
    let mes = $("#mudar_mes_table").val();
    let dataId = $("#select_usuario_individual").find('option:selected').data('id');
    table_individual.column(11).search('').draw();
    table_individual.column(9).search('Finalizado').draw();
    $(".container_edit").addClass('ocultar')
    $("ul#listar_individual li.individual").removeClass('textoforte-list').removeClass('destaque_content');
    $("#all_pendentes_individual").removeClass('textoforte-list');
    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list')
    $("#cancelado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor").addClass('textoforte-list').addClass('destaque_content_radius');
    $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
});



$("ul#grupo_finalizados li.coletivo").on('click',function(){
    let id_lista = $(this).attr('id');
    if(id_lista == "finalizado_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");

        $('.buttons').empty().html();
        $(".container_edit").addClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#all_pendentes_coletivo").removeClass('textoforte-list');
        $(this).addClass('textoforte-list');

    } else if(id_lista == "cancelado_coletivo") {
        $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
        table.column(9).search('Cancelado').draw();

        $('.buttons').empty().html();
        $(".container_edit").addClass('ocultar');
        $("ul#listar li.coletivo").removeClass('textoforte-list');
        $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
        $("#all_pendentes_coletivo").removeClass('textoforte-list');
        $("#listar li").removeClass('destaque_content')
        $("#content_list_coletivo_begin").removeClass('destaque_content_radius');
        $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $(this).closest("ul").addClass('textoforte-list').addClass('destaque_content_radius');

    } else {

    }
});




$("#atrasado_corretor_empresarial").on('click',function(){
    $('#title_empresarial').html("<h4 style='font-size:1em;margin-top:10px;'>Atrasado</h4>");

    tableempresarial.column(9).search('').draw();
    tableempresarial.column(11).search('Atrasado').draw();


    $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#listar_empresarial li").removeClass('textoforte-list').removeClass('destaque_content');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');


});

$("#finalizado_corretor_empresarial").on('click',function(){
    tableempresarial.column(9).search('Finalizado').draw();
    $('#title_empresarial').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
    $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#listar_empresarial li").removeClass('textoforte-list').removeClass('destaque_content');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');

});

$("#atrasado_corretor").on('click',function(){
    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Atrasado</h4>");
    table_individual.column(9).search('').draw();
    table_individual.column(11).search('Atrasado').draw();
    table_individual.column(9).search('^(?!.*(?:Cancelado|Finalizado)).*$', true, false).draw();
    $("ul#listar_individual li.individual").removeClass('textoforte-list').removeClass('destaque_content');
    $("#all_pendentes_individual").removeClass('textoforte-list');
    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');
    $("#aguardando_pagamento_6_parcela_individual").removeClass('textoforte-list');
    $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#cancelado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#content_list_individual_begin").removeClass('destaque_content').removeClass('destaque_content_radius');
});

$("#cancelado_individual").on('click',function(){
    let mes = $("#mudar_mes_table").val();
    let dataId = $("#select_usuario_individual").find('option:selected').data('id');
    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
    $('.button_individual').empty().html('');
    $(".container_edit").addClass('ocultar');
    $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("ul#listar_individual li.individual").removeClass('textoforte-list');
    $("#aguardando_pagamento_6_parcela_individual").removeClass('textoforte-list');
    $("#all_pendentes_individual").removeClass('textoforte-list');
    $("ul#grupo_finalizados_individual li.individual").removeClass('textoforte-list');
    $("#finalizado_corretor").removeClass('textoforte-list');
    $("#listar_individual li").removeClass('destaque_content');
    $("#cancelado_corretor").addClass('textoforte-list');
    $("#cancelado_corretor").addClass('destaque_content_radius');
    $("#content_list_individual_begin").removeClass('destaque_content_radius').removeClass('destaque_content');
    $("#finalizado_corretor").removeClass('destaque_content_radius');



    table_individual.column(9).search('Cancelado').draw();




});


$("#aguardando_cancelado_empresarial").on('click',function(){
    $('#title_empresarial').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
    tableempresarial.column(9).search('Cancelado').draw();
    $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');
});

$("#finalizado_corretor_empresarial").on('click',function(){
    $('#title_empresarial').html("<h4 style='font-size:1em;margin-top:10px;'>Cancelado</h4>");
    tableempresarial.column(9).search('Finalizado').draw();
    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $(this).addClass('textoforte-list').addClass('destaque_content_radius');
});




$("ul#grupo_finalizados_empresarial li.empresarial").on('click',function(){
    let id_lista = $(this).attr('id');
    if(id_lista == "aguardando_finalizado_empresarial") {
        $('#title_empresarial').html("<h4 style='font-size:1em;margin-top:10px;'>Finalizado</h4>");
        tableempresarial.column(9).search('Finalizado').draw();


        $(".container_edit").addClass('ocultar');
        $("ul#grupo_finalizados_empresarial li.empresarial").removeClass('textoforte-list');
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list');
        $(this).addClass('textoforte-list');

    }
});

$("ul#listar_empresarial li.empresarial").on('click',function(){
    let id_lista = $(this).attr('id');
    if(id_lista == "aguardando_em_analise_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Em Análise</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Em Análise').draw();

    } else if(id_lista == "aguardando_pagamento_1_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 1º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 1º Parcela').draw();

    } else if(id_lista == "aguardando_pagamento_2_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 2º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 2º Parcela').draw();

    } else if(id_lista == "aguardando_pagamento_3_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 3º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 3º Parcela').draw();

    } else if(id_lista == "aguardando_pagamento_4_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 4º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 4º Parcela').draw();

    } else if(id_lista == "aguardando_pagamento_5_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 5º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 5º Parcela').draw();

    } else if(id_lista == "aguardando_pagamento_6_parcela_empresarial") {
        $("#title_empresarial").html("<h4 style='font-size:1em;margin-top:10px;'>Pagamento 6º Parcela</h4>");
        $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
        $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
        $("#content_list_empresarial_begin").removeClass('destaque_content_radius');
        $(this).addClass('textoforte-list').addClass('destaque_content');
        tableempresarial.column(9).search('Pag. 6º Parcela').draw();

    }  else {

    }
});
