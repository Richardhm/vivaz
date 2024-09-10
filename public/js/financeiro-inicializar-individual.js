function inicializarIndividual(corretora_id = null) {

    if($.fn.DataTable.isDataTable('.listarindividual')) {
        $('.listarindividual').DataTable().destroy();
    }

    $(".listarindividual").DataTable({
        dom: '<"flex justify-between"<"#title_individual">Bftr><t><"flex justify-between"lp>',

        language: {
            "search": "Pesquisar",
            "paginate": {
                "next": "Próx.",
                "previous": "Ant.",
                "first": "Primeiro",
                "last": "Último"
            },
            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 até 0 de 0 registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "infoThousands": ".",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "lengthMenu": "Exibir _MENU_ por página"
        },
        processing: true,

        ajax: {
            "url":urlGeralIndividualPendentes,
            data: function (d) {
                d.corretora_id = corretora_id;
            }
        },
        "lengthMenu": [100,200,250,300,400],
        "ordering": false,
        "paging": true,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        columns: [
            {data:"data",name:"data"},
            {data:"orcamento",name:"orcamento"},
            {data:"corretor",name:"corretor"},
            {data:"cliente",name:"cliente"},
            {data:"cpf",name:"cpf",
                "createdCell": function (td, cellData, rowData, row, col) {
                    let cpf = cellData.substr(0,3)+"."+cellData.substr(3,3)+"."+cellData.substr(6,3)+"-"+cellData.substr(9,2);
                    $(td).html(cpf);
                }
            },
            {data:"quantidade_vidas",name:"vidas"},
            {data:"valor_plano",name:"valor_plano",render: $.fn.dataTable.render.number('.', ',', 2, '')},
            {data:"vencimento",name:"vencimento"},
            {data:"vencimento",name:"atrasado"},
            {data:"parcelas",name:"parcelas"},
            {data:"id",name:"ver"},
            {data:"status",name:"status"},


        ],
        "columnDefs": [
            {"targets": 0,"width":"8%"},
            {"targets": 1,"width":"8%"},
            {"targets": 2,"width":"14%",
                "createdCell":function(td, cellData, rowData, row, col) {
                    let words = cellData.split(" ");

                    // Limita para as duas primeiras palavras
                    if (words.length > 2) {
                        $(td).html(words.slice(0, 2).join(" ") + "...");
                    } else {
                        $(td).html(cellData);  // Se for menos de 2 palavras, mostra tudo
                    }
                }
            },
            {"targets": 3,"width":"22%"},//cliente
            {"targets": 4,"width":"12%"},//cpf
            {"targets": 5,"width":"5%"},//vidas
            {"targets": 6,"width":"8%"},//valor
            {"targets": 7,"width":"8%"},//vencimento
            {"targets": 8,"width":"3%","visible": false},
            {"targets": 9,"width":"10%"},
            {"targets": 10,"width":"2%",
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == "Cancelado") {
                        var id = cellData;
                        $(td).html(`<div class='text-center text-white'>
                                            <a href="/financeiro/cancelado/detalhes/${id}" class="text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 div_info">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            </a>
                                        </div>
                                    `);
                    } else {
                        var id = rowData.id;
                        $(td).html(`<div class='text-center text-white'>
                                            <a href="/financeiro/detalhes/${id}" class="text-white">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 div_info">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            </a>
                                        </div>
                                    `);
                    }
                }
            },
            {"targets": 11,"width":"3%","visible": false},
        ],
        "initComplete": function( settings, json ) {

            $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'></h4>");
            let countPagamento1 = this.api().column(9).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
            let countPagamento2 = this.api().column(9).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
            let countPagamento3 = this.api().column(9).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
            let countPagamento4 = this.api().column(9).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
            let countPagamento5 = this.api().column(9).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
            let countPagamento6 = this.api().column(9).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
            let finalizado = this.api().column(9).data().filter((value, index) => value === 'Finalizado').length;
            let countCancelados = this.api().column(9).data().filter((value, index) =>  value === 'Cancelado').length;

            let countAprovado = this.api().column(11).data().filter((value, index) =>  value === 'Aprovado').length;

            let countAtrasadoTeste = this.api().rows().count(); // Inicialmente, contamos todas as linhas
            countAtrasadoTeste = countAtrasadoTeste - countPagamento6 - finalizado - countCancelados - countAprovado;
            let tablein = $('.listarindividual').DataTable();
            $(".individual_quantidade_1_parcela").text(countPagamento1);
            $(".individual_quantidade_2_parcela").text(countPagamento2);
            $(".individual_quantidade_3_parcela").text(countPagamento3);
            $(".individual_quantidade_4_parcela").text(countPagamento4);
            $(".individual_quantidade_5_parcela").text(countPagamento5);
            $(".individual_quantidade_6_parcela").text(finalizado);
            $(".individual_quantidade_cancelado").text(countCancelados);
            $(".individual_quantidade_atrasado").text(countAtrasadoTeste);

            let corretoresUnicos = new Set();
            this.api().column(2).data().each(function(v) {
                corretoresUnicos.add(v);
            });
            let corretoresOrdenados = Array.from(corretoresUnicos).sort();

            // $('#select_usuario_individual').append('<option value="todos">-- Escolher Corretor --</option>');
            // corretoresOrdenados.forEach(function(corretor) {
            //     $('#select_usuario_individual').append('<option value="' + corretor + '">' + corretor + '</option>');
            // });

            let anos = this.api().column(0).data().toArray().map(function(value) {
                let year = new Date(value).getFullYear();
                return !isNaN(year) ? year : null;
            });
            let anosUnicos = new Set(anos.filter(function(ano) {return ano !== null;}));

            let selectAno = $('#mudar_ano_table');
            selectAno.empty(); // Limpar opções existentes
            selectAno.append('<option value="" selected class="text-white text-center">- Ano -</option>'); // Opção padrão
            anosUnicos.forEach(function(ano) {
                selectAno.append('<option class="text-white text-center" value="' + ano + '">' + ano + '</option>');
            });
        },
        "drawCallback": function( settings ) {
            var api = this.api();
            if(settings.ajax.url.split('/')[6] == "atrsado") {
                api.column(8).visible(true);
            } else {
                api.column(8).visible(false);
            }
        },

        footerCallback: function (row, data, start, end, display) {
            var intVal = (i) => typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            total = this.api().column(6,{search: 'applied'}).data().reduce(function (a, b) {return intVal(a) + intVal(b);}, 0);
            total_vidas = this.api().column(5,{search: 'applied'}).data().reduce(function (a, b) {return intVal(a) + intVal(b);},0);
            total_linhas = this.api().column(5,{search: 'applied'}).data().count();
            total_br = total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
            $(".total_por_page").html(total_br)
            $(".total_por_vida").html(total_vidas);
            $(".total_por_orcamento").html(total_linhas);
        }
    });
}

var table_individual = $('#tabela_individual').DataTable();
$('#tabela_individual').on('click', 'tbody tr', function () {
    table_individual.$('tr').removeClass('textoforte');
    $(this).closest('tr').addClass('textoforte');
});
inicializarIndividual();
