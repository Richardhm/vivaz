// Individual
$("#select_usuario_individual").on('change',function(){
    if (parcelaSelecionada) {  // Verifica se há uma parcela selecionada
        updateFiltragemParcela(parcelaSelecionada);  // Reaplica a filtragem com base na parcela já selecionada
    }
    let mes = $("#mudar_mes_table").val() == '' ? '00' : $("#mudar_mes_table").val();
    let id = $('option:selected', this).attr('data-id');
    let nome = $('option:selected', this).text();
    let corretor = $("#corretor_selecionado_id").val();
    let valorSelecionado = $(this).val();
    $("ul#listar_individual li.individual").removeClass('textoforte-list').removeClass('destaque_content');
    $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
    //$("#content_list_individual_begin").addClass('destaque_content_radius');
    //$('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");
    if(valorSelecionado != "todos") {
        table_individual.column(9).search('').draw();
        table_individual.column(2).search(valorSelecionado).draw();
        let dadosColuna9 = table_individual.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table_individual.column(11,{search: 'applied'}).data();
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

        $(".individual_quantidade_1_parcela").text(primeiraParcelaIndividual);
        $(".individual_quantidade_2_parcela").text(segundaParcelaIndividual);
        $(".individual_quantidade_3_parcela").text(terceiraParcelaIndividual);
        $(".individual_quantidade_4_parcela").text(quartaParcelaIndividual);
        $(".individual_quantidade_5_parcela").text(quintaParcelaIndividual);
        $(".individual_quantidade_6_parcela").text(sextaParcelaIndividual);
        $(".individual_quantidade_cancelado").text(canceladosIndividual);
        $(".individual_quantidade_atrasado").text(atrasadoIndividual);
    } else {
        table_individual.column(9).search('').draw();
        table_individual.column(2).search('').draw();
        //$('#tabela_individual').DataTable().column(2).search(valorSelecionado).draw();
        let dadosColuna9 = table_individual.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table_individual.column(11,{search: 'applied'}).data();
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

        $(".individual_quantidade_1_parcela").text(primeiraParcelaIndividual);
        $(".individual_quantidade_2_parcela").text(segundaParcelaIndividual);
        $(".individual_quantidade_3_parcela").text(terceiraParcelaIndividual);
        $(".individual_quantidade_4_parcela").text(quartaParcelaIndividual);
        $(".individual_quantidade_5_parcela").text(quintaParcelaIndividual);
        $(".individual_quantidade_6_parcela").text(sextaParcelaIndividual);
        $(".individual_quantidade_cancelado").text(canceladosIndividual);
        $(".individual_quantidade_atrasado").text(atrasadoIndividual);
    }
});

