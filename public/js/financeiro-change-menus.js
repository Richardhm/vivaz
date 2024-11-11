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
        table_individual.column(12).search(valorSelecionado).draw();
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
        table_individual.column(12).search('').draw();
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

$("body").on("change",'#select_corretoras',function(){
    let corretora_id = $(this).val();
    inicializarIndividual(corretora_id);
});

$("body").on("change","#select_corretoras_coletivo",function(){
    let corretora_id = $(this).val();
    inicializarColetivo(corretora_id);

});

$("body").on('change','.editar_campo_individual',function(){
    let alvo = $(this).attr('id');
    let valor = $("#"+alvo).val();
    let id_cliente = $("#id_cliente").val();

    $.ajax({
        url:"{{route('financeiro.editar.campoIndividualmente')}}",
        method:"POST",
        data:"alvo="+alvo+"&valor="+valor+"&id_cliente="+id_cliente,
        success:function(res) {
            //console.log(res);
            //table.ajax.reload();
        }
    });
});

$("body").on('change','.editar_campo_individual',function(){
    let alvo = $(this).attr('id');
    let valor = $("#"+alvo).val();
    let id_cliente = $("#id_cliente").val();

    $.ajax({
        url:mudarCampoIndividual,
        method:"POST",
        data:"alvo="+alvo+"&valor="+valor+"&id_cliente="+id_cliente,
        success:function(res) {
            //console.log(res);
            //table.ajax.reload();
        }
    });
});





$("body").on('change','.mudar_coletivo',function(){
    let alvo = $(this).attr('id');
    $("#valor_contrato").mask('#.##0,00', {reverse: true});
    $("#valor_adesao").mask('#.##0,00', {reverse: true});
    $("#desconto_corretora").mask('#.##0,00', {reverse: true});
    $("#desconto_corretor").mask('#.##0,00', {reverse: true});


    let valor = $("#"+alvo).val();
    let id_cliente = $("#id_cliente").val();

    $.ajax({
        url:editarCampoColetivo,
        method:"POST",
        data:"alvo="+alvo+"&valor="+valor+"&id_cliente="+id_cliente,
        success:function(res) {
            console.log(res);
            //table.ajax.reload();
        }
    });



});







$("body").on('change', '#mudar_corretor_individual', function () {
    let id_cliente = $("#id_cliente").val();
    let user_id = $(this).val();
    // Mostrar o loading (remover a classe hidden)
    $("#loading-dots-change").removeClass('hidden');

    $.ajax({
        url: changecorretor,
        method: "POST",
        data: {
            id_cliente,
            user_id
        },
        success: function (res) {
            // Esconder o loading (adicionar a classe hidden novamente)
            $("#loading-dots-change").addClass('hidden');

            // Exibir mensagem de sucesso (SweetAlert)
            Swal.fire({
                icon: 'success',
                title: 'Troca realizada com sucesso!',
                text: 'O cliente foi transferido para o novo vendedor.',
                confirmButtonText: 'OK'
            });
            inicializarIndividual(res,1);
        },
        error: function (err) {
            // Esconder o loading (adicionar a classe hidden novamente)
            $("#loading-dots-change").addClass('hidden');

            // Exibir mensagem de erro (SweetAlert)
            Swal.fire({
                icon: 'error',
                title: 'Erro ao trocar vendedor',
                text: 'Ocorreu um erro ao tentar transferir o cliente. Por favor, tente novamente.',
                confirmButtonText: 'OK'
            });
        }
    });
});




// function atualizarParcelas() {
//     // Atualizar a contagem de todas as parcelas
//     atualizarQuantidadeParcela(1, 'Pag. 1º Parcela');
//     atualizarQuantidadeParcela(2, 'Pag. 2º Parcela');
//     atualizarQuantidadeParcela(3, 'Pag. 3º Parcela');
//     atualizarQuantidadeParcela(4, 'Pag. 4º Parcela');
//     atualizarQuantidadeParcela(5, 'Pag. 5º Parcela');
// }
//
// function atualizarQuantidadeParcela(numeroParcela, filtro) {
//     // Aplica a filtragem e redesenha a tabela
//     table_individual.column(9).search(filtro).draw();
//
//
//
//
//     table_individual.one('draw', function() {
//         let quantidade = table_individual.rows({ filter: 'applied' }).count();
//         $(".individual_quantidade_" + numeroParcela + "_parcela").text(quantidade);
//     });
//
//
//
//
//
//     // Usa um callback para garantir que a contagem só aconteça após o redesenho da tabela
//     //table_individual.one('draw', function() {
//         // Pega a quantidade de linhas filtradas após o redesenho
//         //let quantidade = table_individual.rows({ filter: 'applied' }).count();
//
//         // Exibe no console para verificação
//         //console.log(`Quantidade para Parcela ${numeroParcela}:`, quantidade);
//
//         // Atualiza o valor exibido na UI
//         //$(".individual_quantidade_" + numeroParcela + "_parcela").text(quantidade);
//     //});
// }

function realizarContagemEAtualizarParcelas() {
    // Define um array com as descrições das parcelas
    let filtrosParcelas = [
        { numero: 1, filtro: 'Pag. 1º Parcela' },
        { numero: 2, filtro: 'Pag. 2º Parcela' },
        { numero: 3, filtro: 'Pag. 3º Parcela' },
        { numero: 4, filtro: 'Pag. 4º Parcela' },
        { numero: 5, filtro: 'Pag. 5º Parcela' }
    ];

    // Itera sobre cada parcela e aplica o filtro, conta as linhas e atualiza o HTML
    filtrosParcelas.forEach(function(parcela) {
        // Aplica o filtro à tabela
        table_individual.column(9).search(parcela.filtro).draw();

        // Usa um callback para garantir que a contagem só aconteça após o redesenho da tabela
        table_individual.one('draw', function() {
            // Pega a quantidade de linhas filtradas após o redesenho
            let quantidade = table_individual.rows({ filter: 'applied' }).count();

            // Atualiza o valor exibido no HTML
            $(".individual_quantidade_" + parcela.numero + "_parcela").text(quantidade);
        });
    });
}



