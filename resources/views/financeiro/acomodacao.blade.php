@if(count($dados) >= 1)
    @php
        $ii=0;
        $total = 0;
        $contagem = 1;
    @endphp
    <div class="flex justify-between flex-wrap">
        <h4 class="w-full my-2 text-white">Nossos Planos: </h4>
        @for($i=0;$i < count($dados); $i++)
            @php
                $contagem = $i + 1;
            @endphp
            @if($dados[$i]->card == $card_inicial)
                @if($ii==0)
                    <input type="hidden" name="administradora" id="administradora" value="{{$dados[$i]->administradora}}">
                    <div class="flex flex-col rounded-lg valores-acomodacao shadow-lg mb-4 p-6 bg-opacity-50 backdrop-filter backdrop-blur-sm" style="width:30%;background-color:rgba(0, 0, 0, 0.6);">

                        <div class="flex items-center mb-4">
                            <div class="w-1/2 bg-white border-2 border-black rounded-md p-2">
                                <img src="{{asset($dados[$i]->logo)}}" alt="" class="w-full h-full object-contain">
                            </div>
                            <div class="w-1/2 flex flex-col justify-center items-end text-white">
                                <p class="text-lg font-semibold">{{$dados[$i]->planos}}</p>
                                <p class="text-md tipo">{{$dados[$i]->acomodacao}}</p>
                            </div>
                        </div>

                        <div class="flex border-t border-b border-gray-400 text-white">
                            <div class="w-1/2 border-r border-gray-400 py-2 text-center">
                                <p>{{$dados[$i]->coparticipacao}}</p>
                            </div>
                            <div class="w-1/2 py-2 text-center">
                                <p>{{$dados[$i]->odonto}}</p>
                            </div>
                        </div>

                        <div class="flex mt-4 space-x-2">
                            <div class="w-1/3">
                                <p class="text-sm text-white">Data Vigência:</p>
                                <input type="date" name="vigente" id="vigente_{{strtolower($dados[$i]->acomodacao)}}" class="form-control form-control-sm w-full text-black" placeholder="Data Vigência">
                            </div>
                            <div class="w-1/3">
                                <p class="text-sm text-white">Data Boleto:</p>
                                <input type="date" name="boleto" id="boleto_{{strtolower($dados[$i]->acomodacao)}}" class="form-control form-control-sm w-full text-black">
                            </div>
                            <div class="w-1/3">
                                <p class="text-sm text-white">Valor Adesão:</p>
                                <input type="text" name="adesao" id="adesao_{{strtolower($dados[$i]->acomodacao)}}" class="form-control form-control-sm w-full text-black" placeholder="R$">
                            </div>
                        </div>

                        <div class="mt-4">
                            <table class="w-full text-white text-sm">
                                <thead>
                                <tr>
                                    <th class="text-left">Faixas</th>
                                    <th class="text-left">Vidas</th>
                                    <th class="text-left">Valor</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @endif
                                @php
                                    $ii++;
                                    $total += $dados[$i]->valor * $dados[$i]->quantidade;
                                @endphp
                                <tr>
                                    <td>{{$dados[$i]->faixa}}</td>
                                    <td>{{$dados[$i]->quantidade}}</td>
                                    <td>{{number_format($dados[$i]->valor,2,",",".")}}</td>
                                    <td class="text-right">{{number_format($dados[$i]->valor * $dados[$i]->quantidade,2,",",".")}}</td>
                                </tr>
                                @else
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right font-semibold border-t border-gray-400 valor_plano">R$ {{number_format($total,2,",",".")}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @php
                        $card_inicial = $dados[$i]->card;
                        $i--;
                        $ii=0;
                        $total=0;
                    @endphp
                @endif
                @endfor
    </div>

    @if($contagem == $quantidade)
        <tfoot>
        <tr>
            <td colspan="4" class="text-right font-semibold border-t border-gray-400">R$ {{number_format($total,2,",",".")}}</td>
        </tr>
        </tfoot>
    @endif

    <input type="text" name="valor" id="valor" value="">
    <input type="text" name="data_vigencia" id="data_vigencia" value="">
    <input type="text" name="data_boleto" id="data_boleto" value="">
    <input type="text" name="valor_adesao" id="valor_adesao" value="">
    <input type="text" name="acomodacao" id="acomodacao" value="">




@else
    <p class="alert alert-danger">Sem Resultado para essa pesquisa =/</p>
@endif