$("#mudar_mes_table").on('change',function(){
    atualizarParcelas();
    if (parcelaSelecionada) {  // Verifica se há uma parcela selecionada
        console.log("Poraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        console.log(parcelaSelecionada);
        //console.log(parcelaSelecionada);
        updateFiltragemParcela(parcelaSelecionada);  // Reaplica a filtragem com base na parcela já selecionada
    }
    // $("#select_usuario_individual").val('');
    // $("#corretor_selecionado_id").val('');
    // let mes = $(this).val() != "" ? $(this).val() : "00";
    // let ano = $("#mudar_ano_table").val() != "" ? $("#mudar_ano_table").val() : "00";
    //
    //
    // $("ul#listar_individual li.individual").removeClass('textoforte-list').removeClass('destaque_content');
    // $("#atrasado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    // $("#finalizado_corretor").removeClass('textoforte-list').removeClass('destaque_content_radius');
    // $("#cancelado_corretor").removeClass('destaque_content_radius').removeClass('textoforte-list');
    // //$("#content_list_individual_begin").addClass('destaque_content_radius');
    // $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");
    //
    // if(mes != 00) {
    //     table_individual.search('').columns().search('').draw();
    //     //let mesAno = mes + '/' + new Date().getFullYear();
    //     let mesAno = mes + '/'+ano;
    //     table_individual.column(0).search(mesAno, true, false).draw();
    //     let dadosColuna2 = table_individual.column(2,{search: 'applied'}).data().toArray();
    //     dadosColuna2.sort();
    //     let nomesUnicos = new Set(dadosColuna2);
    //     $("#select_usuario_individual").empty();
    //     // Adicionar a opção padrão
    //     $("#select_usuario_individual").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');
    //
    //     // Adicionar as opções ordenadas ao select
    //     nomesUnicos.forEach((nome, index) => {
    //         $("#select_usuario_individual").append(`<option value="${nome}" data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
    //     });
    //
    //     // Inicializar o select2 novamente
    //     //$("#select_usuario_individual").select2();
    //     let dadosColuna9 = table_individual.column(9,{search: 'applied'}).data();
    //     let dadosColuna11 = table_individual.column(11,{search: 'applied'}).data();
    //     let primeiraParcelaIndividual = 0;
    //     let segundaParcelaIndividual = 0;
    //     let terceiraParcelaIndividual = 0;
    //     let quartaParcelaIndividual = 0;
    //     let quintaParcelaIndividual = 0;
    //     let sextaParcelaIndividual = 0;
    //     let canceladosIndividual = 0;
    //     let atrasadoIndividual = 0;
    //
    //
    //     dadosColuna9.each(function (valor) {
    //
    //         if (valor.toLowerCase() == 'pag. 1º parcela') {primeiraParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'finalizado') {sextaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'cancelado') {canceladosIndividual++;}
    //
    //     });
    //
    //     dadosColuna11.each(function (valor) {
    //         if (valor.toLowerCase() == 'atrasado') {atrasadoIndividual++;}
    //     });
    //
    //
    //
    //     $(".individual_quantidade_1_parcela").text(primeiraParcelaIndividual);
    //     $(".individual_quantidade_2_parcela").text(segundaParcelaIndividual);
    //     $(".individual_quantidade_3_parcela").text(terceiraParcelaIndividual);
    //     $(".individual_quantidade_4_parcela").text(quartaParcelaIndividual);
    //     $(".individual_quantidade_5_parcela").text(quintaParcelaIndividual);
    //     $(".individual_quantidade_6_parcela").text(sextaParcelaIndividual);
    //     $(".individual_quantidade_cancelado").text(canceladosIndividual);
    //     $(".individual_quantidade_atrasado").text(atrasadoIndividual);
    //
    // } else {
    //     table_individual.search('').columns().search('').draw();
    //
    //     let dadosColuna2 = table_individual.column(2,{search: 'applied'}).data().toArray();
    //
    //     dadosColuna2.sort();
    //     let nomesUnicos = new Set(dadosColuna2);
    //
    //     $("#select_usuario_individual").empty();
    //
    //     // Adicionar a opção padrão
    //     $("#select_usuario_individual").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');
    //
    //     // Adicionar as opções ordenadas ao select
    //     nomesUnicos.forEach((nome, index) => {
    //         $("#select_usuario_individual").append(`<option value="${nome}" data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
    //     });
    //
    //     // Inicializar o select2 novamente
    //     //$("#select_usuario_individual").select2();
    //
    //     let dadosColuna9 = table_individual.column(9,{search: 'applied'}).data();
    //     let dadosColuna11 = table_individual.column(11,{search: 'applied'}).data();
    //     let primeiraParcelaIndividual = 0;
    //     let segundaParcelaIndividual = 0;
    //     let terceiraParcelaIndividual = 0;
    //     let quartaParcelaIndividual = 0;
    //     let quintaParcelaIndividual = 0;
    //     let sextaParcelaIndividual = 0;
    //     let canceladosIndividual = 0;
    //     let atrasadoIndividual = 0;
    //
    //
    //     dadosColuna9.each(function (valor) {
    //
    //         if (valor.toLowerCase() == 'pag. 1º parcela') {primeiraParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcelaIndividual++;}
    //         if (valor.toLowerCase() == 'cancelado') {canceladosIndividual++;}
    //
    //     });
    //
    //     dadosColuna11.each(function (valor) {
    //         if (valor.toLowerCase() == 'atrasado') {atrasadoIndividual++;}
    //     });
    //
    //
    //
    //     $(".individual_quantidade_1_parcela").text(primeiraParcelaIndividual);
    //     $(".individual_quantidade_2_parcela").text(segundaParcelaIndividual);
    //     $(".individual_quantidade_3_parcela").text(terceiraParcelaIndividual);
    //     $(".individual_quantidade_4_parcela").text(quartaParcelaIndividual);
    //     $(".individual_quantidade_5_parcela").text(quintaParcelaIndividual);
    //     $(".individual_quantidade_6_parcela").text(sextaParcelaIndividual);
    //     $(".individual_quantidade_cancelado").text(canceladosIndividual);
    //     $(".individual_quantidade_atrasado").text(atrasadoIndividual);
    // }
    // return;
});

$('#mudar_ano_table').on('change', function() {
    let anoSelecionado = $(this).val();
    // Filtrar as linhas da tabela com base no ano selecionado
    table_individual.column(0).search(anoSelecionado).draw();
    // Obter as datas filtradas da coluna 0
    let datasFiltradas = table_individual.column(0, { search: 'applied' }).data().toArray();
    // Obter os meses das datas filtradas
    let mesesPorAno = datasFiltradas.map(function(value) {
        // Converter o formato da data para "YYYY-MM-DD"
        let partesData = value.split('/');
        let dataFormatada = partesData[2] + '-' + partesData[1] + '-' + partesData[0];
        // Obter o mês (1-12) da data formatada
        return new Date(dataFormatada).getMonth() + 1;
    });
    // Filtrar apenas os meses únicos
    mesesPorAno = [...new Set(mesesPorAno)];
    let mesesOrdenados = Array.from(mesesPorAno).sort(function(a, b) {
        return a - b;
    });
    // // Preencher o select de meses
    let selectMes = $('#mudar_mes_table');
    selectMes.empty(); // Limpar opções existentes
    selectMes.append('<option value="" selected class="text-white text-center">- Mês -</option>'); // Opção padrão
    let nomesMeses = {
        '1': "Janeiro",
        '2': "Fevereiro",
        '3': "Março",
        '4': "Abril",
        '5': "Maio",
        '6': "Junho",
        '7': "Julho",
        '8': "Agosto",
        '9': "Setembro",
        '10': "Outubro",
        '11': "Novembro",
        '12': "Dezembro"
    };
    mesesOrdenados.forEach(function(mes) {
        //console.log(mes);
        selectMes.append('<option value="' + (mes) + '">' + nomesMeses[mes] + '</option>');
    });

});









$("#mudar_planos_empresarial").on('change',function(){
    let plano = $(this).val();

    let user_id = $("#mudar_user_empresarial").val();
    let mes = $("#mudar_mes_table_empresarial").val();
    mes = mes == "00" ? null : mes;
    user_id = user_id == "todos" ? null : user_id;

    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#content_list_empresarial_begin").addClass('destaque_content_radius');

    if(plano != "todos") {


        tableempresarial.column(7).search(plano).draw();


        if(mes) {
            let ano = $("#mudar_ano_table_empresarial").val() != null ? $("#mudar_ano_table_empresarial").val() : new Date().getFullYear();
            let mesAno = mes + '/' + ano;
            tableempresarial.column(0).search(mesAno,true,false).draw();
        }

        if(user_id) {
            let user_name = $("#mudar_user_empresarial").val();
            tableempresarial.column(2).search(user_name).draw();
        }



        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);
    } else {

        tableempresarial.column(7).search('').draw();
        if(mes) {
            let ano = $("#mudar_ano_table_empresarial").val() != null ? $("#mudar_ano_table_empresarial").val() : new Date().getFullYear();
            let mesAno = mes + '/' + ano;
            tableempresarial.column(0).search(mesAno,true,false).draw();
        }

        if(user_id) {
            let user_name = $("#mudar_user_empresarial").val();
            tableempresarial.column(2).search(user_name).draw();
        }

        //tableempresarial.column(2).search('').draw();
        //tableempresarial.column(11).search('').draw();
        //
        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);
    }
    //
});






