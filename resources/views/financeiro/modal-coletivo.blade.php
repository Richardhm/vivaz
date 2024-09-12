<div class="flex flex-wrap">
    <div class="flex justify-end w-full">

        <button id="closeModalColetivo" class="text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] hover:bg-red-600 p-1 rounded-full">
            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>

        </button>
    </div>



    <!-- Bloco da Esquerda (Formulário 60%) -->
    <div class="flex basis-[48%] pr-1 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] py-1 shadow-lg rounded-lg border mr-1">
        <form>
            <!-- 1ª Linha (Corretor) -->
            <div class="grid grid-cols-4 gap-4 mb-2">
                <div class="col-span-3">
                    <label for="corretor" class="block text-white text-sm">Corretor</label>
                    <input type="text" id="corretor" value="{{$corretor}}" class="w-full bg-gray-100 text-gray-800 p-1 text-sm rounded-md">
                </div>
                <div>
                    <label for="status" class="block text-white text-sm">Status</label>
                    <input type="text" value="{{$status}}" id="status" class="w-full bg-gray-100 text-gray-800 p-1 text-sm  rounded-md">
                </div>
            </div>

            <!-- 2ª Linha (Cliente, CPF, Data Nascimento) -->
            <div class="grid grid-cols-4 gap-4 mb-2">
                <div class="col-span-2">
                    <label for="cliente" class="block text-white text-sm">Cliente</label>
                    <input type="text" id="cliente" value="{{$cliente}}" class="w-full bg-gray-100 text-gray-800 p-1 text-sm  rounded-md">
                </div>
                <div>
                    <label for="cpf" class="block text-white text-sm">CPF</label>
                    <input type="text" id="cpf" value="{{$cpf}}" class="w-full bg-gray-100 text-gray-800 p-1 text-sm  rounded-md">
                </div>
                <div>
                    <label for="data_nascimento" class="block text-white text-sm">Data Nascimento</label>
                    <input type="date" id="data_nascimento" value="{{$nascimento}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
            </div>

            <!-- 3ª Linha (Código Externo e Email) -->
            <div class="grid grid-cols-2 gap-4 mb-2">
                <div>
                    <label for="codigo_externo" class="block text-white text-sm">Código Externo</label>
                    <input type="text" id="codigo_externo" value="{{$codigo_externo}}" class="w-full text-sm  bg-gray-100 text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="email" class="block text-white text-sm">Email</label>
                    <input type="email" id="email" value="{{$email}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
            </div>

            <!-- 4ª Linha (CEP, Cidade, UF, Bairro) -->
            <div class="grid grid-cols-4 gap-4 mb-2">
                <div>
                    <label for="cep" class="block text-white text-sm">CEP</label>
                    <input type="text" id="cep" value="{{$cep}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="cidade" class="block text-white text-sm">Cidade</label>
                    <input type="text" id="cidade" value="{{$cidade}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="uf" class="block text-white text-sm">UF</label>
                    <input type="text" id="uf" value="{{$uf}}" class="w-full bg-gray-100 text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="bairro" class="block text-white text-sm">Bairro</label>
                    <input type="text" id="bairro" value="{{$bairro}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
            </div>

            <!-- 5ª Linha (Rua, Complemento) -->
            <div class="grid grid-cols-2 gap-4 mb-2">
                <div>
                    <label for="rua" class="block text-white text-sm">Rua</label>
                    <input type="text" id="rua" value="{{$rua}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="complemento" class="block text-white text-sm">Complemento</label>
                    <input type="text" id="complemento" value="{{$complemento}}" class="w-full bg-gray-100 text-sm  text-gray-800 p-1 rounded-md">
                </div>
            </div>

            <!-- 6ª Linha (Data Contrato, Valores, Descontos) -->
            <div class="grid grid-cols-5 gap-4 mb-2">
                <div>
                    <label for="data_contrato" class="block text-white text-sm">Data Contrato</label>
                    <input type="date" id="data_contrato" class="w-full bg-gray-100 text-gray-800 p-1 text-sm  rounded-md">
                </div>
                <div>
                    <label for="valor_contrato" class="block text-white text-sm">Valor Contrato</label>
                    <input type="text" id="valor_contrato" value="{{$valor_plano}}" class="w-full bg-gray-100 text-gray-800 p-1 text-sm  rounded-md">
                </div>
                <div>
                    <label for="valor_adesao" class="block text-white text-sm">Valor Adesão</label>
                    <input type="text" id="valor_adesao" value="{{$valor_adesao}}" class="w-full bg-gray-100 text-gray-800 p-1 text-sm rounded-md">
                </div>
                <div>
                    <label for="desconto_corretora" class="block text-white text-sm">Desc. Corretora</label>
                    <input type="text" id="desconto_corretora" value="{{$desconto_corretora}}" class="w-full text-sm  bg-gray-100 text-gray-800 p-1 rounded-md">
                </div>
                <div>
                    <label for="desconto_corretor" class="block text-white text-sm">Desc. Corretor</label>
                    <input type="text" id="desconto_corretor" value="{{$desconto_corretor}}" class="w-full text-sm  bg-gray-100 text-gray-800 p-1 rounded-md">
                </div>
            </div>
        </form>
    </div>

    <!-- Bloco da Direita (40%) -->
    <div class="flex basis-[49%] flex-wrap  p-2 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg border">


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-white rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-1 py-2">
                        #
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Contrato
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Vencimento
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Valor
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Baixa
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Atrasado
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Ação
                    </th>
                    <th scope="col" class="px-1 py-2">
                        Desfazer
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="font-size:0.875em;">Em Analise</td>
                    <td style="font-size:0.875em;">{{$codigo_externo}}</td>
                    <td style="font-size:0.875em;">-</td>
                    <td style="font-size:0.875em;">-</td>
                    <td style="font-size:0.875em;" class="data_analise">-</td>
                    <td style="font-size:0.875em;">-</td>
                    <td class="acao_aqui">
                        @if($dados->data_analise == "")
                            <button type="button" data-id="{{$id}}" class="em_analise text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">Conferido</button>
                        @else
                            <button type="button" class="text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        @endif
                    </td>
                    <td class="text-center flex justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" data-id="{{$id}}" data-fase="1" viewBox="0 0 24 24" fill="currentColor" id="desfazer_1" class="size-6">
                            <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                        </svg>

                    </td>
                </tr>
                <tr>
                    <td style="font-size:0.875em;">Emissão Boleto</td>
                    <td style="font-size:0.875em;">{{$codigo_externo}}</td>
                    <td style="font-size:0.875em;">-</td>
                    <td style="font-size:0.875em;">-</td>
                    <td style="font-size:0.875em;" class="data_emissao">-</td>
                    <td style="font-size:0.875em;">-</td>
                    <td class="acao_aqui">
                        @if($dados->data_emissao == "")
                            <button type="button" data-id="{{$id}}" class="emissao_boleto focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 w-11/12">Emitido</button>
                        @else
                            <button type="button" class="text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" data-fase="2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        @endif
                    </td>
                    <td class="text-center flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" data-fase="2" data-id="{{$id}}" viewBox="0 0 24 24" fill="currentColor" id="desfazer_2" class="size-6">
                            <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                        </svg>
                    </td>
                </tr>
                @foreach($dados->comissao->comissoesLancadas as $kk => $cr)
                    @php
                        $fase = 0;
                    @endphp
                    <tr>
                        <td class="" style="font-size:0.875em;">
                            @switch($cr->parcela)
                                @case(1)
                                    Pag. Adesão
                                    @php
                                        $fase = 3;
                                    @endphp
                                    @break;
                                @case(2)
                                    Pag. Vigência
                                    @php
                                        $fase = 4;
                                    @endphp
                                    @break;
                                @case(3)
                                    Pag. 2º Parcela
                                    @php
                                        $fase = 6;
                                    @endphp
                                    @break;
                                @case(4)
                                    Pag. 3º Parcela
                                    @php
                                        $fase = 7;
                                    @endphp
                                    @break;
                                @case(5)
                                    Pag. 4º Parcela
                                    @php
                                        $fase = 8;
                                    @endphp
                                    @break;
                                @case(6)
                                    Pag. 5º Parcela
                                    @php
                                        $fase = 9;
                                    @endphp
                                    @break;
                                @case(7)
                                    Pag. 6º Parcela
                                    @php
                                        $fase = 11;
                                    @endphp
                                @break;
                            @endswitch

                        </td>
                        <td style="font-size:0.875em;">
                            {{$dados->codigo_externo}}

                        </td>
                        <td style="font-size:0.875em;">
                            {{date('d/m/Y',strtotime($cr->data))}}
                        </td>
                        <td style="font-size:0.875em;">
                            @if($cr->parcela == 1)
                                <span style="margin-left:10px;">{{number_format($dados->valor_adesao ,2,",",".")}}</span>
                            @else
                                <span style="margin-left:10px;">{{number_format($dados->valor_plano,2,",",".")}}</span>
                            @endif
                        </td>
                        <td style="font-size:0.875em;" class="data_baixa">
                            @if(empty($cr->data_baixa) && $cr->cancelados == 1)
                                <span style="margin-left:20px;color:red;">Cancelado</span>
                            @elseif(empty($cr->data_baixa))
                                <span style="margin-left:20px;">---</span>
                            @else
                                <span style="margin-left:20px;">{{date('d/m/Y',strtotime($cr->data_baixa))}}</span>
                        @endif

                        <td style="font-size:0.875em;text-align:center;">{{$cr->quantidade_dias}}</td>
                        <td class="acao_aqui">
                            @if($cr->status_financeiro == 0)
                                <input type="date" data-id="{{$id}}" min="{{date('Y-m-d', strtotime('1900-01-01'))}}"
                                       max="{{$cr->data}}" class="bg-gray-100 text-gray-800 p-1 text-sm rounded-md next date-picker">
                            @else
                                <button type="button" class="em_analise text-center text-white flex justify-center cursor-not-allowed bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-blue-800 w-11/12">
                                    <svg class="w-6 h-6 text-white dark:text-white text-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            @endif
                        </td>
                        <td class="text-center flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" data-fase="{{$fase}}" data-id="{{$id}}" viewBox="0 0 24 24" fill="currentColor" id="desfazer_{{$kk+3}}" class="size-6">
                                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                            </svg>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
