@php
    setlocale(LC_TIME, 'pt_BR.UTF-8');
    $nome_mes_atual = ucfirst(\Carbon\Carbon::now()->translatedFormat('F'));
    $ano_atual = \Carbon\Carbon::now()->year;
@endphp

<x-app-layout>

    <div class="d-flex justify-content-center text-center text-white mt-1 p-2 rounded bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
        Dashboard {{$nome_mes_atual}} {{$ano_atual}}
    </div>

    <div class="flex flex-wrap w-full justify-between">

        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">
                <!-- Quantidade de Vidas (alinhado ao topo) -->
                <div class="flex items-start">
                    <h5 class="text-white">
                        {{$quantidade_vidas}}
                    </h5>
                </div>
                <!-- Total (centralizado) -->
                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                        Total
                    </p>
                </div>
                <!-- Valor (alinhado ao bottom) -->
                <div class="text-right text-white">
                    R$ {{ number_format($total_valor, 2, ",", ".") }}
                </div>
            </div>
        </div>


        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">

                <div class="flex items-start">
                    <h5 class="text-white">
                        {{$total_individual_quantidade_vidas}}
                    </h5>
                </div>

                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                        Individual
                    </p>
                </div>


                <div class="text-right text-white">
                    R$ {{ number_format($total_individual, 2, ",", ".") }}
                </div>
            </div>
        </div>

        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">

                <div class="flex items-start">
                    <h5 class="text-white">
                        {{$total_coletivo_quantidade_vidas}}
                    </h5>

                </div>
                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                        Coletivo
                    </p>
                </div>
                <div class="text-right text-white">
                    R$ {{ number_format($total_coletivo, 2, ",", ".") }}
                </div>

            </div>
        </div>

        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">

                <div class="flex items-start">
                    <h5 class="text-white">
                        {{$total_super_simples_quantidade_vidas}}
                    </h5>

                </div>

                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                        Super Simples
                    </p>
                </div>


                <div class="text-right text-white">
                    R$ {{ number_format($total_super_simples, 2, ",", ".") }}
                </div>
            </div>
        </div>

        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">

                <div class="flex items-start">
                    <h5 class="text-white">
                        0
                    </h5>

                </div>

                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                        PME
                    </p>
                </div>


                <div class="text-right text-white">
                    R$ 0,00
                </div>

            </div>
        </div>

        <div class="flex w-[16%] my-1">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg p-4 text-center text-white flex flex-col justify-between">

                <div class="flex items-start">
                    <h5 class="text-white">
                        0
                    </h5>

                </div>

                <div class="flex items-center justify-center flex-grow">
                    <p class="text-white">
                    Sindicato
                    </p>
                </div>

                <div class="text-right text-white">
                    R$ 0,00
                </div>

            </div>
        </div>

    </div>

    {{--Meio--}}
    <div class="flex w-full m-0 p-0" style="height: 73vh;" id="main_body">

        <div class="flex flex-col p-0 h-full" style="flex-basis:40%;margin:0 0.5% 0 0;">

            <div class="flex w-full justify-between m-0 p-0" style="height:33vh;">

                <table class="table table-sm border bg-white tabela_mes mb-0" style="width:33%;">
                    <thead>
                    <tr class="w-full  text-center">
                        <th colspan="3" class="bg-warning text-white w-full">
                            <select name="escolher_mes" id="escolher_mes" class="escolher_mes text-center font-weight-bold bg-warning" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                <option>Mês</option>
                                @foreach($mesesSelect as $ss)
                                    <option value="{{$ss->month_date}}"
                                        {{$ss->month_date == $data_atual ? 'selected' : ''}}>{{$ss->month_name_and_year}}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <tr>
                        <td>Individual</td>
                        <td class="total_individual_quantidade_vidas_mes text-center">{{$total_individual_quantidade_vidas}}</td>
                        <td class="total_individual_mes text-right">
                            <span class="mr-1">{{number_format($total_individual,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Coletivo</td>
                        <td class="total_coletivo_quantidade_vidas_mes text-center">{{$total_coletivo_quantidade_vidas}}</td>
                        <td class="total_coletivo_mes text-right">
                            <span class="mr-1">{{number_format($total_coletivo,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sup. Simples</td>
                        <td class="total_super_simples_quantidade_vidas_mes text-center">{{$total_super_simples_quantidade_vidas}}</td>
                        <td class="total_super_simples_mes text-right">
                            <span class="mr-1">{{number_format($total_super_simples,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sindipão</td>
                        <td class="total_sindipao_quantidade_vidas_mes text-center">{{$total_sindipao_quantidade_vidas}}</td>
                        <td class="total_sindipao_mes text-right">
                            <span class="mr-1">{{number_format($total_sindipao,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sindimaco</td>
                        <td class="total_sindimaco_quantidade_vidas_mes text-center">{{$total_sindimaco_quantidade_vidas}}</td>
                        <td class="total_sindimaco_mes text-right">
                            <span class="mr-1">{{number_format($total_sindimaco,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sincofarma</td>
                        <td class="total_sincofarma_quantidade_vidas_mes text-center">{{$total_sincofarma_quantidade_vidas}}</td>
                        <td class="total_sincofarma_mes text-right">
                            <span class="mr-1">{{number_format($total_sincofarma,2,",",".")}}</span>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th class="quantidade_vidas_mes text-center">{{$quantidade_vidas}}</th>
                        <th class="total_valor_mes text-right">
                            <span class="mr-1">{{number_format($total_valor,2,",",".")}}</span>
                        </th>
                    </tr>
                    </tfoot>
                </table>

                <table class="table border bg-white tabela_semestre mb-0" style="width:33%;">
                    <thead>
                    <tr class="w-100 text-center">

                        <th colspan="3" class="bg-warning text-white">
                            <select name="escolher_semestre" id="escolher_semestre" class="escolher_semestre text-center bg-warning font-weight-bold" style="border:none;background-color: #ffc107;padding:0;width:80%;">>
                                <option value="0">Semestre</option>
                                @php
                                    // Obtém o ano atual
                                    $anoAtualSemestre = date('Y');

                                    // Obtém o ano passado
                                    $anoPassadoSemestre = $anoAtualSemestre - 1;

                                    // Obtém o semestre atual (1 ou 2)
                                    $semestreAtualSemestre = (date('n') <= 6) ? 1 : 2;

                                    // Loop para adicionar os semestres do ano passado
                                    for ($semestre_s = 1; $semestre_s <= 2; $semestre_s++) {
                                        $optionValueSemestre = "$semestre_s/$anoPassadoSemestre";
                                        $optionLabelSemestre = "$semestre_s Semestre de $anoPassadoSemestre";
                                        echo "<option value=\"$optionValueSemestre\">$optionLabelSemestre</option>";
                                    }

                                    // Loop para adicionar os semestres deste ano até o semestre atual
                                    for ($semestre_a = 1; $semestre_a <= $semestreAtualSemestre; $semestre_a++) {
                                        $optionValue_a = "$semestre_a/$anoAtualSemestre";
                                        $optionLabel_a = "$semestre_a Semestre de $anoAtualSemestre";
                                        $selected_a = ($semestre_a == $semestreAtualSemestre && $anoAtualSemestre == date('Y')) ? 'selected' : '';
                                        echo "<option value=\"$optionValue_a\" $selected_a>$optionLabel_a</option>";
                                    }


                                @endphp
                            </select>
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <tr>
                        <td>Individual</td>
                        <td class="total_individual_quantidade_vidas_semestre text-center">{{$total_individual_quantidade_vidas_semestre}}</td>
                        <td class="total_individual_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_individual_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Coletivo</td>
                        <td class="total_coletivo_quantidade_vidas_semestre text-center">{{$total_coletivo_quantidade_vidas_semestre}}</td>
                        <td class="total_coletivo_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_coletivo_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sup. Simples</td>
                        <td class="total_super_simples_quantidade_vidas_semestre text-center">{{$total_super_simples_quantidade_vidas_semestre}}</td>
                        <td class="total_super_simples_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_ss_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sindipão</td>
                        <td class="total_sindipao_quantidade_vidas_semestre text-center">{{$total_sindipao_quantidade_vidas_semestre}}</td>
                        <td class="total_sindipao_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_sindipao_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sindimaco</td>
                        <td class="total_sindimaco_quantidade_vidas_semestre text-center">{{$total_sindimaco_quantidade_vidas_semestre}}</td>
                        <td class="total_sindimaco_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_sindimaco_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sincofarma</td>
                        <td class="total_sincofarma_quantidade_vidas_semestre text-center">{{$total_sincofarma_quantidade_vidas_semestre}}</td>
                        <td class="total_sincofarma_valor_semestre_valor text-right">
                            <span class="mr-1">{{number_format($total_sincofarma_semestre,2,",",".")}}</span>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th class="quantidade_vidas_semestre">{{$total_quantidade_vidas_semestre}}</th>
                        <th class="quantidade_valor_semestre text-right">
                            <span class="mr-1">{{number_format($total_valor_semestre,2,",",".")}}</span>
                        </th>
                    </tr>
                    </tfoot>
                </table>

                <table class="table border bg-white tabela_escolher_ano mb-0" style="width:33%;">
                    <thead>
                    <tr class="w-100 text-center">
                        <th colspan="3" class="bg-warning text-white">
                            <select name="escolher_ano" id="escolher_ano" class="escolher_ano text-center bg-warning text-white font-weight-bold" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                <option value="">Anos</option>
                                <option value="2023" {{$ano_atual == 2023 ? 'selected' : ''}}>2023</option>
                                <option value="2024" {{$ano_atual == 2024 ? 'selected' : ''}}>2024</option>
                            </select>
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <tr>
                        <td class="plano-col">Individual</td>
                        <td class="total_individual_quantidade_vidas_ano qtd-col text-center">{{$total_individual_quantidade_vidas_ano}}</td>
                        <td class="total_individual_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_individual_ano,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="plano-col">Coletivo</td>
                        <td class="total_coletivo_quantidade_vidas_ano qtd-col text-center">{{$total_coletivo_quantidade_vidas_ano}}</td>
                        <td class="total_coletivo_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_coletivo_ano,2,",",".")}}</span>
                        </td>
                    </tr>




                    <tr>
                        <td class="plano-col">Sup. Simples</td>
                        <td class="total_super_simples_quantidade_vidas_ano qtd-col text-center">{{$total_super_simples_quantidade_vidas_ano}}</td>
                        <td class="total_super_simples_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_ss_ano,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="plano-col">Sindipão</td>
                        <td class="total_sindipao_quantidade_vidas_ano qtd-col text-center">{{$total_sindipao_quantidade_vidas_ano}}</td>
                        <td class="total_sindipao_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_sindipao_ano,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="plano-col">Sindimaco</td>
                        <td class="total_sindimaco_quantidade_vidas_ano qtd-col text-center">{{$total_sindimaco_quantidade_vidas_ano}}</td>
                        <td class="total_sindimaco_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_sindimaco_ano,2,",",".")}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="plano-col">Sincofarma</td>
                        <td class="total_sincofarma_quantidade_vidas_ano qtd-col text-center">{{$total_sincofarma_quantidade_vidas_ano}}</td>
                        <td class="total_sincofarma_ano valor-col text-right">
                            <span class="mr-1">{{number_format($total_sincofarma_ano,2,",",".")}}</span>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th class="quantidade_vidas_ano text-center">{{$total_quantidade_vidas_ano}}</th>
                        <th class="total_vidas_ano text-right">
                            <span class="mr-1">{{number_format($total_valor_ano,2,",",".")}}</span>
                        </th>
                    </tr>
                    </tfoot>
                </table>





            </div>


            <div class="w-100 grafico_content mt-1" style="margin:0;padding:0;">

                <div id="chart_div" style="width:100vh;height:100%;"></div>
                <div id="select_div" class="mr-2">
                    <select name="selecao_ano" id="selecao_ano" class="text-center" style="margin:0;padding:0;">
                        <option value="">--Ano--</option>
                        <option value="2023" {{$ano_atual == 2023 ? "selected" : ""}}>2023</option>
                        <option value="2024" {{$ano_atual == 2024 ? "selected" : ""}}>2024</option>
                    </select>
                </div>
                <div class="w-50 justify-content-around content_legenda">
                    <span class="d-flex align-items-center">
                        <span class="text-dark">Individual</span>
                        <span class="ml-1" style="background:#1b9e77;width:10px;height:10px;"></span>
                    </span>
                    <span class="d-flex align-items-center">
                        <span class="text-dark">Coletivo</span>
                        <span class="ml-1" style="background:#d95f02;width:10px;height:10px;"></span>
                    </span>
                    <span class="d-flex align-items-center">
                        <span class="text-dark">Empresarial</span>
                        <span class="ml-1" style="background:#7570b3;width:10px;height:10px;"></span>
                    </span>
                </div>
                <div class="total_janeiro">0</div>
                <div class="total_fevereiro">0</div>
                <div class="total_marco">0</div>
                <div class="total_abril">0</div>
                <div class="total_maio">0</div>
                <div class="total_junho">0</div>
                <div class="total_julho">0</div>
                <div class="total_agosto">0</div>
                <div class="total_setembro">0</div>
                <div class="total_outubro">0</div>
                <div class="total_novembro">0</div>
                <div class="total_dezembro">0</div>
            </div>




        </div>

        <div class="flex" style="flex-basis:55%;flex-direction:column;height:100%;">
            <div class="bg-amber-300 flex items-center" style="border-radius:5px;height:5%;">
                <h5 class="flex items-center my-auto w-full">
                    <span class="flex justify-end" style="flex-basis:60%;">Ranking Vendedor</span>
                    <span class="flex justify-end" style="flex-basis:40%;">
                        <i class="fas fa-medal"></i>
                    </span>

                </h5>
            </div>

            <div class="flex my-1 ranking_classificacao" style="height:20%;">
                @foreach(collect($ranking_mes)->take(5) as $r)

                    <div class="small-box bg-blue-600 w-full mb-0 mr-1 flex">
                        <div class="d-flex justify-between w-full">
                            <div class="text-white flex flex-wrap align-between font-weight-bold" style="height:70%;width:70%;">
                                <span class="w-full ml-1" style="font-size:1em;">{{$loop->iteration}}º</span>
                                <span class="w-full ml-1" style="font-size:0.9em;">{{$r->usuario}}</span>
                            </div>
                            <div class="flex mt-1 mr-1" style="width:28%;height:45%;justify-content:flex-end;">
                                @if(file_exists("storage/".$r->image))
                                    <img src="{{asset("storage/".$r->image)}}" alt="{{$r->usuario}}" title="{{$r->usuario}}" class="img-fluid" style="border-radius:50%;">
                                @else
                                    <span style="font-size:0.7em;" class="mr-1 my-auto">{{$r->usuario}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="small-box-footer flex justify-between" style="font-size:0.8em;">
                            <span class="ml-1">{{$r->quantidade}} Vidas</span>
                            <span class="mr-2">R$ {{number_format($r->valor,2,",",".")}}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex w-full justify-between" style="height:78%;">
                <div class="content_table">
                    <table class="table table-sm border bg-white tabela_ranking_mes" style="width:100%;">
                        <thead>
                        <tr>
                            <th colspan="4" class="bg-warning">
                                <select name="ranking_mes" id="ranking_mes" class="font-weight-bold" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                    <option value="">Mês</option>
                                    @foreach($mesesSelect as $mm)
                                        <option value="{{$mm->month_date}}"
                                                style="background-color:#ffc107;"
                                            {{$mm->month_date == $data_atual ? 'selected' : ''}}
                                        >{{$mm->month_name_and_year}}</option>
                                    @endforeach
                                </select>
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($ranking_mes as $r)
                            @php
                                $parts = explode(' ', $r->usuario);
                                $nome_abreviado = $parts[0] . ' ' . ($parts[1] ?? ''); // O operador de coalescência nula (??) é usado para lidar com o caso em que o nome do corretor tem apenas uma palavra
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$nome_abreviado}}</td>
                                <td>{{$r->quantidade}}</td>
                                <td class="text-right">{{number_format($r->valor,2,",",".")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="content_table">
                    <table class="table table-sm border bg-white tabela_semestral" style="width:100%;">
                        <thead>

                        <tr>
                            <th colspan="4" class="bg-warning">
                                <select name="ranking_semestral" id="ranking_semestral" class="text-center bg-warning font-weight-bold" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                    <option value="">Semestre</option>
                                    @php
                                        // Obtém o ano atual
                                        $anoAtualSemestre = date('Y');

                                        // Obtém o ano passado
                                        $anoPassadoSemestre = $anoAtualSemestre - 1;

                                        // Obtém o semestre atual (1 ou 2)
                                        $semestreAtualSemestre = (date('n') <= 6) ? 1 : 2;

                                        // Loop para adicionar os semestres do ano passado
                                        for ($semestre_s = 1; $semestre_s <= 2; $semestre_s++) {
                                            $optionValueSemestre = "$semestre_s/$anoPassadoSemestre";
                                            $optionLabelSemestre = "$semestre_s Semestre de $anoPassadoSemestre";
                                            echo "<option value=\"$optionValueSemestre\">$optionLabelSemestre</option>";
                                        }

                                        // Loop para adicionar os semestres deste ano até o semestre atual
                                        for ($semestre_a = 1; $semestre_a <= $semestreAtualSemestre; $semestre_a++) {
                                            $optionValue_a = "$semestre_a/$anoAtualSemestre";
                                            $optionLabel_a = "$semestre_a Semestre de $anoAtualSemestre";
                                            $selected_a = ($semestre_a == $semestreAtualSemestre && $anoAtualSemestre == date('Y')) ? 'selected' : '';
                                            echo "<option value=\"$optionValue_a\" $selected_a>$optionLabel_a</option>";
                                        }


                                    @endphp
                                </select>
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($ranking_semestre as $r)
                            @php
                                $partsemestre = explode(' ', $r->usuario);
                                $nome_abreviado_semestre = $partsemestre[0] . ' ' . ($partsemestre[1] ?? ''); // O operador de coalescência nula (??) é usado para lidar com o caso em que o nome do corretor tem apenas uma palavra
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$nome_abreviado_semestre}}</td>
                                <td>{{$r->quantidade}}</td>
                                <td class="text-right">{{number_format($r->valor,2,",",".")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="content_table">
                    <table class="table table-sm border bg-white tabela_ranking_ano" style="width:100%;">
                        <thead>

                        <tr>

                            <th colspan="4" class="bg-warning">
                                <select name="ranking_ano" id="ranking_ano" class="ranking_ano text-center bg-warning font-weight-bold" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                    <option value="">Ano</option>
                                    <option value="2023" {{$ano_atual == 2023 ? 'selected' : ''}}>2023</option>
                                    <option value="2024" {{$ano_atual == 2024 ? 'selected' : ''}}>2024</option>
                                </select>
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($ranking_ano as $r)
                            @php
                                $partano = explode(' ', $r->usuario);
                                $nome_abreviado_ano = $partano[0] . ' ' . ($partano[1] ?? '');
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$nome_abreviado_ano}}</td>
                                <td>{{$r->quantidade}}</td>
                                <td class="text-right">{{number_format($r->valor,2,",",".")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



            </div>




        </div>

    </div>







    {{--Fim Meio--}}








</x-app-layout>