$("#select_coletivo_administradoras").on('change',function(){
    let admin = $("#select_coletivo_administradoras").val();
    let user_id = $("#select_usuario").find("option:selected").data("id");
    let mes = $("#mudar_mes_table_coletivo").val();
    mes = mes == "00" ? null : mes;

    user_id = user_id == undefined || user_id == 0 ? null : user_id;
    table.column(9).search('').draw();

    $("ul#listar li.coletivo").removeClass('textoforte-list');
    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
    $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
    $("#listar li").removeClass('destaque_content');
    $("#content_list_coletivo_begin").addClass('destaque_content_radius');
    $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");


    if(admin != "todos") {

        if(mes) {
            let mesAno = mes + '/' + new Date().getFullYear();
            table.column(0).search(mesAno,true,false).draw();
        }

        if(user_id) {
            let user_name = $("#select_usuario").find("option:selected").text();
            table.column(2).search(user_name).draw();
        }

        admin = admin == "todos" ? null : $("#select_coletivo_administradoras").find("option:selected").data("id");
        let administradora = $(this).val();
        table.column(4).search(administradora).draw();

        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table.column(11,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        let atrasado = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}
        });

        dadosColuna11.each(function (valor) {
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}
        });

        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);
        $(".coletivo_quantidade_atrasado").text(atrasado);

    } else {

        table.column(4).search('').draw();

        if(mes) {
            let mesAno = mes + '/' + new Date().getFullYear();
            table.column(0).search(mesAno, true, false).draw();
        }

        if(user_id) {
            let user_name = $("#select_usuario").find("option:selected").text();
            table.column(2).search(user_name).draw();
        }



        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}

        });

        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);

    }
});


