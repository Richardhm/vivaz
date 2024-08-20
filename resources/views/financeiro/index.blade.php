<x-app-layout>
    <div class="ml-3 border-b-2 mt-2">
        <ul class="list_abas flex">
            <li data-id="aba_individual" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600 bg-white backdrop-blur-[15px] active-tab rounded-t" onclick="mostrarAba('aba_individual')">Individual</li>
            <li data-id="aba_coletivo" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600" onclick="mostrarAba('aba_coletivo')">Coletivo</li>
            <li data-id="aba_empresarial" class="cursor-pointer p-4 text-gray-600 hover:text-blue-600" onclick="mostrarAba('aba_empresarial')">Empresarial</li>
        </ul>
    </div>

    <section class="conteudo_abas mt-4">
        <!--------------------------------------INDIVIDUAL------------------------------------------>
        <main id="aba_individual" class="block active-tab">
            <section class="flex flex-wrap justify-between">

                <!--COLUNA DA ESQUERDA-->
                <div class="flex flex-col text-white rounded w-[16%]" style="border-radius:5px;">
                    <button class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-lg py-2 px-4 rounded w-full">Arquivos</button>

                    <div class="flex justify-between my-3">
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%]">Upload</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%]">Atualizar</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-[30%]">Cancelados</span>
                    </div>

                    <a href="#" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[80px] text-white text-lg mb-2 py-2 rounded w-full text-center">Cadastrar</a>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] p-1 rounded" id="content_list_individual_begin">
                        <div class="flex flex-wrap justify-around mb-4">
                            <div class="flex flex-col w-full border-b-2 border-white mb-2">
                                <p class="text-center">Listagem(Completa)</p>
                            </div>
                            <select id="mudar_ano_table" class="form-control w-[49%] text-sm">
                                <option>--Ano--</option>
                                <option>2023</option>
                                <option>2024</option>
                            </select>
                            <select id="mudar_mes_table" class="form-control w-[49%] text-sm">
                                <option>--Mês--</option>
                                <option>Janeiro</option>
                                <option>Fevereiro</option>
                            </select>
                            <select id="select_usuario_individual" class="form-control w-full mt-4 text-sm">
                                <option value="todos">---Escolher Corretor---</option>
                            </select>
                        </div>

                        <ul class="list-none space-y-2" id="list_individual_begin">
                            <li class="flex justify-between individual">
                                <span class="font-bold">Contratos:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1">11110</span>
                            </li>
                            <li class="flex justify-between individual">
                                <span class="font-bold">Vidas:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1">121250</span>
                            </li>
                            <li class="flex justify-between individual">
                                <span class="font-bold">Valor:</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1">545455</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 my-2">
                        <ul id="atrasado_corretor">
                            <li class="flex justify-between individual">
                                <span>Atrasados</span>
                                <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1">545455</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="finalizado_corretor">
                            <li class="flex justify-between individual">
                                <span>Finalizado</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black pr-1">0</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="cancelado_corretor">
                            <li class="flex justify-between individual">
                                <span>Cancelados</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black pr-1">1500</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-2">
                        <ul id="listar_individual">
                            <li class="flex justify-between individual">
                                <span>Pag. 1º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1">
                                <span>Pag. 2º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1">
                                <span>Pag. 3º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1">
                                <span>Pag. 4º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black">0</span>
                            </li>
                            <li class="flex justify-between individual space-y-1">
                                <span>Pag. 5º Parcela</span>
                                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-gray-100 text-black">0</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Fim Coluna da Esquerda-->

                <!--COLUNA CENTRAL-->
                <div class="flex w-[83%] mr-1">
                    <div class="text-white rounded p-4 w-full">
                        <table id="tabela_individual" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
                            <tr>
                                <td>Data</td>
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
                                <th>Data Nasc.</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Rua</th>
                                <th>Cep</th>
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
            <section class="flex flex-wrap justify-between">

                <!--COLUNA DA ESQUERDA-->
                <div class="flex flex-col text-white space-y-2 bg-transparent backdrop-filter backdrop-blur-md p-4 rounded" style="flex-basis:16%;border-radius:5px;">
                    <!-- Conteúdo da Coluna Esquerda (Coletivo) -->
                </div>
                <!--Fim Coluna da Esquerda-->

                <!--COLUNA CENTRAL-->
                <div class="flex-grow">
                    <!-- Conteúdo da Coluna Central (Coletivo) -->
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
                tab.classList.remove('text-blue-600', 'font-bold', 'border-b-2', 'border-blue-600');
                tab.classList.add('text-gray-600', 'hover:text-blue-600');
            });

            // Mostrar a aba selecionada
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('active-tab');

            // Adicionar estilo à aba ativa
            document.querySelector(`[data-id=${id}]`).classList.add('text-blue-600', 'font-bold', 'border-b-2', 'border-blue-600');
        }
    </script>
    <style>

    </style>
</x-app-layout>
