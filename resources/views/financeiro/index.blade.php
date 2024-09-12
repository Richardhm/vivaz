<x-app-layout>
    @section('css')
       <link rel="stylesheet" href="{{asset('css/estilo-financeiro.css')}}"/>
    @endsection
    <input type="hidden" id="janela_atual" value="aba_individual">

        <!-- Modal -->
        <script>
            var urlGeralIndividualPendentes = "{{ route('financeiro.individual.geralIndividualPendentes') }}";
            var urlGeralColetivoPendentes = "{{ route('financeiro.coletivo.em_geral') }}";
            var urlGeralEmpresarialPendentes = "{{ route('contratos.listarEmpresarial.listarContratoEmpresaPendentes') }}";
            var financeiroSincroniza = "{{route('financeiro.sincronizar')}}";
            var atualizarIndividual = "{{route('financeiro.sincronizar.baixas.jaexiste')}}";
            var cancelarIndividual = "{{route('financeiro.sincronizar.cancelados')}}";
            var table;
        </script>
        @if(auth()->user()->can('listar_todos'))
            <div style="display:flex;justify-content: center;">
                    <button data-corretora="1" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white" style="border:none;width: 150px;padding: 8px 5px;border-radius:5px;margin-right:5px;">Accert</button>
                    <button data-corretora="2" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white" style="border:none;width: 150px;padding: 8px 5px;border-radius:5px;margin-right:5px;">Innove</button>
                    <button data-corretora="0" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white" style="border:none;width: 150px;padding: 8px 5px;border-radius:5px;">Vivaz</button>
            </div>
        @endif
    <div style="width:95%;margin:0 auto;">
        <ul class="list_abas">
            <li data-id="aba_individual" class="ativo">Individual</li>
            <li data-id="aba_coletivo">Coletivo</li>
            <li data-id="aba_empresarial">Empresarial</li>
        </ul>
    </div>
    <x-upload-modal></x-upload-modal>
    <x-upload-atualizar></x-upload-atualizar>

        <div id="myModalColetivo" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] z-40"></div>
            <!-- Conteúdo da Modal -->
            <div class="relative w-11/12 rounded-lg shadow-3xl p-2 z-50">
                <!-- Botão Fechar no Topo -->
                <div id="modalLoader" class="flex justify-center items-center h-64">
                    <div class="dot-flashing">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <!-- Borda Animada -->
                <div class="relative p-1 rounded-lg animate-border overflow-hidden content-modal-coletivo hidden">
                </div>
            </div>
        </div>

        <div id="myModalEmpresarial" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] z-40"></div>
            <!-- Conteúdo da Modal -->
            <div class="relative w-11/12 rounded-lg shadow-3xl p-2 z-50">
                <!-- Botão Fechar no Topo -->
                <div id="modalLoaderEmpresa" class="flex justify-center items-center h-64">
                    <div class="dot-flashing">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <!-- Borda Animada -->
                <div class="relative p-1 rounded-lg animate-border overflow-hidden content-modal-empresarial hidden">
                </div>
            </div>
        </div>


        <section class="conteudo_abas mt-2" style="width:95%;margin:0 auto;">
        <x-aba-individual></x-aba-individual>
        <x-aba-coletivo></x-aba-coletivo>
        <x-aba-empresarial></x-aba-empresarial>
    </section>
    @section('scripts')
            <script src="{{asset('js/financeiro-arquivo.js')}}"></script>
            <script src="{{asset('js/financeiro-inicializar-individual.js')}}"></script>
            <script src="{{asset('js/financeiro-inicializar-coletivo.js')}}"></script>
            <script src="{{asset('js/financeiro-inicializar-empresarial.js')}}"></script>

            <script src="{{asset('js/financeiro-click-menus.js')}}"></script>
            <script src="{{asset('js/financeiro-change-menus.js')}}"></script>

            <script src="{{asset('js/financeiro-parametro-url.js')}}"></script>
        @endsection
    <script>

        $(document).ready(function(){


            $("#select_usuario_individual").select2({
                dropdownCssClass: 'text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg border-gray-300 shadow-md', // Estilo para o dropdown
                width: '100%', // Faz o select ocupar a largura completa
            });

            // Adiciona manualmente as classes Tailwind ao contêiner do select2
            $(".select2-container--default .select2-selection--single").addClass('text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg border-gray-300 shadow-md');

            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }



            function totalMes() {
                return $("#select_usuario_individual").val();
            }


            String.prototype.ucWords = function () {
                let str = this.toLowerCase()
                let re = /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g
                return str.replace(re, s => s.toUpperCase())
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click','.open-modal-empresarial',function(e){
                e.preventDefault();
                let vendedor = $(this).data("vendedor");
                let plano = $(this).data("plano");
                let origens = $(this).data("origens");
                let razao_social = $(this).data("razao_social");
                let cnpj = $(this).data("cnpj");
                let vidas = $(this).data("vidas");
                let celular = $(this).data("celular");
                let email = $(this).data("email");
                let responsavel = $(this).data("responsavel");
                let cidade = $(this).data("cidade");
                let uf = $(this).data("uf");
                let plano_contratado = $(this).data("plano_contratado");
                let codigo_corretora = $(this).data("codigo_corretora");
                let codigo_saude = $(this).data("codigo_saude");
                let codigo_odonto = $(this).data("codigo_odonto");
                let senha_cliente = $(this).data("senha_cliente");
                let valor_saude = $(this).data("valor_saude");
                let valor_odonto = $(this).data("valor_odonto");
                let valor_total = $(this).data("valor_total");
                let taxa_adesao = $(this).data("taxa_adesao");
                let valor_boleto = $(this).data("valor_boleto");
                let vencimento_boleto = $(this).data("vencimento_boleto");
                let data_boleto = $(this).data("boleto");
                let id = $(this).data('id');
                let codigo_externo = $(this).data('codigo_externo');
                let data_analise = $(this).data('analise');

                $.ajax({
                    url:"{{route('financeiro.modal.contrato.empresarial')}}",
                    method:"POST",
                    data: {
                        data_analise:data_analise,
                        vendedor: vendedor,
                        plano: plano,
                        origens: origens,
                        razao_social: razao_social,
                        cnpj: cnpj,
                        vidas: vidas,
                        celular: celular,
                        email: email,
                        responsavel: responsavel,
                        cidade: cidade,
                        uf: uf,
                        id: id,
                        plano_contratado: plano_contratado,
                        codigo_corretora: codigo_corretora,
                        codigo_saude: codigo_saude,
                        codigo_odonto: codigo_odonto,
                        senha_cliente: senha_cliente,
                        valor_saude: valor_saude,
                        valor_odonto: valor_odonto,
                        valor_total: valor_total,
                        taxa_adesao: taxa_adesao,
                        valor_boleto: valor_boleto,
                        vencimento_boleto: vencimento_boleto,
                        data_boleto: data_boleto,
                        codigo_externo: codigo_externo
                    },
                    success:function(res){
                        $('#modalLoaderEmpresa').addClass('hidden');
                        $('.content-modal-empresarial').removeClass('hidden');
                        $(".content-modal-empresarial").html(res);
                    }

                });


                $('#myModalEmpresarial').removeClass('hidden').addClass('flex');


            });

            // $(document).on('click', function(e) {
            //     if (!$(e.target).closest('.content-modal-coletivo').length && !$(e.target).hasClass('open-modal')) {
            //         $('#myModalColetivo').removeClass('flex').addClass('hidden');
            //         $('.content-modal-coletivo').html('');
            //     }
            // });


            $(document).on('click', '.open-modal', function(e) {
                e.preventDefault();

                $('#modalLoader').removeClass('hidden');
                let cliente = $(this).data("cliente");
                let cpf = $(this).data("cpf");
                let codigo_externo = $(this).data("codigo");
                let rua = $(this).data("rua");
                let cidade = $(this).data("cidade");
                let bairro = $(this).data("bairro");
                let email = $(this).data("email");
                let cep = $(this).data("cep");
                let corretor = $(this).data("corretor");
                let nascimento = $(this).data("nascimento");
                let uf = $(this).data("uf");
                let id = $(this).data("id");

                let valor_adesao = $(this).data("adesao");
                let valor_plano = $(this).data("valorplano");
                let desconto_corretora = $(this).data("descontocorretora") ?? 0;
                let desconto_corretor = $(this).data("descontocorretor") ?? 0;

                let status = $(this).data('status');
                let financeiro = $(this).data('financeiro');

                $.ajax({
                   url:"{{route('financeiro.modal.contrato.coletivo')}}",
                   method:"POST",
                   data: {
                       status,
                       cliente,
                       cpf,
                       codigo_externo,
                       rua,
                       cidade,
                       bairro,
                       email,
                       cep,
                       corretor,
                       nascimento,
                       uf,
                       valor_adesao,
                       valor_plano,
                       desconto_corretora,
                       desconto_corretor,
                       id,
                       financeiro
                   },
                   success:function(res){
                       $('#modalLoader').addClass('hidden');
                       $('.content-modal-coletivo').removeClass('hidden');
                        $(".content-modal-coletivo").html(res);
                   }
                });


                // Exibe a modal
                $('#myModalColetivo').removeClass('hidden').addClass('flex');
                $('#modalLoader').removeClass('hidden');
            });


            $("body").on('click','.em_analise_empresarial',function(){
                let id = $(this).data('id');
                let self = $(this);
                $.ajax({
                    url:"{{route('financeiro.analise.empresarial')}}",
                    method:"POST",
                    data: {
                        id
                    },

                    success:function(res) {
                        if(res != "error") {
                            //$("body").find('#status').val("Emissão Boleto");
                            $("body").find(".em_analise_empresarial").text(res);
                            self.empty();
                            self.prop('disabled',true).html(`
                             <button type="button" class="em_analise text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                    <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>

                                </button>
                            `);

                        }
                    }
                })
            });





            $("body").on('click','.em_analise',function(){
               let id = $(this).data('id');
               let self = $(this);
               $.ajax({
                   url:"{{route('financeiro.analise.coletivo')}}",
                   method:"POST",
                   data: {
                       id
                   },

                   success:function(res) {
                        if(res != "error") {
                            $("body").find('#status').val("Emissão Boleto");
                            $("body").find(".data_analise").text(res);
                            self.closest('td').html(`
                                <button type="button" class="text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                    <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            `);


                        }
                   }
               })
            });

            $("body").on('click','.emissao_boleto',function(){
                let id = $(this).data('id');
                let self = $(this);
                $.ajax({
                    url:"{{route('financeiro.analise.boleto')}}",
                    method:"POST",
                    data: {
                        id
                    },
                    success:function(res) {
                        if(res != "error") {
                            $("body").find('#status').val("Pag. Adesão");
                            $("body").find(".data_emissao").text(res);
                            //self.closest('td').empty('');
                            self.closest('td').html(`
                                <button type="button" class="text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                    <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>
                               </button>
                           `);
                        }
                    }
                })
            });

            $("body").on('change','.next_empresarial',function(){
                let id = $(this).data('id');
                let data_baixa = $(this).val();
                let self = $(this);
                $.ajax({
                    url:"{{route('financeiro.baixa.data.empresarial')}}",
                    method:"POST",
                    data: {
                        id,data_baixa
                    },
                    success:function(res) {
                        let dataOriginal = res.baixa;
                        function formatarData(data) {
                            let partes = data.split('-');
                            return `${partes[2]}/${partes[1]}/${partes[0]}`;
                        }
                        self.closest('tr').find('.data_baixa_empresarial').html(`<span style="margin-left:20px;">${formatarData(dataOriginal)}</span>`);
                        self.closest('td').html(`
                            <button type="button" class="em_analise text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        `)

                        inicializarEmpresarial();
                    }

                });


            });

            $("body").on('click', '[id^="desfazer_"]', function(){
                let id = $(this).attr('id');
                let number = id.split('_')[1];//Pega o número após o underscore (_)
                let contrato_id = $(this).data("id");
                let fase = $(this).data('fase');

                if(number == 1) {
                    $(this).closest("tr").find('.acao_aqui').html(`
                        <button type="button" class="em_analise text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">Conferido</button>
                    `);
                } else if(number == 2) {
                    $(this).closest("tr").find('.acao_aqui').html(`
                        <button type="button" class="emissao_boleto focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 w-11/12">Emitido</button>
                    `);
                } else {
                    $(this).closest("tr").find('.acao_aqui').html(`
                        <input type='date' data-id='' min=''
                                       max='' class='bg-gray-100 text-gray-800 p-1 text-sm rounded-md next date-picker'>
                    `);
                }


                $.ajax({
                   url:"{{route('desfazer.tarefa.coletivo')}}",
                   method:"POST",
                   data: {
                       contrato_id,
                       fase
                   },
                   sucession:function(res){
                        console.log(res);
                   }
                });





            });







            $("body").on('keydown', '.next', function(e) {
                e.preventDefault(); // Impede qualquer entrada de texto no campo
            });

            var currentStep = 1; // Etapa inicial

            $('.step-btn').on('click', function() {
                let step = $(this).data('step');
                if(step === currentStep) {
                    currentStep++;
                    $('#step-' + currentStep).show(); // Exibe a próxima etapa
                    if (currentStep >= 3) {
                        $('#step-' + currentStep + '-date').prop('disabled', false); // Habilita o campo de data
                    }
                    $(this).prop('disabled', true);
                } else {
                    alert('Por favor, complete a etapa anterior antes de prosseguir.');
                }
            });

            $('input[type="date"]').on('change', function() {
                let step = parseInt($(this).attr('id').split('-')[1]); // Pega o número da etapa
                if (step === currentStep) {
                    currentStep++;
                    $('#step-' + currentStep).show();
                    $('#step-' + currentStep + '-date').prop('disabled', false);
                } else {
                    alert('Por favor, complete a etapa anterior antes de prosseguir.');
                }
            });


            $("body").on('change','.next',function(){
                $(this).css('color', 'transparent');
                var dateInput = $(this).val();
                var datePattern = /^\d{4}-\d{2}-\d{2}$/; // Formato esperado: yyyy-mm-dd

                if (!datePattern.test(dateInput)) {
                    alert('Por favor, insira a data no formato correto (yyyy-mm-dd).');
                    $(this).val(''); // Limpa o campo
                    return;
                }

                var selectedDate = new Date(dateInput);
                var maxDate = new Date($(this).attr('max'));

                if (selectedDate > maxDate) {
                    alert('A data de baixa não pode ser maior que a data de vencimento!');
                    $(this).val(''); // Limpa o campo se a data for inválida
                    return;
                }







                let id = $(this).data('id');
                let valor = $(this).val();
                let self = $(this);

                $.ajax({
                    url:"{{route('financeiro.baixa.data')}}",
                    method:"POST",
                    data: {
                        id,valor
                    },
                    success:function(res) {
                        console.log(res);
                        $("body").find('#status').val(res.status);
                        let dataOriginal = res.baixa;

                        function formatarData(data) {
                            let partes = data.split('-');
                            return `${partes[2]}/${partes[1]}/${partes[0]}`;
                        }
                        self.closest('tr').find('.data_baixa').html(`<span style="margin-left:20px;">${formatarData(dataOriginal)}</span>`);
                        self.closest('td').html(`<button type="button" class="em_analise text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                            <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                            </svg>
                            </button>`)
                        inicializarColetivo();
                    }
                });
            });

            // Fechar a modal quando clicar no botão de fechar
            $("body").on('click','#closeModalColetivo',function(){
                $('#myModalColetivo').removeClass('flex').addClass('hidden');
                $('.content-modal-coletivo').html('');

            })



        });
    </script>
</x-app-layout>