$("#select_usuario").on('change',function(){

    table.columns().search('').draw();
    //$.fn.dataTable.ext.search = [];


    let user_id = $(this).find("option:selected").data("id");
    let mes = $("#mudar_mes_table_coletivo").val();
    let ano = $("#mudar_ano_table_coletivo").val() != "" ? $("#mudar_ano_table_coletivo").val() : "00";
    let admin = $("#select_coletivo_administradoras").val();
    $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#grupo_finalizados").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#listar li").removeClass('textoforte-list').removeClass('destaque_content');
    $("#content_list_coletivo_begin").addClass('destaque_content');

    mes = mes == 00 ? null : mes;
    admin = admin == "todos" ? null : $("#select_coletivo_administradoras").find("option:selected").data("id");
    user_id = user_id == undefined ? null : user_id;

    let corretorSelecionado = $(this).val();
    //table.search('').draw();
    if (corretorSelecionado != 'todos') {
        //table.column(9).search('').draw();
        //table.column(11).search('').draw();
        table.column(2).search(corretorSelecionado).draw();
        let administradora = $("#select_coletivo_administradoras").val();
        if(administradora != "todos") {
            table.column(4).search(administradora,true,false).draw();
        }




        if(mes != null && ano != null) {

            let mesAno = mes+"/"+ano;

            table.column(0).search(mesAno,true,false).draw();
        }



        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table.column(11,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        let atrasado = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}

        });

        dadosColuna11.each(function (valor) {
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}
        });


        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);
        $(".coletivo_quantidade_atrasado").text(atrasado);




    } else {

        table.column(2).search('').draw();

        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table.column(11,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        let atrasado = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}

        });

        dadosColuna11.each(function (valor) {
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}
        });


        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);
        $(".coletivo_quantidade_atrasado").text(atrasado);
    }
});

