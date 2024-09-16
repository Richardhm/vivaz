<main id="aba_individual" class="block active-tab">
    <section class="flex flex-wrap justify-between">

        <!--COLUNA DA ESQUERDA-->
        <div class="flex flex-col text-white rounded w-[16%]" style="border-radius:5px;">
            {{--                    <button class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-lg py-1 px-4 rounded w-full text-sm">Arquivos</button>--}}

            <div class="flex justify-between my-1">
                <span class="bg-[rgba(254,254,254,0.18)] hover:cursor-pointer backdrop-blur-[15px] text-white text-xs py-2 text-center rounded w-[30%] modal_upload">Upload</span>
                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-xs py-2 text-center rounded w-[30%] btn-atualizar">Atualizar</span>
                <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white text-xs py-2 text-center rounded w-[30%]">Cancelados</span>
            </div>

            {{--                    <a href="{{route('financeiro.formCreate')}}" class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[80px] text-white text-lg mb-1 py-1 rounded w-full text-center text-sm">Cadastrar</a>--}}

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] p-1 rounded" id="content_list_individual_begin">
                <div class="flex flex-wrap justify-around mb-0 w-full">

                    <select id="select_usuario_individual"
                            class="w-full mt-1 rounded-lg mb-1 text-center text-sm bg-[rgba(254,254,254,0.18)]
                            active:bg-[rgba(254,254,254,0.18)] hover:bg-gray-800 py-2 mr-1 focus:bg-gray-800 w-full text-xs px-1 mb-2 text-sm font-medium rounded-lg hover:border-transparent focus:border-transparent border-transparent
                            "
                            tabindex="-1" aria-hidden="true"></select>
                    <div class="flex w-full justify-center mt-2">
                        <select id="mudar_ano_table" class="flex basis-[49%] mr-1 py-2 text-lg justify-center text-white bg-[rgba(254,254,254,0.18)] focus:outline-none active:outline-none active:bg-[rgba(254,254,254,0.18)] hover:bg-gray-800 py-2 mr-1 focus:bg-gray-800 w-full text-xs px-1 mb-2 text-sm font-medium text-black rounded-lg hover:border-transparent focus:border-transparent border-transparent">
                            <option>--Ano--</option>
                        </select>
                        <select id="mudar_mes_table" class="flex basis-[49%] py-2 text-lg text-center justify-center text-white bg-[rgba(254,254,254,0.18)] focus:outline-none active:outline-none active:bg-[rgba(254,254,254,0.18)] hover:bg-gray-800 py-2 text-black focus:bg-gray-800 w-full text-xs px-1 mb-2 text-sm font-medium text-black rounded-lg hover:border-transparent focus:border-transparent border-transparent">
                            <option>--Mês--</option>
                        </select>
                    </div>



                </div>

                <ul class="list-none rounded p-1" id="list_individual_begin">
                    <li style="height:30px;line-height: 30px;" class="flex justify-between my-auto individual space-y-1">
                        <span class="text-sm my-auto">Contratos:</span>
                        <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_orcamento text-sm">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="flex justify-between individual space-y-1">
                        <span class="text-sm">Vidas:</span>
                        <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_vida text-sm">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="flex justify-between individual space-y-1">
                        <span class="text-sm">Valor:</span>
                        <span class="text-right rounded w-[49%] text-black bg-transparent backdrop-blur-[80px] text-white pr-1 total_por_page text-sm">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 my-1">
                <ul id="atrasado_corretor">
                    <li class="flex justify-between individual" style="height:30px;line-height: 30px;">
                        <span class="text-sm">Atrasados</span>
                        <span class="text-right rounded w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 individual_quantidade_atrasado">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="finalizado_corretor">
                    <li class="flex justify-between individual" style="height:30px;line-height: 30px;">
                        <span class="text-sm">Finalizado</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] bg-transparent backdrop-blur-[80px] text-sm rounded text-right w-[30%] text-white  pr-1">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="cancelado_corretor">
                    <li class="flex justify-between individual" style="height:30px;line-height: 30px;">
                        <span class="text-sm">Cancelados</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded bg-transparent text-sm text-right w-[30%] text-white pr-1 individual_quantidade_cancelado">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="listar_individual">
                    <li class="flex justify-between individual hover:cursor-pointer" style="height:30px;" id="aguardando_pagamento_1_parcela_individual">
                        <span class="text-sm">Pag. 1º Parcela</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[30%] bg-transparent text-sm individual_quantidade_1_parcela pr-1">0</span>
                    </li>
                    <li style="height:30px;" class="flex justify-between individual space-y-1 focus:bg-gray-300 hover:cursor-pointer" id="aguardando_pagamento_2_parcela_individual">
                        <span class="text-sm">Pag. 2º Parcela</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[30%] bg-transparent text-sm text-white individual_quantidade_2_parcela pr-1">0</span>
                    </li>
                    <li style="height:30px;" class="flex justify-between individual space-y-1 focus:bg-gray-300 hover:cursor-pointer" id="aguardando_pagamento_3_parcela_individual">
                        <span class="text-sm">Pag. 3º Parcela</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[30%] bg-transparent text-sm individual_quantidade_3_parcela pr-1">0</span>
                    </li>
                    <li style="height:30px;" class="flex justify-between individual space-y-1 focus:bg-gray-300 hover:cursor-pointer" id="aguardando_pagamento_4_parcela_individual">
                        <span class="text-sm">Pag. 4º Parcela</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[30%] bg-transparent text-sm individual_quantidade_4_parcela pr-1">0</span>
                    </li>
                    <li style="height:30px;" class="flex justify-between individual space-y-1 focus:bg-gray-300 hover:cursor-pointer" id="aguardando_pagamento_5_parcela_individual">
                        <span class="text-sm">Pag. 5º Parcela</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[30%] bg-transparent text-sm individual_quantidade_5_parcela pr-1">0</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--Fim Coluna da Esquerda-->

        <!--COLUNA CENTRAL-->
        <div class="flex w-[83%] mr-1 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
            <div class="text-white rounded p-4 w-full">
                <table id="tabela_individual" class="table table-sm listarindividual w-100 text-left">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cod.</th>
                        <th>Corretor</th>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Vidas</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
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