// function realizarContagem() {
//     let countPagamento1 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
//     let countPagamento2 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
//     let countPagamento3 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
//     let countPagamento4 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
//     let countPagamento5 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
//     let countPagamento6 = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
//     let finalizado      = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) => value === 'Finalizado').length;
//     let countCancelados = table_individual.column(9,{ search: 'applied' }).data().filter((value, index) =>  value === 'Cancelado').length;
//     let countAprovado = table_individual.rows({ search: 'applied' }).column(11).data().filter((value, index) =>  value === 'Aprovado').length;
//     let countAtrasadoTeste = table_individual.rows({ search: 'applied' }).count(); // Inicialmente, contamos todas as linhas
//     countAtrasadoTeste = countAtrasadoTeste - countPagamento6 - finalizado - countCancelados - countAprovado;
//     $(".individual_quantidade_1_parcela").text(countPagamento1);
//     $(".individual_quantidade_2_parcela").text(countPagamento2);
//     $(".individual_quantidade_3_parcela").text(countPagamento3);
//     $(".individual_quantidade_4_parcela").text(countPagamento4);
//     $(".individual_quantidade_5_parcela").text(countPagamento5);
//     $(".individual_quantidade_6_parcela").text(finalizado);
//     $(".individual_quantidade_cancelado").text(countCancelados);
//     $(".individual_quantidade_atrasado").text(countAtrasadoTeste);
// }





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






function realizarContagem()
{
    // Obter os filtros selecionados
    let mes = $("#mudar_mes_table").val();
    let ano = $("#mudar_ano_table").val();
    let usuarioId = $("#select_usuario_individual").find('option:selected').val();


    // Aplicar filtros baseados no mês, ano e usuário
    table_individual.column(0).search(mes).draw(); // Supondo que a coluna 0 é o mês
    table_individual.column(1).search(ano).draw(); // Supondo que a coluna 1 é o ano
    table_individual.column(2).search(usuarioId).draw(); // Supondo que a coluna 2 é o ID do usuário

    // Contagem das parcelas
    let countPagamento1 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 1º Parcela').length;
    let countPagamento2 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 2º Parcela').length;
    let countPagamento3 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 3º Parcela').length;
    let countPagamento4 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 4º Parcela').length;
    let countPagamento5 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 5º Parcela').length;
    let countPagamento6 = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Pag. 6º Parcela').length;

    // Contagem de status finalizado e cancelado
    let finalizado = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Finalizado').length;
    let countCancelados = table_individual.column(9, { search: 'applied' }).data().filter(value => value === 'Cancelado').length;

    // Contagem de status aprovado
    let countAprovado = table_individual.column(11, { search: 'applied' }).data().filter(value => value === 'Aprovado').length;

    // Contagem dos atrasados (todas as linhas aplicadas - parcelas específicas)
    let countAtrasado = table_individual.rows({ search: 'applied' }).count();
    countAtrasado -= (countPagamento6 + finalizado + countCancelados + countAprovado);

    // Atualizando os valores no HTML
    $(".individual_quantidade_1_parcela").text(countPagamento1);
    $(".individual_quantidade_2_parcela").text(countPagamento2);
    $(".individual_quantidade_3_parcela").text(countPagamento3);
    $(".individual_quantidade_4_parcela").text(countPagamento4);
    $(".individual_quantidade_5_parcela").text(countPagamento5);
    $(".individual_quantidade_6_parcela").text(countPagamento6);
    $(".individual_quantidade_cancelado").text(countCancelados);
    $(".individual_quantidade_atrasado").text(countAtrasado);
}


function filtrarTabela(selectAno, selectMes) {
    let anoSelecionado = selectAno.val();
    let mesSelecionado = selectMes.val();
    // Reseta a filtragem
    $.fn.dataTable.ext.search.length = 0;
    // Adiciona filtro baseado no ano e/ou mês selecionados
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        let dataColuna = data[0]; // Coluna 0, onde está a data
        let dataParts = dataColuna.split('/'); // Separa a data no formato dd/mm/yyyy
        let mesData = dataParts[1];
        let anoData = dataParts[2];
        // Verifica se há correspondência com o ano e/ou mês selecionados
        if (anoSelecionado && mesSelecionado) {
            return anoData === anoSelecionado && mesData === mesSelecionado.padStart(2, '0');
        } else if (anoSelecionado) {
            return anoData === anoSelecionado;
        } else if (mesSelecionado) {
            return mesData === mesSelecionado.padStart(2, '0');
        }
        return true; // Sem filtros, retorna todos os dados
    });
    // Redesenha a tabela com os novos filtros aplicados
    table_individual.draw();

}


$("#mudar_mes_table").on('change',function(){

    let selectAno = $('#mudar_ano_table');  // Supondo que você tenha um seletor de ano também
    let selectMes = $(this);  // O select de mês que foi alterado

    filtrarTabela(selectAno, selectMes);

    //atualizarParcelas();
    // if (parcelaSelecionada) {  // Verifica se há uma parcela selecionada
    //     updateFiltragemParcela(parcelaSelecionada);  // Reaplica a filtragem com base na parcela já selecionada
    // }

    table_individual.draw();  // Atualiza a tabela com o novo mês
    realizarContagem();       // Rea

});

// table_individual.on('draw.dt', function() {
//     //console.log("Olaaaaa");
//     realizarContagem();  // Recalcula sempre que a tabela é desenhada
// });



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