$('#mudar_ano_table_coletivo').on('change', function() {
    table.columns().search('').draw();
    $.fn.dataTable.ext.search = [];
    let anoSelecionado = $(this).val();
    // Filtrar as linhas da tabela com base no ano selecionado
    table.column(0).search(anoSelecionado).draw();

    let corretorSelecionado = $("#select_usuario").val();
    if(corretorSelecionado != "todos") {
        table.column(2).search(corretorSelecionado).draw();
    }

    let administradora = $("#select_coletivo_administradoras").val();
    if(administradora != "todos") {
        table.column(4).search(administradora).draw();
    }

    let mes = $("#mudar_mes_table_coletivo").val();

    if(mes != '00') {
        let mesAno = mes + '/'+anoSelecionado;
        table.column(0).search(mesAno,true,false).draw();

    }


    let dadosColuna9 = table.column(9,{search: 'applied'}).data();
    let dadosColuna11 = table.column(11,{search: 'applied'}).data();
    let contagemEmAnalise = 0;
    let emissao = 0;
    let adesao = 0;
    let vigencia = 0;
    let segundaParcela = 0;
    let terceiraParcela = 0;
    let quartaParcela = 0;
    let quintaParcela = 0;
    let sextaParcela = 0;
    let finalizado = 0;
    let cancelados = 0;
    let atrasado = 0;
    dadosColuna9.each(function (valor) {
        if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
        if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
        if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
        if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
        if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
        if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
        if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
        if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
        if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
        if (valor.toLowerCase() == 'finalizado') {finalizado++;}
        if (valor.toLowerCase() == 'cancelado') {cancelados++;}

    });
    dadosColuna11.each(function (valor) {
        if (valor.toLowerCase() == 'atrasado') {atrasado++;}
    });
    $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
    $(".coletivo_quantidade_emissao_boleto").text(emissao);
    $(".coletivo_quantidade_pagamento_adesao").text(adesao);
    $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
    $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
    $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
    $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
    $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
    $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
    $(".quantidade_coletivo_finalizado").text(finalizado);
    $(".quantidade_coletivo_cancelados").text(cancelados);
    $(".coletivo_quantidade_atrasado").text(atrasado);
});

$('#mudar_ano_table_empresarial').on('change', function() {
    tableempresarial.columns().search('').draw();
    $.fn.dataTable.ext.search = [];

    let corretorSelecionado = $("#mudar_user_empresarial").val();
    if(corretorSelecionado != "todos") {
        tableempresarial.column(2).search(corretorSelecionado).draw();
    }

    let planoSelecionado = $("#mudar_planos_empresarial").val();
    if(planoSelecionado != "todos") {
        tableempresarial.column(7).search(planoSelecionado).draw();
    }

    let anoSelecionado = $(this).val();
    tableempresarial.column(0).search(anoSelecionado).draw();





});







var mes_old = "";



