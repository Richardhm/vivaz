@php
    setlocale(LC_TIME, 'pt_BR.UTF-8');
    $nome_mes_atual = ucfirst(\Carbon\Carbon::now()->translatedFormat('F'));
    $ano_atual = \Carbon\Carbon::now()->year;
@endphp

<x-app-layout>


    @section('css')
        <style>
            .content_table {height:100%;overflow:auto;width:32.8%;border-radius:5px;}
            .content_table::-webkit-scrollbar {width: 5px;}
            .content_table::-webkit-scrollbar-track {background: #f1f1f1;border-radius: 5px;}
            .content_table::-webkit-scrollbar-thumb {background: #ffc107;border-radius: 5px;}
            .content_table::-webkit-scrollbar-thumb:hover {background: #555;}

            #chart_div {
                margin:5px 0 0 0;
                width:80%;height:370px !important;
                background-color: rgba(254, 254, 254, 0.18) !important;
                backdrop-filter: blur(15px) !important;
                border-radius: 8px !important;
                color:white;
                border-radius:5px;
                padding:10px;

            }






            .content_table_dados_tabela {height:600px;overflow:auto;}
            .content_table_dados_tabela::-webkit-scrollbar {width: 5px;}
            .content_table_dados_tabela::-webkit-scrollbar-track {background: #f1f1f1;border-radius: 5px;}
            .content_table_dados_tabela::-webkit-scrollbar-thumb {background: #ffc107;border-radius: 5px;}
            .content_table_dados_tabela::-webkit-scrollbar-thumb {background: #ffc107;border-radius: 5px;}

            .small-box .icon > i.fas {font-size: 30px !important;}
            .header_info .small-box > .small-box-footer {position:absolute !important;width:100% !important;bottom:0px !important;font-size:0.8em !important;}
            .ranking_classificacao .small-box .small-box-footer {position:absolute !important;width:100% !important;bottom:0px !important;}
            .header_info .small-box > .small-box-footer .inner p {font-size:0.7em !important;}
            .header_info .small-box > .small-box-footer .inner h5 {font-size:0.8em !important;}
            .table th, .table td {padding: 0.30rem !important;vertical-align: middle;font-size:0.75em;}
            .content_legenda {z-index: 1000;position:absolute;left:210px;top:30px;font-size:0.7em;display:none;font-size:0.6em !important;}
            .grafico_content {position:relative;width:100%;margin:0;padding:0;height:40vh;}
            #select_div {position: absolute;top: 10px;right: 0;z-index: 1000;display:none;}
            .total_janeiro {position: absolute;top: 340px;left: 60px;z-index: 1000;font-size:0.6em ;color:#FFF;display:none;}
            .total_fevereiro {position: absolute;top: 340px;left: 120px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_marco {position: absolute;top: 340px;left: 178px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_abril {position: absolute;top: 340px;left: 242px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_maio {position: absolute;top: 340px;left: 302px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_junho {position: absolute;top: 340px;left: 362px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_julho {position: absolute;top: 340px;left: 432px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_agosto {position: absolute;top: 340px;left: 480px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_setembro {position: absolute;top: 340px;left: 540px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_outubro {position: absolute;top: 340px;left: 600px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_novembro {position: absolute;top: 340px;left: 660px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .total_dezembro {position: absolute;top: 340px;left: 720px;z-index: 1000;font-size:0.6em;color:#FFF;display:none;}
            .tabela_semestre .plano-col {width: 65% !important;}
            .tabela_semestre .qtd-col {width: 5% !important;}
            .tabela_semestre .valor-col {width: 30% !important;}
            .tabela_escolher_ano .plano-col {width: 65% !important;}
            .tabela_escolher_ano .qtd-col {width: 5% !important;}
            .tabela_escolher_ano .valor-col {width: 30% !important;}
            .tabela_mes .plano-col {width: 65% !important;}
            .tabela_mes .qtd-col {width: 5% !important;}
            .tabela_mes .valor-col {width: 30% !important;}
            .escolher_mes {border: none;}
            .escolher_mes:focus {outline: none;}
            .total-label {position: absolute;bottom: 0;left: 50%;transform: translateX(-50%);font-size: 12px;font-weight: bold;color: #000;}
            .select2-container .select2-selection__rendered {text-align: center;}
            .select2-selection {background-color: #ffc107 !important;color: black !important;}
            .select2-container--default .select2-selection--single {background-color: #ffc107 !important;color: black !important;border:none;padding:0;height:0;}
            .select2-container--default .select2-selection--single .select2-selection__arrow {height:0px;right:0px;top:-1px;}
            .select2-container--default .select2-selection--single .select2-selection__rendered {padding-left: 0;margin-top: -13px;}
            #ranking_mes option {background-color: #ffc107 !important;}
            .select2-container--default .select2-results__option[aria-selected="true"],.select2-results__option {background-color: #ffc107 !important;}
            .select2-container--default .select2-dropdown--below {top: 20px !important;}
        </style>

    @stop


        <input type="hidden" id="total_individual_grafico" value="{{$total_individual_quantidade_vidas}}">
        <input type="hidden" id="total_coletivo_grafico" value="{{$total_coletivo_quantidade_vidas}}">
        <input type="hidden" id="total_super_simples_grafico" value="{{$total_super_simples_quantidade_vidas}}">
        <input type="hidden" id="total_pme_grafico" value="0">
        <input type="hidden" id="total_sindipao_grafico" value="{{$total_sindipao_quantidade_vidas}}">
        <input type="hidden" id="total_sincofarma_grafico" value="{{$total_sindimaco_quantidade_vidas}}">
        <input type="hidden" id="total_sindimaco_grafico" value="{{$total_sincofarma_quantidade_vidas}}">




    <section style="width:95%;margin:0 auto;font-size:0.875em;">



       <div class="flex flex-wrap w-full justify-between" style="margin-top: 5px;margin-bottom:5px;">

           <div class="flex w-[16%] my-1  relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">
                   <!-- Quantidade de Vidas (alinhado ao topo, lado esquerdo) -->
                   <div class="absolute top-0 left-0">
                       <h5 class="text-white ml-3">
                           {{$quantidade_vidas}}
                       </h5>
                   </div>
                   <!-- Total (centralizado) -->
                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           Total
                       </p>
                   </div>
                   <!-- Valor (alinhado ao bottom, lado direito) -->
                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                           R$ {{ number_format($total_valor, 2, ",", ".") }}
                       </p>
                   </div>
               </div>
           </div>



           <div class="flex w-[16%] my-1 relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">

                   <div class="absolute top-0 left-0">
                       <h5 class="text-white ml-3">
                           {{$total_individual_quantidade_vidas}}
                       </h5>
                   </div>

                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           Individual
                       </p>
                   </div>


                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                            R$ {{ number_format($total_individual, 2, ",", ".") }}
                       </p>
                   </div>
               </div>
           </div>

           <div class="flex w-[16%] my-1 relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">

                   <div class="absolute top-0 left-0">
                       <h5 class="text-white ml-3">
                           {{$total_coletivo_quantidade_vidas}}
                       </h5>

                   </div>
                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           Coletivo
                       </p>
                   </div>
                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                       R$ {{ number_format($total_coletivo, 2, ",", ".") }}
                       </p>
                   </div>

               </div>
           </div>

           <div class="flex w-[16%] my-1 relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">

                   <div class="absolute top-0 left-0">
                       <p class="text-white ml-3">
                           {{$total_super_simples_quantidade_vidas}}
                       </p>

                   </div>

                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           Super Simples
                       </p>
                   </div>


                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                        R$ {{ number_format($total_super_simples, 2, ",", ".") }}
                       </p>
                   </div>
               </div>
           </div>

           <div class="flex w-[16%] my-1 relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">

                   <div class="absolute top-0 left-0">
                       <p class="text-white ml-3">
                           0
                       </p>

                   </div>

                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           PME
                       </p>
                   </div>


                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                            R$ 0,00
                       </p>
                   </div>

               </div>
           </div>

           <div class="flex w-[16%] my-1 relative">
               <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full rounded-lg py-12 text-white relative h-full text-base">

                   <div class="absolute top-0 left-0">
                       <h5 class="text-white ml-3">
                           0
                       </h5>

                   </div>

                   <div class="flex items-center justify-center h-full">
                       <p class="text-white">
                           Sindicato
                       </p>
                   </div>

                   <div class="absolute right-0" style="bottom: 5px;margin-right:5px;">
                       <p class="text-white">
                       R$ 0,00
                       </p>
                   </div>

               </div>
           </div>

       </div>

       {{--Meio--}}
       <div class="flex w-full m-0 p-0 flex-wrap justify-between" id="main_body">

           <div class="flex" style="flex-basis:49.5%;flex-direction:column;margin:0 0 0.5% 0;padding:0;height:100%;">

               <div class="flex w-full justify-between" style="margin:0;padding:0;">

                   <table class="table table-sm text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded tabela_mes mb-0" style="width:32.3%;">
                       <thead>
                       <tr class="w-100 text-center">
                           <th colspan="3" class="bg-warning text-white">
                               <select name="escolher_mes" id="escolher_mes" class="escolher_mes text-center bg-warning" style="border:none;background-color: #ffc107;padding:0;width:80%;">
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

                   <table class="table  text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] tabela_semestre mb-0 rounded" style="width:32.3%;">
                       <thead>
                       <tr class="w-100 text-center">

                           <th colspan="3" class="bg-warning text-white">
                               <select name="escolher_semestre" id="escolher_semestre" class="escolher_semestre text-center bg-warning" style="border:none;background-color: #ffc107;padding:0;width:80%;">
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
                                           $optionLabelSemestre = "$semestre_s ".'º'." Semestre $anoPassadoSemestre";
                                           echo "<option value=\"$optionValueSemestre\">$optionLabelSemestre</option>";
                                       }

                                       // Loop para adicionar os semestres deste ano até o semestre atual
                                       for ($semestre_a = 1; $semestre_a <= $semestreAtualSemestre; $semestre_a++) {
                                           $optionValue_a = "$semestre_a/$anoAtualSemestre";
                                           $optionLabel_a = "$semestre_a".'º'." Semestre $anoAtualSemestre";
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

                   <table class="table bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] tabela_escolher_ano mb-0 text-white rounded" style="width:32.3%;">
                       <thead>
                       <tr class="w-100 text-center">
                           <th colspan="3" class="bg-warning text-white">
                               <select name="escolher_ano" id="escolher_ano" class="escolher_ano text-center bg-warning text-white" style="border:none;background-color: #ffc107;padding:0;width:80%;">
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

                   <div id="chart_div" style="width:100%;height:100%;"></div>


                   <div id="select_div" class="absolute top-2 right-0 z-1000 hidden mr-2">
                       <select name="selecao_ano" id="selecao_ano" class="bg-white flex justify-between text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 appearance-none">
                           <option value="">--Ano--</option>
                           <option value="2023" {{$ano_atual == 2023 ? "selected" : ""}}>2023</option>
                           <option value="2024" {{$ano_atual == 2024 ? "selected" : ""}}>2024</option>
                       </select>
                   </div>


                   <div class="justify-around content_legenda">
                    <span class="flex items-center">
                        <span class="text-white text-lg">Individual</span>
                        <span class="ml-1" style="background:#1b9e77;width:10px;height:10px;"></span>
                    </span>
                    <span class="flex items-center mx-5">
                        <span class="text-white text-lg">Coletivo</span>
                        <span class="ml-1" style="background:#d95f02;width:10px;height:10px;"></span>
                    </span>
                    <span class="flex items-center">
                        <span class="text-white text-lg">Empresarial</span>
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

           <div class="flex" style="flex-basis:49.5%;flex-direction:column;height:100%;margin-bottom: 20px;">
               <div class="bg-yellow-400 flex items-center" style="border-radius:5px;height:5%;">
                   <h5 class="flex items-center text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] my-auto p-2 rounded w-full">
                       <span class="flex justify-end" style="flex-basis:60%;">Ranking Vendedor</span>
                       <span class="flex justify-end" style="flex-basis:40%;">
                        <i class="fas fa-medal"></i>
                        </span>

                   </h5>
               </div>

               <div class="flex my-1 ranking_classificacao" style="height:30%;">
                   @foreach(collect($ranking_mes)->take(3) as $r)
                       <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-full mb-0 mr-1 flex rounded-lg">
                           <!-- LADO ESQUERDO -->
                           <div class="flex flex-col justify-between h-full" style="flex-basis: 50%;">
                               <span class="ml-2 text-white" style="font-size:1.3em;">{{$loop->iteration}}º</span>
                               @php
                                   $parts = explode(' ', $r->usuario);
                                       $nome_abreviado = $parts[0] . ' ' . ($parts[1] ?? '');
                               @endphp
                               <div class="ml-2 text-white" style="font-size:1em;">{{ $nome_abreviado }}</div>
                               <span class="ml-2 text-white" style="font-size:1em;">{{$r->quantidade}} Vidas</span>
                           </div>
                           <!-- Fim LADO ESQUERDO -->

                           <!-- LADO DIREITO -->
                           <div class="flex flex-col justify-between h-full items-end pr-2" style="flex-basis: 50%;">
                               <!-- Imagem (alinhada à direita) -->
                               <div class="w-full flex justify-end self-end" style="max-width: 80px;">
                                   @if(file_exists($r->image))
                                       <img src="{{asset($r->image)}}" alt="{{$r->usuario}}" title="{{$r->usuario}}" style="border-radius:50%; max-height:100%; max-width:100%;margin-right:2%;">
                                   @endif
                               </div>
                               <!-- Valor (alinhado à direita) -->
                               <span class="text-white text-right mr-2">R$ {{number_format($r->valor,2,",",".")}}</span>
                           </div>
                           <!-- FIM LADO DIREITO -->
                       </div>
                   @endforeach
               </div>





               <div class="flex w-full justify-between" style="height:420px;">
                   <div class="content_table">
                       <table class="table table-sm text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] tabela_ranking_mes" style="width:100%;">
                           <thead>
                           <tr>
                               <th colspan="4">
                                   <select name="ranking_mes" id="ranking_mes" class="text-center" style="border:none;background-color: #ffc107;padding:0;width:80%;">
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
                       <table class="table table-sm text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] tabela_semestral" style="width:100%;">
                           <thead>

                           <tr>
                               <th colspan="4" class="bg-warning">
                                   <select name="ranking_semestral" id="ranking_semestral" class="text-center bg-warning" style="border:none;background-color: #ffc107;padding:0;width:80%;">
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
                                               $optionLabelSemestre = "$semestre_s" .'º'." Semestre $anoPassadoSemestre";
                                               echo "<option value=\"$optionValueSemestre\">$optionLabelSemestre</option>";
                                           }

                                           // Loop para adicionar os semestres deste ano até o semestre atual
                                           for ($semestre_a = 1; $semestre_a <= $semestreAtualSemestre; $semestre_a++) {
                                               $optionValue_a = "$semestre_a/$anoAtualSemestre";
                                               $optionLabel_a = "$semestre_a".'º'." Semestre $anoAtualSemestre";
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
                       <table class="table table-sm text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] tabela_ranking_ano" style="width:100%;">
                           <thead>

                           <tr>

                               <th colspan="4" class="bg-warning">
                                   <select name="ranking_ano" id="ranking_ano" class="ranking_ano text-center bg-warning" style="border:none;background-color: #ffc107;padding:0;width:80%;">
                                       <option value="">Anoss</option>
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




           <div class="w-full flex flex-wrap text-center justify-center mt-10 footer">
               <div class="w-full rounded justify-between flex mb-1 py-3 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px]">
                   <h4 class="flex" style="color:white;margin-left:5px;">Tabela Por Plano</h4>
                   <div class="justify-end flex mr-2">
                       <select name="ranking_mes_tabela" id="ranking_mes_tabela" class="bg-white flex justify-between text-dark border border-gray-300 px-4 py-2 appearance-none" style="border:none;padding:0;width:200px;">
                           <option value="" style="color:black;">Mês/Ano</option>
                           @foreach($mesesSelect as $mm)
                               <option value="{{$mm->month_date}}"
                                       style="color:black;"
                                   {{$mm->month_date == $data_atual ? 'selected' : ''}}
                               >{{$mm->month_name_and_year}}</option>
                           @endforeach
                       </select>
                   </div>
               </div>


               <div style="flex-basis:55%;" class="mr-1">
                   <div class="content_table_dados_tabela w-full text-white bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded">
                       <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                           <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                           <tr>
                               <th class="text-left py-3">Usuario</th>
                               <th class="py-3">Individual</th>
                               <th class="py-3">Coletivo</th>
                               <th class="py-3">Super Simples</th>
                               <th class="py-3">PME</th>
                               <th class="py-3">Sindipão</th>
                               <th class="py-3">Sindimaco</th>
                               <th class="py-3">Sincofarma</th>
                               <th class="py-3">Total</th>
                           </tr>
                           </thead>
                           <tbody>
                           @php
                               $total_table_individual = 0;
                               $total_table_coletivo = 0;
                               $total_table_super_simples = 0;
                               $total_table_pme = 0;
                               $total_table_sindipao = 0;
                               $total_table_sindimaco = 0;
                               $total_table_sincofarma = 0;
                               $total_table = 0;
                           @endphp
                           @foreach($dados_tabela as $dt)
                               <tr class="text-white">
                                   <td class="text-left py-1">{{$dt->user_name}}</td>
                                   <td class="text-center py-1">
                                       {{$dt->individual}}
                                       @php
                                           $total_table_individual += $dt->individual;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->coletivo}}
                                       @php
                                           $total_table_coletivo += $dt->coletivo;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->super_simples}}
                                       @php
                                           $total_table_super_simples += $dt->super_simples;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->pme}}
                                       @php
                                           $total_table_pme += $dt->pme;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->sindipao}}
                                       @php
                                           $total_table_sindipao += $dt->sindipao;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->sindimaco}}
                                       @php
                                           $total_table_sindimaco += $dt->sindimaco;
                                       @endphp
                                   </td>
                                   <td class="text-center py-1">
                                       {{$dt->sincofarma}}
                                       @php
                                           $total_table_sincofarma += $dt->sincofarma;
                                       @endphp
                                   </td>
                                   <th class="text-center py-1">
                                       {{$dt->total}}
                                       @php
                                           $total_table += $dt->total;
                                       @endphp
                                   </th>
                               </tr>
                           @endforeach
                           </tbody>
                           <tfoot>
                           <tr class="border-t font-bold text-white text-lg">
                               <th>Total</th>
                               <th class="text-center">{{$total_table_individual}}</th>
                               <th class="text-center">{{$total_table_coletivo}}</th>
                               <th class="text-center">{{$total_table_super_simples}}</th>
                               <th class="text-center">{{$total_table_pme}}</th>
                               <th class="text-center">{{$total_table_sindipao}}</th>
                               <th class="text-center">{{$total_table_sindimaco}}</th>
                               <th class="text-center">{{$total_table_sincofarma}}</th>
                               <th class="text-center">{{$total_table}}</th>
                           </tr>
                           </tfoot>
                       </table>
                   </div>
               </div>

               <div class="flex justify-center bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded" style="flex-basis:44%;">
                   <div id="piechart" style="width: 100%; height: 595px;background-color: transparent;"></div>
               </div>

           </div>

           <input type="hidden" id="janeiro_individual" value="{{$total_individual_quantidade_vidas_janeiro}}">
           <input type="hidden" id="fevereiro_individual" value="{{$total_individual_quantidade_vidas_fevereiro}}">
           <input type="hidden" id="marco_individual" value="{{$total_individual_quantidade_vidas_marco}}">
           <input type="hidden" id="abril_individual" value="{{$total_individual_quantidade_vidas_abril}}">
           <input type="hidden" id="maio_individual" value="{{$total_individual_quantidade_vidas_maio}}">
           <input type="hidden" id="junho_individual" value="{{$total_individual_quantidade_vidas_junho}}">
           <input type="hidden" id="julho_individual" value="{{$total_individual_quantidade_vidas_julho}}">
           <input type="hidden" id="agosto_individual" value="{{$total_individual_quantidade_vidas_agosto}}">
           <input type="hidden" id="setembro_individual" value="{{$total_individual_quantidade_vidas_setembro}}">
           <input type="hidden" id="outubro_individual" value="{{$total_individual_quantidade_vidas_outubro}}">
           <input type="hidden" id="novembro_individual" value="{{$total_individual_quantidade_vidas_novembro}}">
           <input type="hidden" id="dezembro_individual" value="{{$total_individual_quantidade_vidas_dezembro}}">

           <input type="hidden" id="janeiro_coletivo" value="{{$total_coletivo_quantidade_vidas_janeiro}}">
           <input type="hidden" id="fevereiro_coletivo" value="{{$total_coletivo_quantidade_vidas_fevereiro}}">
           <input type="hidden" id="marco_coletivo" value="{{$total_coletivo_quantidade_vidas_marco}}">
           <input type="hidden" id="abril_coletivo" value="{{$total_coletivo_quantidade_vidas_abril}}">
           <input type="hidden" id="maio_coletivo" value="{{$total_coletivo_quantidade_vidas_maio}}">
           <input type="hidden" id="junho_coletivo" value="{{$total_coletivo_quantidade_vidas_junho}}">
           <input type="hidden" id="julho_coletivo" value="{{$total_coletivo_quantidade_vidas_julho}}">
           <input type="hidden" id="agosto_coletivo" value="{{$total_coletivo_quantidade_vidas_agosto}}">
           <input type="hidden" id="setembro_coletivo" value="{{$total_coletivo_quantidade_vidas_setembro}}">
           <input type="hidden" id="outubro_coletivo" value="{{$total_coletivo_quantidade_vidas_outubro}}">
           <input type="hidden" id="novembro_coletivo" value="{{$total_coletivo_quantidade_vidas_novembro}}">
           <input type="hidden" id="dezembro_coletivo" value="{{$total_coletivo_quantidade_vidas_dezembro}}">

           <input type="hidden" id="janeiro_empresarial" value="{{$totalContratoEmpresarialJaneiro}}">
           <input type="hidden" id="fevereiro_empresarial" value="{{$totalContratoEmpresarialFevereiro}}">
           <input type="hidden" id="marco_empresarial" value="{{$totalContratoEmpresarialMarco}}">
           <input type="hidden" id="abril_empresarial" value="{{$totalContratoEmpresarialAbril}}">
           <input type="hidden" id="maio_empresarial" value="{{$totalContratoEmpresarialMaio}}">
           <input type="hidden" id="junho_empresarial" value="{{$totalContratoEmpresarialJunho}}">
           <input type="hidden" id="julho_empresarial" value="{{$totalContratoEmpresarialJulho}}">
           <input type="hidden" id="agosto_empresarial" value="{{$totalContratoEmpresarialAgosto}}">
           <input type="hidden" id="setembro_empresarial" value="{{$totalContratoEmpresarialSetembro}}">
           <input type="hidden" id="outubro_empresarial" value="{{$totalContratoEmpresarialOutubro}}">
           <input type="hidden" id="novembro_empresarial" value="{{$totalContratoEmpresarialNovembro}}">
           <input type="hidden" id="dezembro_empresarial" value="{{$totalContratoEmpresarialDezembro}}">


           <input type="hidden" id="total_individual_grafico" value="{{$total_individual_quantidade_vidas}}">
           <input type="hidden" id="total_coletivo_grafico" value="{{$total_coletivo_quantidade_vidas}}">
           <input type="hidden" id="total_super_simples_grafico" value="{{$total_super_simples_quantidade_vidas}}">
           <input type="hidden" id="total_pme_grafico" value="0">
           <input type="hidden" id="total_sindipao_grafico" value="{{$total_sindipao_quantidade_vidas}}">
           <input type="hidden" id="total_sincofarma_grafico" value="{{$total_sindimaco_quantidade_vidas}}">
           <input type="hidden" id="total_sindimaco_grafico" value="{{$total_sincofarma_quantidade_vidas}}">












       </div>



    </section>












       @section('scripts')
           <script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
           <script>
               $(document).ready(function(){


                   google.charts.load('current', {'packages':['bar']});
                   google.charts.setOnLoadCallback(drawChart);

                   function drawChart() {
                       var janeiro_individual = parseInt($("#janeiro_individual").val());
                       var fevereiro_individual = parseInt($("#fevereiro_individual").val());
                       var marco_individual = parseInt($("#marco_individual").val());
                       var abril_individual = parseInt($("#abril_individual").val());
                       var maio_individual = parseInt($("#maio_individual").val());
                       var junho_individual = parseInt($("#junho_individual").val());
                       var julho_individual = parseInt($("#julho_individual").val());
                       var agosto_individual = parseInt($("#agosto_individual").val());
                       var setembro_individual = parseInt($("#setembro_individual").val());
                       var outubro_individual = parseInt($("#outubro_individual").val());
                       var novembro_individual = parseInt($("#novembro_individual").val());
                       var dezembro_individual = parseInt($("#dezembro_individual").val());

                       var janeiro_coletivo = parseInt($("#janeiro_coletivo").val());
                       var fevereiro_coletivo = parseInt($("#fevereiro_coletivo").val());
                       var marco_coletivo = parseInt($("#marco_coletivo").val());
                       var abril_coletivo = parseInt($("#abril_coletivo").val());
                       var maio_coletivo = parseInt($("#maio_coletivo").val());
                       var junho_coletivo = parseInt($("#junho_coletivo").val());
                       var julho_coletivo = parseInt($("#julho_coletivo").val());
                       var agosto_coletivo = parseInt($("#agosto_coletivo").val());
                       var setembro_coletivo = parseInt($("#setembro_coletivo").val());
                       var outubro_coletivo = parseInt($("#outubro_coletivo").val());
                       var novembro_coletivo = parseInt($("#novembro_coletivo").val());
                       var dezembro_coletivo = parseInt($("#dezembro_coletivo").val());

                       var janeiro_empresarial = parseInt($("#janeiro_empresarial").val());
                       var fevereiro_empresarial = parseInt($("#fevereiro_empresarial").val());
                       var marco_empresarial = parseInt($("#marco_empresarial").val());
                       var abril_empresarial = parseInt($("#abril_empresarial").val());
                       var maio_empresarial = parseInt($("#maio_empresarial").val());
                       var junho_empresarial = parseInt($("#junho_empresarial").val());
                       var julho_empresarial = parseInt($("#julho_empresarial").val());
                       var agosto_empresarial = parseInt($("#agosto_empresarial").val());
                       var setembro_empresarial = parseInt($("#setembro_empresarial").val());
                       var outubro_empresarial = parseInt($("#outubro_empresarial").val());
                       var novembro_empresarial = parseInt($("#novembro_empresarial").val());
                       var dezembro_empresarial = parseInt($("#dezembro_empresarial").val());

                       let total_janeiro = janeiro_individual + janeiro_coletivo + janeiro_empresarial;
                       let total_fevereiro = fevereiro_individual + fevereiro_coletivo + fevereiro_empresarial;
                       let total_marco = marco_individual + marco_coletivo + marco_empresarial;
                       let total_abril = abril_individual + abril_coletivo + abril_empresarial;
                       let total_maio = maio_individual + maio_coletivo + maio_empresarial;
                       let total_junho = junho_individual + junho_coletivo + junho_empresarial;
                       let total_julho = julho_individual + julho_coletivo + julho_empresarial;
                       let total_agosto = agosto_individual + agosto_coletivo + agosto_empresarial;
                       let total_setembro = setembro_individual + setembro_coletivo + setembro_empresarial;
                       let total_outubro = outubro_individual + outubro_coletivo + outubro_empresarial;
                       let total_novembro = novembro_individual + novembro_coletivo + novembro_empresarial;
                       let total_dezembro = dezembro_individual + dezembro_coletivo + dezembro_empresarial;

                       $(".total_janeiro").each(function(){
                           if(total_janeiro >= 10) {
                               $(this).css({left:"50px"}).text(total_janeiro)
                           } else {
                               $(this).text(total_janeiro)
                           }
                       }).show();

                       $(".total_fevereiro").each(function(){
                           if(total_fevereiro >= 10) {
                               $(this).css({left:"110px"}).text(total_fevereiro)
                           } else {
                               $(this).text(total_fevereiro)
                           }
                       }).show();

                       $(".total_marco").each(function(){
                           if(total_marco >= 10) {
                               $(this).css({left:"168px"}).text(total_marco)
                           } else {
                               $(this).text(total_marco)
                           }
                       }).show();

                       $(".total_abril").each(function(){
                           if(total_abril >= 10) {
                               $(this).css({left:"230px"}).text(total_abril)
                           } else {
                               $(this).text(total_abril);
                           }
                       }).show();

                       $(".total_maio").each(function(){
                           if(total_maio >= 10) {
                               $(this).css({left:"290px"}).text(total_maio)
                           } else {
                               $(this).text(total_maio);
                           }
                       }).show();

                       $(".total_junho").each(function(){
                           if(total_junho >= 10) {
                               $(this).css({left:"350px"}).text(total_junho)
                           } else {
                               $(this).text(total_junho);
                           }
                       }).show();

                       $(".total_julho").each(function(){
                           if(total_julho >= 10) {
                               $(this).css({left:"410px"}).text(total_julho)
                           } else {
                               $(this).text(total_julho);
                           }
                       }).show();

                       $(".total_agosto").each(function(){
                           if(total_agosto >= 10) {
                               $(this).css({left:"468px"}).text(total_agosto)
                           } else {
                               $(this).text(total_agosto);
                           }
                       }).show();

                       $(".total_setembro").each(function(){
                           if(total_setembro >= 10) {
                               $(this).css({left:"528px"}).text(total_setembro)
                           } else {
                               $(this).text(total_setembro);
                           }
                       }).show();

                       $(".total_outubro").each(function(){
                           if(total_outubro >= 10) {
                               $(this).css({left:"588px"}).text(total_outubro)
                           } else {
                               $(this).text(total_outubro);
                           }
                       }).show();

                       $(".total_novembro").each(function(){
                           if(total_novembro >= 10) {
                               $(this).css({left:"645px"}).text(total_novembro)
                           } else {
                               $(this).text(total_novembro);
                           }
                       }).show();

                       $(".total_dezembro").each(function(){
                           if(total_dezembro  >= 10) {
                               $(this).css({left:"706px"}).text(total_dezembro)
                           } else {
                               $(this).text(total_dezembro);
                           }
                       }).show();


                       $("#select_div").show('slow');
                       $(".content_legenda").css({"display":"flex"});

                       var data = google.visualization.arrayToDataTable([
                           ['Mês', 'Individual', 'Coletivo', 'Empresarial'],
                           ['Jan', janeiro_individual, janeiro_coletivo, janeiro_empresarial],
                           ['Fev', fevereiro_individual, fevereiro_coletivo, fevereiro_empresarial],
                           ['Mar', marco_individual, marco_coletivo, marco_empresarial],
                           ['Abr', abril_individual, abril_coletivo, abril_empresarial],
                           ['Mai', maio_individual, maio_coletivo, maio_empresarial],
                           ['Jun', junho_individual, junho_coletivo, junho_empresarial],
                           ['Jul', julho_individual, julho_coletivo, julho_empresarial],
                           ['Ago', agosto_individual, agosto_coletivo, agosto_empresarial],
                           ['Set', setembro_individual, setembro_coletivo, setembro_empresarial],
                           ['Out', outubro_individual, outubro_coletivo, outubro_empresarial],
                           ['Nov', novembro_individual, novembro_coletivo, novembro_empresarial],
                           ['Dez', dezembro_individual, dezembro_coletivo, dezembro_empresarial]
                       ]);



                       var options = {
                           title: 'Ranking Vendas Anual',
                           bars: 'vertical',
                           legend: {
                               position:'none',
                               textStyle: {
                                   color: '#FFFFFF' // Cor da legenda em branco
                               }
                           },
                           height: '50vh',
                           colors: ['#1b9e77', '#d95f02', '#7570b3'],
                           backgroundColor: {
                               fill: 'transparent',  // Torna o fundo transparente
                               color:"#FFFFFF"
                           },  // Remove o fundo branco
                           chartArea: {
                               backgroundColor: {
                                   fill: 'transparent',  // Remove o fundo da área do gráfico
                                   color:"#FFFFFF"
                               },
                               width: '80%',
                               height: '70%'
                           },
                           titleTextStyle: {
                               color: '#FFFFFF'  // Cor do título em branco
                           },
                           hAxis: {
                               textStyle: {
                                   color: '#FFFFFF'  // Cor do texto do eixo horizontal em branco
                               }
                           },
                           vAxis: {
                               textStyle: {
                                   color: '#FFFFFF'  // Cor do texto do eixo vertical em branco
                               }
                           },
                       };

                       var chart = new google.charts.Bar(document.getElementById('chart_div'));
                       chart.draw(data, google.charts.Bar.convertOptions(options));

                   }


                   google.charts.load('current', {'packages':['corechart']});
                   google.charts.setOnLoadCallback(drawChartPizza);

                   function drawChartPizza() {

                       let individual = parseInt($("#total_individual_grafico").val()) || 0;
                       let coletivo = parseInt($("#total_coletivo_grafico").val()) || 0;
                       let super_simples = parseInt($("#total_super_simples_grafico").val()) || 0;
                       let pme = parseInt($("#total_pme_grafico").val()) || 0;  //Garantir que valores zerados sejam tratados
                       let sindipao = parseInt($("#total_sindipao_grafico").val()) || 0;
                       let sincofarma = parseInt($("#total_sincofarma_grafico").val()) || 0;
                       let sindimaco = parseInt($("#total_sindimaco_grafico").val()) || 0;

                       let todosZeros = individual === 0 && coletivo === 0 && super_simples === 0 && pme === 0 && sindipao === 0 && sincofarma === 0 && sindimaco === 0;

                       if (todosZeros) {

                           let data = google.visualization.arrayToDataTable([
                               ['Task', 'Hours per Day'],
                               ['Nada Consta',100],

                           ]);

                           let optionsPizza = {
                               title: '',
                               pieSliceText: 'label',
                               colors: ['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6'], // Cores diferentes para as fatias
                               legend: {
                                   position: 'bottom',
                                   maxLines: 3,
                                   textStyle: {
                                       fontSize: 14
                                   }
                               },
                               backgroundColor: {
                                   fill: 'transparent',  // Torna o fundo transparente
                                   color:"#FFFFFF"
                               },  // Remove o fundo branco
                               chartArea: {
                                   backgroundColor: {
                                       fill: 'transparent',  // Remove o fundo da área do gráfico
                                       color:"#FFFFFF"
                                   },
                                   width: '80%',
                                   height: '70%'
                               },
                               titleTextStyle: {
                                   color: '#FFFFFF'  // Cor do título em branco
                               },
                               hAxis: {
                                   textStyle: {
                                       color: '#FFFFFF'  // Cor do texto do eixo horizontal em branco
                                   }
                               },
                               vAxis: {
                                   textStyle: {
                                       color: '#FFFFFF'  // Cor do texto do eixo vertical em branco
                                   }
                               }
                           };

                           let chartPizza = new google.visualization.PieChart(document.getElementById('piechart'));
                           chartPizza.draw(data, optionsPizza);

                       } else {

                           let data = google.visualization.arrayToDataTable([
                               ['Task', 'Hours per Day'],
                               ['Individual',individual],
                               ['Coletivo',coletivo],
                               ['Super Simples',super_simples],
                               ['PME',pme],
                               ['Sindipão',sindipao],
                               ['Sincofarma',sincofarma],
                               ['Sindimaco',sindimaco],
                           ]);

                           let optionsPizza = {
                               title: '',
                               pieSliceText: 'label',
                               colors: ['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6'], // Cores diferentes para as fatias
                               forceIFrame: true,  // Força o uso de iframe para layout de legenda
                               legend: {
                                   position: 'bottom',
                                   alignment: 'center',
                                   textStyle: {
                                       fontSize: 13,
                                       color: '#FFFFFF'
                                   },

                                   maxLines: 3,  // Permite mais linhas de legenda
                               },
                               backgroundColor: {
                                   fill: 'transparent',  // Torna o fundo transparente
                                   color:"#FFFFFF"
                               },  // Remove o fundo branco
                               chartArea: {
                                   backgroundColor: {
                                       fill: 'transparent',  // Remove o fundo da área do gráfico
                                       color:"#FFFFFF"
                                   },
                                   width: '100%',
                                   height: '80%',
                                   top: '5%'
                               },
                               titleTextStyle: {
                                   color: '#FFFFFF'  // Cor do título em branco
                               },
                               hAxis: {
                                   textStyle: {
                                       color: '#FFFFFF'  // Cor do texto do eixo horizontal em branco
                                   }
                               },
                               vAxis: {
                                   textStyle: {
                                       color: '#FFFFFF'  // Cor do texto do eixo vertical em branco
                                   }
                               },
                               pieSliceBorderColor: "#000",  // Cor de borda das fatias, caso você queira destacar visualmente
                               sliceVisibilityThreshold: 0  // Mostra fatias com valor zero
                           };

                           let chartPizza = new google.visualization.PieChart(document.getElementById('piechart'));
                           chartPizza.draw(data, optionsPizza);

                       }









                   }










               });




           </script>
       @endsection




</x-app-layout>
