<main id="aba_empresarial" class="hidden">

    <section class="flex justify-between" style="flex-wrap: wrap;">
        <div class="flex flex-col text-white ml-1" style="flex-basis:16%;border-radius:5px;">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded" style="margin:1px 0;">
                <ul style="list-style:none;margin:0;padding:5px 0;" id="cadastrar_empresarial">
                    <li style="padding:0px 3px;display:flex;text-align:center;justify-content:center;">
                        <a class="text-center w-full text-white text-lg" href="{{route('contratos.create.empresarial')}}">Financeiro</a>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] mb-1 p-1" id="content_list_empresarial_begin">
                <div class="flex flex-wrap w-full gap-2 mb-1">
                    <div style="display:flex;flex-basis:48%;">
                        <select id="mudar_ano_table_empresarial" class="text-white bg-transparent border border-gray-300 rounded-md py-2 px-2 w-full">
                            <option value="" class="text-center">-Anos-</option>
                            <option value="2022">2022</option>
                            <option value="2023" selected>2023</option>
                        </select>
                    </div>
                    <div style="display:flex;flex-basis:48%;">
                        <select id="mudar_mes_table_empresarial" class="text-white bg-transparent border border-gray-300 rounded-md py-2 px-2 w-full">
                            <option value="" class="text-center">-Meses-</option>
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

                    <select style="flex-basis:99%;" name="mudar_user_empresarial" id="mudar_user_empresarial" class="text-center text-white bg-transparent border border-gray-300 rounded-md py-2 me-2 px-2 mx-auto">
                        <option value="todos" class="text-center" data-id="0">---Escolher Corretor---</option>

                    </select>

                    <select style="flex-basis:99%;" name="mudar_planos_empresarial" id="mudar_planos_empresarial" class="text-center text-white bg-transparent border border-gray-300 rounded-md py-2 me-2 px-2 mx-auto">
                        <option value="todos" class="text-center" data-id="0">---Escolher Planos---</option>

                    </select>

                </div>

                <ul id="list_empresarial_begin" class="list-none m-0">
                    <li style="height:30px;line-height: 30px;" class="flex mb-1 justify-between empresarial">
                        <span class="flex basis-[50%] text-sm items-center my-auto">Contratos:</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right pr-1 w-[30%] bg-transparent text-sm  flex basis-[50%] justify-end text-sm total_por_orcamento_empresarial" style="text-align:right;">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="flex mb-1 justify-between empresarial">
                        <span class="flex basis-[50%] text-sm items-center my-auto">Vidas:</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-transparent text-sm total_por_vida_empresarial pr-1" style="text-align:right;">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="flex mb-1 justify-between empresarial">
                        <span class="flex basis-[50%] text-sm items-center my-auto">Valor:</span>
                        <span class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded text-right w-[49%] bg-transparent text-sm total_por_page_empresarial pr-1" style="text-align:right;">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="atrasado_corretor_empresarial">
                    <li style="height:30px;line-height: 30px;" class="flex justify-between empresarial">
                        <span class="text-sm">Atrasados</span>
                        <span class="text-right rounded w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1  text-right flex justify-end empresarial_quantidade_atrasado">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="finalizado_corretor_empresarial">
                    <li style="height:30px;line-height: 30px;" class="empresarial flex justify-between">
                        <span class="text-sm">Finalizado</span>
                        <span class="text-right rounded w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1  text-right flex justify-end quantidade_empresarial_finalizado" style="text-align:right;">0</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">

                <ul class="list-none m-0 py-1" id="listar_empresarial">

                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_em_analise_empresarial">
                        <span class="text-sm">Em Análise</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_em_analise">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_1_parcela_empresarial">
                        <span class="text-sm">Pag. 1º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_1_parcela">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_2_parcela_empresarial">
                        <span class="text-sm">Pag. 2º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_2_parcela">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_3_parcela_empresarial">
                        <span class="text-sm">Pag. 3º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_3_parcela">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_4_parcela_empresarial">
                        <span class="text-sm">Pag. 4º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_4_parcela">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_5_parcela_empresarial">
                        <span class="text-sm">Pag. 5º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_5_parcela">0</span>
                    </li>
                    <li style="height:30px;line-height: 30px;" class="mb-1 justify-between flex justify-end empresarial" id="aguardando_pagamento_6_parcela_empresarial">
                        <span class="text-sm">Pag. 6º Parcela</span>
                        <span class="text-right w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1 rounded empresarial_quantidade_6_parcela">0</span>
                    </li>
                </ul>
            </div>


            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded p-2 mb-1">
                <ul id="aguardando_cancelado_empresarial">
                    <li style="height:30px;line-height: 30px;" class="empresarial flex justify-between">
                        <span class="text-sm">Cancelado</span>
                        <span class="text-right rounded w-[30%] text-sm text-black bg-transparent backdrop-blur-[80px] text-white pr-1  text-right flex justify-end empresarial_quantidade_cancelado" style="text-align:right;">0</span>
                    </li>
                </ul>
            </div>
        </div>

        <!--COLUNA DA CENTRAL-->
        <div style="flex-basis:83%;">
            <div class="p-2 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded" style="color:#FFF;">
                <table id="tabela_empresarial" class="table table-sm listarempresarial" style="table-layout: fixed;">

                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cod.</th>
                        <th>Corretor</th>
                        <th>Cliente</th>
                        <th>CNPJ</th>
                        <th>Vidas</th>
                        <th>Valor</th>
                        <th>Plano</th>
                        <th>Venc.</th>
                        <th>Status</th>
                        <th>Detalhes</th>
                        <th>Resposta</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--FIM COLUNA DA CENTRAL-->
    </section>
</main>