$("#mudar_mes_table_coletivo").on('change',function(){
    let mes = $(this).val();

    //table.columns().search('').draw();
    //$.fn.dataTable.ext.search = [];

    $("ul#listar li.coletivo").removeClass('textoforte-list');
    $("ul#grupo_finalizados li.coletivo").removeClass('textoforte-list');
    $("#finalizado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#grupo_finalizados").removeClass('destaque_content_radius').removeClass('textoforte-list');
    $("#listar li").removeClass('destaque_content');
    $("#content_list_coletivo_begin").addClass('destaque_content_radius');
    $("#atrasado_corretor_coletivo").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $('#title_coletivo_por_adesao_table').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");

    if(mes != 00) {

        let ano = $("#mudar_ano_table_coletivo").val();
        table.search('').columns().search('').draw();
        let mesAno = mes + '/' + ano;
        table.column(0).search(mesAno, true, false).draw();

        let corretorSelecionado = $("#select_usuario").val();

        let dadosColuna2 = table.column(2,{search: 'applied'}).data().toArray();

        dadosColuna2.sort();
        let nomesUnicos = new Set(dadosColuna2);
        $("#select_usuario").empty();
        //
        // // Adicionar a opção padrão
        $("#select_usuario").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');

        if (corretorSelecionado != "todos" && !nomesUnicos.has(corretorSelecionado)) {
            nomesUnicos.add(corretorSelecionado); // Adiciona o nome se ele não estiver no conjunto
        }
        nomesUnicos.forEach((nome, index) => {
            let selecao = nome == corretorSelecionado ? 'selected' : '';
            $("#select_usuario").append(`<option value="${nome}" ${selecao} data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
        });
        //Inicializar o select2 novamente
        $("#select_usuario").select2();

        if(corretorSelecionado != "todos") {
            table.column(2).search(corretorSelecionado).draw();
        }

        let administradora = $("#select_coletivo_administradoras").val();
        if(administradora != "todos") {
            table.column(4).search(administradora).draw();
        }

        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table.column(11,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        let atrasado = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}

        });
        dadosColuna11.each(function (valor) {
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}
        });
        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);
        $(".coletivo_quantidade_atrasado").text(atrasado);
    } else {

        table.search('').columns().search('').draw();
        let dadosColuna2 = table.column(2,{search: 'applied'}).data().toArray();

        dadosColuna2.sort();
        let nomesUnicos = new Set(dadosColuna2);


        let corretorSelecionado = $("#select_usuario").val();
        if(corretorSelecionado != "todos") {
            table.column(2).search(corretorSelecionado).draw();
        }

        let administradora = $("#select_coletivo_administradoras").val();
        if(administradora != "todos") {
            table.column(4).search(administradora).draw();
        }

        let anoSelecionado = $("#mudar_ano_table_coletivo").val();
        let regex = '\\b' + anoSelecionado + '\\b';
        // Aplicar o filtro na coluna 0 usando a expressão regular
        table.column(0).search(regex, true, false).draw();

        $("#select_usuario").empty();

        // Adicionar a opção padrão
        $("#select_usuario").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');

        // Adicionar as opções ordenadas ao select
        nomesUnicos.forEach((nome, index) => {
            let selecao = nome == corretorSelecionado ? 'selected' : '';
            $("#select_usuario").append(`<option value="${nome}" ${selecao} data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
        });


        // Inicializar o select2 novamente
        $("#select_usuario").select2();

        let dadosColuna9 = table.column(9,{search: 'applied'}).data();
        let dadosColuna11 = table.column(11,{search: 'applied'}).data();
        let contagemEmAnalise = 0;
        let emissao = 0;
        let adesao = 0;
        let vigencia = 0;
        let segundaParcela = 0;
        let terceiraParcela = 0;
        let quartaParcela = 0;
        let quintaParcela = 0;
        let sextaParcela = 0;
        let finalizado = 0;
        let cancelados = 0;
        let atrasado = 0;
        dadosColuna9.each(function (valor) {
            if (valor.toLowerCase() == 'em análise') {contagemEmAnalise++;}
            if (valor.toLowerCase() == 'emissão boleto') {emissao++;}
            if (valor.toLowerCase() == 'pag. vigência') {vigencia++;}
            if (valor.toLowerCase() == 'pag. adesão') {adesao++;}
            if (valor.toLowerCase() == 'pag. 2º parcela') {segundaParcela++;}
            if (valor.toLowerCase() == 'pag. 3º parcela') {terceiraParcela++;}
            if (valor.toLowerCase() == 'pag. 4º parcela') {quartaParcela++;}
            if (valor.toLowerCase() == 'pag. 5º parcela') {quintaParcela++;}
            if (valor.toLowerCase() == 'pag. 6º parcela') {sextaParcela++;}
            if (valor.toLowerCase() == 'finalizado') {finalizado++;}
            if (valor.toLowerCase() == 'cancelado') {cancelados++;}
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}

        });

        dadosColuna11.each(function (valor) {
            if (valor.toLowerCase() == 'atrasado') {atrasado++;}
        });

        $(".coletivo_quantidade_em_analise").text(contagemEmAnalise);
        $(".coletivo_quantidade_emissao_boleto").text(emissao);
        $(".coletivo_quantidade_pagamento_adesao").text(adesao);
        $(".coletivo_quantidade_pagamento_vigencia").text(vigencia);
        $(".coletivo_quantidade_segunda_parcela").text(segundaParcela);
        $(".coletivo_quantidade_terceira_parcela").text(terceiraParcela);
        $(".coletivo_quantidade_quarta_parcela").text(quartaParcela);
        $(".coletivo_quantidade_quinta_parcela").text(quintaParcela);
        $(".coletivo_quantidade_sexta_parcela").text(sextaParcela);
        $(".quantidade_coletivo_finalizado").text(finalizado);
        $(".quantidade_coletivo_cancelados").text(cancelados);
        $(".coletivo_quantidade_atrasado").text(atrasado);

    }

});

