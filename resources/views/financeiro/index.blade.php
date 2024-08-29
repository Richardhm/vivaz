<x-app-layout>
    <div class="ml-3 border-b-2 mt-2">
        <ul class="list_abas flex">
            <li data-id="aba_individual" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600 bg-white backdrop-blur-[15px] active-tab rounded-t" onclick="mostrarAba('aba_individual')">Individual</li>
            <li data-id="aba_coletivo" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600 bg-white backdrop-blur-[15px] rounded-t mr-2 ml-2" onclick="mostrarAba('aba_coletivo')">Coletivo</li>
            <li data-id="aba_empresarial" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600 bg-white backdrop-blur-[15px] rounded-t" onclick="mostrarAba('aba_empresarial')">Empresarial</li>
        </ul>
    </div>
    <x-upload-modal></x-upload-modal>
    <section class="conteudo_abas mt-4">
        <!--------------------------------------INDIVIDUAL------------------------------------------>
        <main id="aba_individual" class="block active-tab">
            <section class="flex flex-wrap justify-between">

                <!--COLUNA DA ESQUERDA-->
                <div class="flex flex-col text-white rounded w-[16%]" style="border-radius:5px;">
                    <button class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-lg py-2 px-4 rounded w-full">Arquivos</button>

                    <div class="flex justify-between my-3">
                        <span class="bg-[rgba(254,254,254,0.18)] hover:cursor-pointer backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%] modal_upload">Upload</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%]">Atualizar</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%]">Cancelados</span>
                    </div>

                    <a href="{{route('financeiro.formCreate')}}" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[80px] text-white text-lg mb-2 py-2 rounded w-full text-center">Cadastrar</a>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] p-1 rounded" id="content_list_individual_begin">
                        <div class="flex flex-wrap justify-around mb-4">
                            <div class="flex flex-col w-full border-b-2 border-white mb-2">
                                <p class="text-center">Listagem(Completa)</p>
                            </div>
                            <select id="mudar_ano_table" class="form-control w-[49%] text-sm">
                                <option>--Ano--</option>
                            </select>
                            <select id="mudar_mes_table" class="form-control w-[49%] text-sm">
                                <option>--Mês--</option>
                            </select>

                            <select id="select_usuario_individual" class="form-control w-full mt-4 text-sm text-black">
                                <option value="todos">---Escolher Corretor---</option>
                            </select>
                        </div>

                        <ul class="list-none space-y-2" id="list_individual_begin">
                            <li class="flex justify-between individual">
                                <span class="font-bold">Contratos:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_orcamento">0</span>
                            </li>
                            <li class="flex justify-between individual">
                                <span class="font-bold">Vidas:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_vida">0</span>
                            </li>
                            <li class="flex justify-between individual">
                                <span class="font-bold">Valor:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_page">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 my-2">
                        <ul id="atrasado_corretor">
                            <li class="flex justify-between individual">
                                <span>Atrasados</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 individual_quantidade_atrasado">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="finalizado_corretor">
                            <li class="flex justify-between individual">
                                <span>Finalizado</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] bg-transparent backdrop-blur-[80px] rounded text-right w-[49%] text-white  pr-1">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="cancelado_corretor">
                            <li class="flex justify-between individual">
                                <span>Cancelados</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded bg-transparent text-right w-[49%] text-white pr-1 individual_quantidade_atrasado">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="listar_individual">
                            <li class="flex justify-between individual" id="aguardando_pagamento_1_parcela_individual">
                                <span>Pag. 1º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] individual_quantidade_1_parcela">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1 hover:bg-gray-200 focus:bg-gray-300" id="aguardando_pagamento_2_parcela_individual">
                                <span>Pag. 2º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] text-white individual_quantidade_2_parcela">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1 hover:bg-gray-200 focus:bg-gray-300" id="aguardando_pagamento_3_parcela_individual">
                                <span>Pag. 3º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] individual_quantidade_3_parcela">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1 hover:bg-gray-200 focus:bg-gray-300" id="aguardando_pagamento_4_parcela_individual">
                                <span>Pag. 4º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] individual_quantidade_4_parcela">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1 hover:bg-gray-200 focus:bg-gray-300" id="aguardando_pagamento_5_parcela_individual">
                                <span>Pag. 5º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] individual_quantidade_5_parcela">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Fim Coluna da Esquerda-->

                <!--COLUNA CENTRAL-->
                <div class="flex w-[83%] mr-1 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
                    <div class="text-white rounded p-4 w-full">
                        <table id="tabela_individual" class="table table-sm listarindividual w-100">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Cod.</th>
                                <th>Corretor</th>
                                <th>Cliente</th>
                                <th>CPF</th>
                                <th>Vidas</th>
                                <th>Valor</th>
                                <th>Venc.</th>
                                <th>Atrasado</th>
                                <th>Status</th>
                                <th>Ver</th>
                                <th>Atrasado</th>
                            </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                    </div>
                </div>
                <!--FIM COLUNA CENTRAL-->
            </section>
        </main>

        <!-------------------------------------OUTRAS ABAS------------------------------------------>
        <main id="aba_coletivo" class="hidden">

            <section class="flex justify-between flex-wrap content-start">
                <!--COLUNA DA ESQUERDA-->
                <div class="flex flex-col text-white basis-[16%] rounded-lg">
                    <div class="flex mb-1 justify-between">
            <span class="bg-[rgba(254,254,254,0.18)] hover:cursor-pointer backdrop-blur-[15px] text-white text-sm py-2 text-center rounded basis-[49%]">
                <a class="text-center text-white" href="{{route('contratos.create.coletivo')}}">Cadastrar</a>
            </span>
                        <span class="bg-[rgba(254,254,254,0.18)] hover:cursor-pointer backdrop-blur-[15px] text-white text-sm py-2 text-center rounded btn_upload_coletivo basis-[49%]">
                Upload
            </span>
                    </div>

                    <div id="content_list_coletivo_begin" class="destaque_content_radius bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
                        <div class="flex w-full justify-center  mb-1 py-1">
                            <p class="m-0 p-0">Listagem(Completa)</p>
                        </div>

                        <div class="flex justify-around flex-wrap">
                            <div class="flex">
                                <select id="mudar_ano_table_coletivo" class="form-control">
                                    <option value="todos" class="text-center">-Anos-</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <div class="flex">
                                <select id="mudar_mes_table_coletivo" class="form-control">
                                    <option value="00" class="text-center">-Meses-</option>
                                    <option value="01">Janeiro</option>
                                    <option value="02">Fevereiro</option>
                                    <option value="03">Março</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Maio</option>
                                    <option value="06">Junho</option>
                                    <option value="07">Julho</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Setembro</option>
                                    <option value="10">Outubro</option>
                                    <option value="11">Novembro</option>
                                    <option value="12">Dezembro</option>
                                </select>
                            </div>
                            <select class="form-control flex w-full" id="select_usuario">
                                <option value="todos" class="text-center">---Escolher Corretor---</option>
                            </select>


                            <select class="form-control w-full" id="select_coletivo_administradoras">
                                <option value="todos" class="text-center">---Administradora---</option>
                            </select>
                        </div>

                        <ul class="list-none m-0 py-1" id="list_coletivo_begin">
                            <li class="px-2 flex justify-between mb-1 coletivo">
                                <span class="flex basis-[50%] font-bold">Contratos:</span>
                                <span class="badge badge-light total_por_orcamento_coletivo flex basis-[50%] justify-end">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo">
                                <span class="flex basis-[50%] font-bold">Vidas:</span>
                                <span class="badge badge-light total_por_vida_coletivo flex basis-[50%] justify-end">0</span>
                            </li>
                            <li class="px-2 flex justify-between coletivo">
                                <span class="flex basis-[50%] font-bold">Valor:</span>
                                <span class="badge badge-light total_por_page_coletivo flex basis-[50%] justify-end">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-red-500 rounded-lg my-1">
                        <ul class="list-none m-0 py-1" id="atrasado_corretor_coletivo">
                            <li class="px-1 flex justify-between">
                                <span>Atrasados</span>
                                <span class="badge badge-light coletivo_quantidade_atrasado w-[45px] text-right">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg my-1">
                        <ul class="list-none m-0 py-1" id="finalizado_corretor_coletivo">
                            <li class="px-1 flex justify-between">
                                <span>Finalizado</span>
                                <span class="badge badge-light quantidade_coletivo_finalizado w-[45px] text-right">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg my-1">
                        <ul class="list-none m-0 py-1" id="listar">
                            <li class="px-2 flex justify-between mb-1 coletivo" id="em_analise_coletivo">
                                <span>Em Analise</span>
                                <span class="badge badge-light coletivo_quantidade_em_analise w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="emissao_boleto_coletivo">
                                <span>Emissão Boleto</span>
                                <span class="badge badge-light coletivo_quantidade_emissao_boleto w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_adesao_coletivo">
                                <span>Pag. Adesão</span>
                                <span class="badge badge-light coletivo_quantidade_pagamento_adesao w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_vigencia_coletivo">
                                <span>Pag. Vigência</span>
                                <span class="badge badge-light coletivo_quantidade_pagamento_vigencia w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_segunda_parcela">
                                <span>Pag. 2º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_segunda_parcela w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_terceira_parcela">
                                <span>Pag. 3º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_terceira_parcela w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_quarta_parcela">
                                <span>Pag. 4º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_quarta_parcela w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_quinta_parcela">
                                <span>Pag. 5º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_quinta_parcela w-[45px] text-right">0</span>
                            </li>
                            <li class="px-2 flex justify-between mb-1 coletivo" id="pagamento_sexta_parcela">
                                <span>Pag. 6º Parcela</span>
                                <span class="badge badge-light coletivo_quantidade_sexta_parcela w-[45px] text-right">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg">
                        <ul class="list-none m-0 py-1" id="grupo_finalizados">
                            <li class="px-1 flex justify-between mb-1 coletivo" id="cancelado_coletivo">
                                <span>Cancelados</span>
                                <span class="badge badge-light quantidade_coletivo_cancelados w-[45px] text-right">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--FIM COLUNA DA ESQUERDA-->

                <!--COLUNA DA CENTRAL-->
                <div class="basis-[83%]">
                    <div class="bg-[#123449] text-white rounded-lg">
                        <table id="tabela_coletivo" class="table-auto table-sm listardados w-full">
                            <thead>
                            <tr>
                                <th>Datas</th>
                                <th>Cod.</th>
                                <th>Corretor</th>
                                <th>Cliente</th>
                                <th>Admin</th>
                                <th>CPF</th>
                                <th>Vidas</th>
                                <th>Valor</th>
                                <th>Venc.</th>
                                <th>Status</th>
                                <th>Ver</th>
                                <th>Teste</th>
                                <th>Data Nasc.</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Cidade</th>
                                <th>UF</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!--FIM COLUNA CENTRAL-->
            </section>










        </main>

        <main id="aba_empresarial" class="hidden">
            <section class="flex flex-wrap justify-between">

                <!--COLUNA DA ESQUERDA-->
                <div class="flex flex-col text-white space-y-2 bg-transparent backdrop-filter backdrop-blur-md p-4 rounded" style="flex-basis:16%;border-radius:5px;">
                    <!-- Conteúdo da Coluna Esquerda (Empresarial) -->
                </div>
                <!--Fim Coluna da Esquerda-->

                <!--COLUNA CENTRAL-->
                <div class="flex-grow">
                    <!-- Conteúdo da Coluna Central (Empresarial) -->
                </div>
                <!--FIM COLUNA CENTRAL-->
            </section>
        </main>
    </section>

    <script>
        function mostrarAba(id) {
            // Esconder todas as abas
            document.querySelectorAll('.conteudo_abas main').forEach((aba) => {
                aba.classList.add('hidden');
                aba.classList.remove('active-tab');
            });

            // Remover estilo de aba ativa
            document.querySelectorAll('.list_abas li').forEach((tab) => {
                tab.classList.remove('text-blue-600', 'font-bold', 'border-t-6', 'bg-orange-400');
                tab.classList.add('text-gray-600', 'hover:text-blue-600');
            });

            // Mostrar a aba selecionada
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('active-tab');

            // Adicionar estilo à aba ativa
            document.querySelector(`[data-id=${id}]`).classList.add('text-blue-600', 'font-bold', 'border-t-6', 'bg-orange-400');
        }
        mostrarAba('aba_individual');

        $(document).ready(function(){
            $('.modal_upload').on('click', function() {
                $('#uploadModal').addClass('show');
            });

            $('#uploadModal .close, #uploadModal').on('click', function() {
                $('#uploadModal').removeClass('show');
            });







            $("#arquivo_upload").on('change',function(e){
                var files = $('#arquivo_upload')[0].files;
                var load = $(".ajax_load");
                // let file = $(this).val();
                var fd = new FormData();
                fd.append('file',files[0]);
                // fd.append('file',e.target.files[0]);
                $.ajax({
                    url:"{{route('financeiro.sincronizar')}}",
                    method:"POST",
                    data:fd,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        load.fadeIn(200).css("display", "flex");
                        //$('#uploadModal').modal('hide');
                    },
                    success:function(res) {

                        if(res == "sucesso") {
                            window.location.reload();
                            // load.fadeOut(200);
                            // $('#uploadModal').modal('show');
                            // $(".div_icone_arquivo_upload").removeClass('btn-danger').addClass('btn-success').html('<i class="far fa-smile-beam fa-lg"></i>');
                            // $("#arquivo_upload").val('').prop('disabled',true);

                        } else {

                        }

                    }
                });
            });





            $("#arquivo_atualizar").on('change',function(){
                let files = $('#arquivo_atualizar')[0].files;
                let load = $(".ajax_load");
                // let file = $(this).val();
                let fd = new FormData();
                fd.append('file',files[0]);
                // fd.append('file',e.target.files[0]);
                $.ajax({
                    url:"{{route('financeiro.sincronizar.baixas.jaexiste')}}",
                    method:"POST",
                    data:fd,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#atualizarModal').modal('hide');
                        load.fadeIn(200).css("display", "flex");

                    },
                    success:function(res) {
                        if(res == "successo") {
                            load.fadeOut(200);
                            window.location.reload();
                        }

                    }
                });
            });






            var table_individual = $(".listarindividual").DataTable({
                dom: '<"flex justify-between"<"#title_individual">ftr><t><"flex justify-between"lp>',

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
                    "url":"{{ route('financeiro.individual.geralIndividualPendentes') }}",
                    "dataSrc": "data"
                },
                "lengthMenu": [500,1000],
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
                    {data:"status",name:"status"}
                ],
                "columnDefs": [
                    {"targets": 0,"width":"2%"},
                    {"targets": 1,"width":"5%"},
                    {"targets": 2,"width":"18%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            let corretor = cellData.split(" ").slice(0, 2).join(" ");
                            $(td).html(corretor);
                        }
                    },
                    {"targets": 3,"width":"18%",
                         "createdCell": function (td, cellData, rowData, row, col) {
                            let cliente = cellData.split(" ").slice(0, 4).join(" ");
                            $(td).html(cliente);
                        }
                    },
                    {"targets": 4,"width":"14%"},
                    {"targets": 5,"width":"5%"},
                    {"targets": 6,"width":"8%"},
                    {"targets": 7,"width":"5%"},
                    {"targets": 8,"width":"3%","visible": false},
                    {"targets": 9,"width":"10%"},
                    {"targets": 10,"width":"2%",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if(cellData == "Cancelado") {
                                var id = cellData;
                                $(td).html(`<div class='text-center text-white'>
                                            <a href="" class="text-white">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                        </div>
                                    `);
                            } else {
                                var id = rowData.id;
                                $(td).html(`<div class='text-center text-white'>
                                            <a href="/financeiro/detalhes/${id}" class="text-white">
                                                <i class='fas fa-eye div_info'></i>
                                            </a>
                                        </div>
                                    `);
                            }
                        }
                    },
                    {"targets": 11,"visible":false}
                ],
                "initComplete": function( settings, json ) {
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Listagem(Completa)</h4>");
                    let countPagamento1 = this.api().column(9).data().filter((value, index) => value === 'Pag. 1º Parcela').length;
                    let countPagamento2 = this.api().column(9).data().filter((value, index) => value === 'Pag. 2º Parcela').length;
                    let countPagamento3 = this.api().column(9).data().filter((value, index) =>  value === 'Pag. 3º Parcela').length;
                    let countPagamento4 = this.api().column(9).data().filter((value, index) => value === 'Pag. 4º Parcela').length;
                    let countPagamento5 = this.api().column(9).data().filter((value, index) =>  value === 'Pag. 5º Parcela').length;
                    let countPagamento6 = this.api().column(9).data().filter((value, index) => value === 'Pag. 6º Parcela').length;
                    let countAtrasado = this.api().column(11).data().filter((value, index) => value === 'Atrasado').length;
                    let countCancelados = this.api().column(9).data().filter((value, index) =>  value === 'Cancelado').length;

                    let finalizado = this.api().column(9).data().filter((value, index) => value === 'Finalizado').length;
                    let countAprovado = this.api().column(11).data().filter((value, index) =>  value === 'Aprovado').length;


                    $(".individual_quantidade_1_parcela").text(countPagamento1);
                    $(".individual_quantidade_2_parcela").text(countPagamento2);
                    $(".individual_quantidade_3_parcela").text(countPagamento3);
                    $(".individual_quantidade_4_parcela").text(countPagamento4);
                    $(".individual_quantidade_5_parcela").text(countPagamento5);
                    $(".individual_quantidade_6_parcela").text(countPagamento6);
                    $(".individual_quantidade_cancelado").text(countCancelados);
                    $(".individual_quantidade_atrasado").text(countAtrasado);
                    let corretoresUnicos = new Set();
                    this.api().column(2).data().each(function(v) {
                        corretoresUnicos.add(v);
                    });
                    let corretoresOrdenados = Array.from(corretoresUnicos).sort();
                    $('#select_usuario_individual').empty();
                    $('#select_usuario_individual').append('<option class="text-dark" value="todos">-- Escolher Corretor --</option>');
                    corretoresOrdenados.forEach(function(corretor) {
                        $('#select_usuario_individual').append('<option class="text-dark" value="' + corretor + '">' + corretor + '</option>');
                    });

                    let anos = this.api().column(0).data().toArray().map(function(value) {
                        let year = new Date(value).getFullYear();
                        return !isNaN(year) ? year : null;
                    });
                    let anosUnicos = new Set(anos.filter(function(ano) {return ano !== null;}));

                    let selectAno = $('#mudar_ano_table');
                    selectAno.empty(); // Limpar opções existentes
                    selectAno.append('<option class="text-black" value="" selected>- Ano -</option>'); // Opção padrão
                    anosUnicos.forEach(function(ano) {
                        selectAno.append('<option class="text-black" value="' + ano + '">' + ano + '</option>');
                    });

                    let countAtrasadoTeste = this.api().rows().count(); // Inicialmente, contamos todas as linhas
                    countAtrasadoTeste = countAtrasadoTeste - countPagamento6 - countCancelados - countAprovado;

                    $(".individual_quantidade_atrasado").text(countAtrasadoTeste);


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

            $("ul#listar_individual li.individual").on('click',function() {
                let id_lista = $(this).attr('id');
                if(id_lista == "aguardando_pagamento_1_parcela_individual") {
                    let mes = $("#mudar_mes_table").val();
                    let dataId = $("#select_usuario_individual").find('option:selected').data('id');
                    $('#title_individual').html("<h4 style='font-size:1em;margin-top:10px;margin-left:5px;'>Pagamento 1º Parcela</h4>");
                    table_individual.column(11).search('').draw();
                    table_individual.column(9).search('Pag. 1º Parcela').draw();
                    $(".container_edit").addClass('ocultar')
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
                } else {

                }

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
                selectMes.append('<option value="" selected>- Mês -</option>'); // Opção padrão
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
                    selectMes.append('<option class="text-black" value="' + (mes) + '">' + nomesMeses[mes] + '</option>');
                });

            });







        });



    </script>
    <style>
        th { font-size: 0.8em !important; }
        td { font-size: 0.7em !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important; /* Define a cor da fonte como branca */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important; /* Mantém a cor da fonte branca ao passar o mouse */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: white !important; /* Define a cor da fonte do botão atual como branca */
        }

        #mudar_ano_table option selected {
            color: #FFF !important;
        }


    </style>
</x-app-layout>