$("#mudar_mes_table_empresarial").on('change',function(){

    let mes = $(this).val();
    if(mes != 00) {

        tableempresarial.search('').columns().search('').draw();
        let mesAno = mes + '/' + new Date().getFullYear();
        tableempresarial.column(0).search(mesAno, true, false).draw();

        let dadosColuna2 = tableempresarial.column(2,{search: 'applied'}).data().toArray();

        dadosColuna2.sort();
        let nomesUnicos = new Set(dadosColuna2);
        $("#mudar_user_empresarial").empty();
        $("#mudar_user_empresarial").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');
        nomesUnicos.forEach((nome, index) => {
            $("#mudar_user_empresarial").append(`<option value="${nome}" data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
        });
        $("#mudar_user_empresarial").select2();


        let dadosColuna7 = tableempresarial.column(7,{search: 'applied'}).data().toArray();
        dadosColuna7.sort();
        let planosUnicos = new Set(dadosColuna7);
        $("#mudar_planos_empresarial").empty();
        $("#mudar_planos_empresarial").append('<option value="todos" class="text-center">---Escolher Planos---</option>');
        planosUnicos.forEach((nome, index) => {
            $("#mudar_planos_empresarial").append(`<option value="${nome}" data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
        });
        $("#mudar_planos_empresarial").select2();

        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);

    } else {
        tableempresarial.search('').columns().search('').draw();
        let dadosColuna2 = tableempresarial.column(2,{search: 'applied'}).data().toArray();
        dadosColuna2.sort();
        let nomesUnicos = new Set(dadosColuna2);
        $("#mudar_user_empresarial").empty();
        // Adicionar a opção padrão
        $("#mudar_user_empresarial").append('<option value="todos" class="text-center">---Escolher Corretor---</option>');
        // Adicionar as opções ordenadas ao select
        nomesUnicos.forEach((nome, index) => {
            $("#mudar_user_empresarial").append(`<option value="${nome}" data-id="${index}" style="font-size:0.5em;">${nome}</option>`);
        });
        // Inicializar o select2 novamente
        $("#mudar_user_empresarial").select2();
        let planosAdmin = new Set();
        tableempresarial.column(7).data().each(function(v) {
            planosAdmin.add(v);
        });
        let planosOrdenados = Array.from(planosAdmin).sort();
        console.log(planosOrdenados);
        $('#mudar_planos_empresarial').empty();
        $('#mudar_planos_empresarial').append('<option value="todos">--- Escolher Planos ---</option>');
        planosOrdenados.forEach(function(corretor) {
            $('#mudar_planos_empresarial').append('<option value="' + corretor + '">' + corretor + '</option>');
        });
        $("#mudar_planos_empresarial").select2();
        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);
    }
});
$("#mudar_user_empresarial").on('change',function(){
    let user = $(this).val();

    $("ul#listar_empresarial li.empresarial").removeClass('textoforte-list').removeClass('destaque_content');
    $("#atrasado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#finalizado_corretor_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#aguardando_cancelado_empresarial").removeClass('textoforte-list').removeClass('destaque_content_radius');
    $("#content_list_empresarial_begin").addClass('destaque_content_radius');

    if(user != "todos") {

        tableempresarial.column(9).search('').draw();
        tableempresarial.column(11).search('').draw();
        tableempresarial.column(2).search(user).draw();

        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);

    } else {
        tableempresarial.column(2).search('').draw();

        let countEmAnalise  = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Em Análise').length;
        let countPagamento1 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
        let countPagamento2 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
        let countPagamento3 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
        let countPagamento4 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
        let countPagamento5 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
        let countPagamento6 = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
        let countAtrasado   = tableempresarial.column(11,{search: 'applied'}).data().filter((value, index) => value === 'Atrasado').length;
        let countCancelados = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Cancelado').length;
        let countFinalizado = tableempresarial.column(9,{search: 'applied'}).data().filter((value, index) =>  value === 'Finalizado').length;
        $(".empresarial_quantidade_em_analise").text(countEmAnalise);
        $(".empresarial_quantidade_1_parcela").text(countPagamento1);
        $(".empresarial_quantidade_2_parcela").text(countPagamento2);
        $(".empresarial_quantidade_3_parcela").text(countPagamento3);
        $(".empresarial_quantidade_4_parcela").text(countPagamento4);
        $(".empresarial_quantidade_5_parcela").text(countPagamento5);
        $(".empresarial_quantidade_6_parcela").text(countPagamento6);
        $(".empresarial_quantidade_cancelado").text(countCancelados);
        $(".quantidade_empresarial_finalizado").text(countFinalizado);
        $(".empresarial_quantidade_atrasado").text(countAtrasado);



    }

});
