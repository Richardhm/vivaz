<x-app-layout>
    <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded-lg p-4 mt-2 ml-2 w-[98%] container_formulario">
{{--        <form action="" method="post" class="px-3 flex flex-wrap gap-4" name="cadastrar_pessoa_fisica_formulario_individual" id="cadastrar_pessoa_fisica_formulario_individual w-full">--}}
{{--            @csrf--}}

            <input type="hidden" name="tipo_cadastro" value="administrador_cadastro">

            <!-- Primeira Linha -->
            <div class="flex flex-wrap gap-4 w-full">
                <div class="w-[11.5%]">
                    <label for="users_individual" class="text-white text-sm">Vendedor:</label>
                    <select name="users_individual" id="users_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full">
                        <option value="">----Corretor----</option>
                        @foreach($users as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-[11.5%]">
                    <label for="tabela_origem_individual" class="text-white text-sm">Tabela Origem:</label>
                    <select name="tabela_origem_individual" id="tabela_origem_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full">
                        <option value="">--Tabela Origem--</option>
                        @foreach($origem_tabela as $o)
                            <option value="{{$o->id}}">{{$o->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-[11.5%]">
                    <label for="nome_individual" class="text-white text-sm">Titular:</label>
                    <input type="text" name="nome_individual" id="nome_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" placeholder="Nome" value="">
                </div>

                <div class="w-[11.5%]">
                    <label for="cpf_individual" class="text-white text-sm">CPF:</label>
                    <input type="text" name="cpf_individual" id="cpf_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('cpf')}}" placeholder="XXX.XXXX.XXX-XX">
                    <div class="errorcpf"></div>
                </div>

                <div class="w-[11.5%]">
                    <label for="data_nascimento_individual" class="text-white text-sm">Data Nascimento:</label>
                    <input type="date" name="data_nascimento_individual" value="{{old('data_nascimento')}}" id="data_nascimento_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full">
                </div>

                <div class="w-[11.5%]">
                    <label for="email_individual" class="text-white text-sm">Email:</label>
                    <input type="email" name="email_individual" id="email_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" placeholder="Email" value="">
                </div>

                <div class="w-[11.5%]">
                    <label for="celular_individual" class="text-white text-sm">Celular:</label>
                    <input type="text" name="celular_individual" id="celular_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('celular_individual')}}" placeholder="Celular">
                </div>

                <div class="w-[11.5%]">
                    <label for="telefone_individual" class="text-white text-sm">Telefone:</label>
                    <input type="text" name="telefone_individual" id="telefone_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('telefone_individual')}}" placeholder="Telefone">
                </div>
            </div>
            <!-- Fim Primeira Linha -->

            <!-- Segunda Linha -->
            <div class="flex flex-wrap gap-4 w-full">
                <div class="w-[6.5%]">
                    <label for="cep_individual" class="text-white text-sm">CEP:</label>
                    <input type="text" name="cep_individual" id="cep_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('cep')}}" placeholder="CEP">
                </div>

                <div class="w-[11.5%]">
                    <label for="cidade_origem_individual" class="text-white text-sm">Cidade:</label>
                    <input type="text" name="cidade_origem_individual" id="cidade_origem_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('cidade_origem')}}" placeholder="Cidade">
                </div>

                <div class="w-[11.5%]">
                    <label for="bairro_individual" class="text-white text-sm">Bairro:</label>
                    <input type="text" name="bairro_individual" id="bairro_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('bairro')}}" placeholder="Bairro">
                </div>

                <div class="w-[11.5%]">
                    <label for="rua_individual" class="text-white text-sm">Rua:</label>
                    <input type="text" name="rua_individual" id="rua_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('rua')}}" placeholder="Logradouro (Rua)">
                </div>

                <div class="w-[11.5%]">
                    <label for="complemento_individual" class="text-white text-sm">Complemento:</label>
                    <input type="text" name="complemento_individual" id="complemento_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('complemento')}}" placeholder="Complemento (Opcional)">
                </div>

                <div class="w-[4.5%]">
                    <label for="uf_individual" class="text-white text-sm">UF:</label>
                    <input type="text" name="uf_individual" id="uf_individual" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('uf')}}" placeholder="UF">
                </div>

                <div class="w-[11.5%]">
                    <label for="codigo_externo_individual_cadastrar" class="text-white text-sm">Cod. Externo:</label>
                    <input type="text" name="codigo_externo_individual" id="codigo_externo_individual_cadastrar" class="form-control form-control-sm p-2 rounded bg-white text-black w-full" value="{{old('codigo_externo')}}" placeholder="COD.">

                </div>

                <div class="w-[7.5%]">

                        <div class="flex flex-wrap">
                            <span class="text-white">Coparticipação:</span>

                            <label id="coparticipacao_sim">
                                <input type="radio" name="coparticipacao_individual" id="coparticipacao_radio_sim_cadastro" value="sim">
                                <span class="text-white">Sim</span>
                            </label>
                            <label id="coparticipacao_nao">
                                <input type="radio" name="coparticipacao_individual" id="coparticipacao_radio_nao_cadastro" value="nao">
                                <span class="text-white">Não</span>
                            </label>


                        </div>

                </div>

                <div class="w-[7.5%]">
                        <div class="flex flex-col">
                            <span for="odonto" class="text-white">Odonto:</span>

                            <div class="btn-group btn-group-toggle">
                                <label class="btn btn-outline-light" id="odonto_sim">
                                    <input type="radio" name="odonto_individual" id="odonto_radio_sim_cadastro" value="sim">
                                    <span class="text-white">Sim</span>
                                </label>
                                <label class="btn btn-outline-light" id="odonto_nao">
                                    <input type="radio" name="odonto_individual" id="odonto_radio_nao_cadastro" value="nao">
                                    <span class="text-white">Não</span>
                                </label>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Fim Segunda Linha -->

            <section>
                <div class="errorfaixas"></div>
                <div class="flex">

                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">0-18:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="d-flex align-items-center justify-content-center minus bg-danger" id="faixa-0-18" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" data-change="change_faixa_0_18" name="faixas_etarias[1]" value="{{isset($colunas) && in_array(1,$colunas) ? $faixas[array_search(1, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-0-18_individual" class="text-center font-weight-bold flex-fill faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" class="text-center" />
                                <button type="button" class="d-flex justify-content-center align-items-center plus" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">19-23:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="d-flex align-items-center justify-content-center minus bg-danger" id="faixa-19-23" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em">－</span>
                                </button>
                                <input type="tel" data-change="change_faixa_19_23" name="faixas_etarias[2]" value="{{isset($colunas) && in_array(2,$colunas) ? $faixas[array_search(2, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-19-23_individual" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" class="text-center" />
                                <button type="button" class="d-flex align-items-center justify-content-center plus" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">24-28:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="d-flex justify-content-center align-items-center minus bg-danger" id="faixa-24-28" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em">－</span>
                                </button>
                                <input type="tel" data-change="change_faixa_24_28" name="faixas_etarias[3]" value="{{isset($colunas) && in_array(3,$colunas) ? $faixas[array_search(3, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-24-28_individual" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" class="text-center" />
                                <button type="button" class="plus d-flex justify-content-center align-items-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;margin:0 10px;">
                        <span for="" class="text-white">29-33:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus d-flex justify-content-center align-items-center bg-danger" id="faixa-29-33" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" data-change="change_faixa_29_33" name="faixas_etarias[4]" value="{{isset($colunas) && in_array(4,$colunas) ? $faixas[array_search(4, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-29-33_individual" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" class="text-center" />
                                <button type="button" class="plus  d-flex justify-content-center align-items-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">34-38:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus d-flex justify-content-center align-items-center bg-danger" id="faixa-34-38" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" name="faixas_etarias[5]" data-change="change_faixa_34_38" value="{{isset($colunas) && in_array(5,$colunas) ? $faixas[array_search(5, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-34-38_individual" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" />
                                <button type="button" class="plus d-flex align-items-center justify-content-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;margin:0 10px;">
                        <span for="" class="text-white">39-43:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus d-flex justify-content-center align-items-center bg-danger" id="faixa-39-43" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" name="faixas_etarias[6]" data-change="change_faixa_39_43" value="{{isset($colunas) && in_array(6,$colunas) ? $faixas[array_search(6, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-39-43_individual" class="text-center font-weight-bold flex-fill w-25 faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" class="text-center" />
                                <button type="button" class="plus d-flex justify-content-center align-items-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">44-48:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus d-flex justify-content-center align-items-center bg-danger" id="faixa-44-48" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" name="faixas_etarias[7]" data-change="change_faixa_44_48" value="{{isset($colunas) && in_array(7,$colunas) ? $faixas[array_search(7, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-44-48_individual" class="text-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" />
                                <button type="button" class="plus d-flex justify-content-center align-items-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;margin:0 10px;">
                        <span for="" class="text-white">49-53:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus align-items-center d-flex justify-content-center bg-danger" id="faixa-49-53" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" name="faixas_etarias[8]" data-change="change_faixa_49_53" value="{{isset($colunas) && in_array(8,$colunas) ? $faixas[array_search(8, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-49-53_individual" class="text-center align-items-center font-weight-bold faixas_etarias" style="border:none;width:40%;font-size:1.2em;max-height: 30px;" value="" step="1" min="0" />
                                <button type="button" class="plus align-items-center d-flex justify-content-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;margin:0 10px 0 0;">
                        <span for="" class="text-white">54-58:</span>
                        <div class="border border-white rounded">
                            <div class="flex content">
                                <button type="button" class="minus d-flex align-items-center justify-content-center bg-danger" id="faixa-54-58" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>
                                <input type="tel" name="faixas_etarias[9]" data-change="change_faixa_54_58" value="{{isset($colunas) && in_array(9,$colunas) ? $faixas[array_search(9, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-54-58_individual"  class="text-center font-weight-bold faixas_etarias d-flex" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" />
                                <button type="button" class="plus d-flex align-items-center justify-content-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="flex-basis:10%;">
                        <span for="" class="text-white">59+</span>
                        <div class="border border-white rounded">
                            <div class="flex content">

                                <button type="button" class="minus d-flex justify-content-center align-items-center bg-danger" id="faixa-59" style="border:none;background:#FF0000;width:30%;max-height:30px;" aria-label="−" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">－</span>
                                </button>

                                <input type="tel" data-change="change_faixa_59" name="faixas_etarias[10]" value="{{isset($colunas) && in_array(10,$colunas) ? $faixas[array_search(10, array_column($faixas, 'faixa_etaria_id'))]['faixa_quantidade'] : ''}}" id="faixa-input-59_individual" class="text-center font-weight-bold faixas_etarias d-flex" style="border:none;width:40%;font-size:1.2em;max-height:30px;" value="" step="1" min="0" />

                                <button type="button" class="plus d-flex justify-content-center align-items-center" style="border:none;background:rgb(17,117,185);width:30%;max-height:30px;" aria-label="+" tabindex="0">
                                    <span class="text-white font-weight-bold" style="font-size:1.5em;">＋</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Fim Faixa Etaria-->
            </section>





            <div class="form-group mt-4 text-right w-full">
                <button id="mostrar_plano_individual" class="btn bg-blue-400 w-full p-4 rounded text-white">Montar Planos</button>
            </div>
{{--        </form>--}}
    </div>


    <div id="resultado_individual" class="flex flex-wrap"></div>

    <div id="btn_submit" class="bg-blue-600 text-white text-center rounded" style="clear:both;width:98%;"></div>




    <script>
        $(document).ready(function(){
            let plus = $(".plus");
            let minus = $(".minus");
            $(plus).on('click',function(e){
                let alvo = e.target;
                let pai = alvo.closest('.content');
                let input = $(pai).find('input');
                if(input.val() == "") {
                    input.val(0);
                }
                let newValue = parseInt(input.val()) + 1;
                if(newValue >= 0) {
                    input.val(newValue);
                }
            });

            $(minus).on('click',function(e){
                let alvo = e.target;
                let pai = alvo.closest('.content');
                let input = $(pai).find('input');
                let newValue = parseInt(input.val()) - 1;
                if(newValue >= 0) {
                    input.val(newValue);
                }
            });

            $("body").on("click","#mostrar_plano_individual",function(e){
                e.preventDefault();
                if($("#users_individual").val() == "") {
                    alert("Corretor é campo obrigatório")
                    return false;
                }

                if($("#tabela_origem_individual").val() == "") {
                    alert("Tabela Origem é campo obrigatório")
                    return false;
                }

                if($("#nome_individual").val() == "") {
                    alert("Titular é campo obrigatório")
                    return false;
                }

                if($("#cpf_individual").val() == "") {
                    alert("CPF é obrigatório")
                    return false;
                }

                if($("#data_nascimento_individual").val() == "") {
                    alert("Data Nascimento campo obrigatório")
                    return false;
                }

                if($("#email_individual").val() == "") {
                    alert("Email campo obrigatório")
                    return false;
                }

                if($("#celular_individual").val() == "") {
                    alert("Celular é campo obrigatório")
                    return false;
                }

                if($("#tabela_origem_individual").val() == "") {
                    alert("Tabela Origem campo obrigatório")
                    return false;
                }

                if($("#cep_individual").val() == "") {
                    alert("Cep é campo obrigatório")
                    return false;
                }

                if($("#bairro_individual").val() == "") {
                    alert("Bairro é campo obrigatório")
                    return false;
                }

                if($("#rua_individual").val() == "") {
                    alert("Rua é campo obrigatório")
                    return false;
                }

                if($("#cidade_origem_individual").val() == "") {
                    alert("Cidade é campo obrigatório")
                    return false;
                }

                if($("#uf_individual").val() == "") {
                    alert("UF é campo obrigatório")
                    return false;
                }

                if($("#codigo_externo_individual_cadastrar").val() == "") {
                    alert("Codigo Externo é campo obrigatório")
                    return false;
                }

                if(!$('input:radio[name=coparticipacao_individual]').is(':checked')) {
                    alert("Coparticipação é campo obrigatório")
                    return false;
                }

                if(!$('input:radio[name=odonto_individual]').is(':checked')) {
                    alert("Odonto é campo obrigatório")
                    return false;
                }

                if(
                    $("#faixa-input-0-18_individual").val() == "" &&
                    $("#faixa-input-19-23_individual").val() == "" &&
                    $("#faixa-input-24-28_individual").val() == "" &&
                    $("#faixa-input-29-33_individual").val() == "" &&
                    $("#faixa-input-34-38_individual").val() == "" &&
                    $("#faixa-input-39-43_individual").val() == "" &&
                    $("#faixa-input-44-48_individual").val() == "" &&
                    $("#faixa-input-49-53_individual").val() == "" &&
                    $("#faixa-input-54-58_individual").val() == "" &&
                    $("#faixa-input-59_individual").val() == ""
                ) {
                    alert("Preencher pelo menos 1 faixa etaria")

                    return false;
                }



                $.ajax({
                    url:"{{route('contratos.montarPlanosIndividual')}}",
                    method:"POST",
                    data:{
                        "tabela_origem": $("#tabela_origem_individual").val(),
                        "administradora_id":4,
                        "odonto":$('input:radio[name=odonto_individual]:checked').val(),
                        "coparticipacao":$("input:radio[name=coparticipacao_individual]:checked").val(),
                        "faixas" : [{
                            '1' : $('#faixa-input-0-18_individual').val(),
                            '2' : $('#faixa-input-19-23_individual').val(),
                            '3' : $('#faixa-input-24-28_individual').val(),
                            '4' : $('#faixa-input-29-33_individual').val(),
                            '5' : $('#faixa-input-34-38_individual').val(),
                            '6' : $('#faixa-input-39-43_individual').val(),
                            '7' : $('#faixa-input-44-48_individual').val(),
                            '8' : $('#faixa-input-49-53_individual').val(),
                            '9' : $('#faixa-input-54-58_individual').val(),
                            '10' : $('#faixa-input-59_individual').val()
                        }]
                    },
                    success:function(res) {

                        $("#resultado_individual").slideUp().html(res).delay(100).slideToggle(100,function(){
                            $('body,html').animate({
                                scrollTop:$(window).scrollTop() + $(window).height(),
                            },1500);
                        });
                        return false;
                        //
                        // $("body").find('.vigente').datepicker({
                        //     onSelect: function() {
                        //         var dateObject = $(this).datepicker('getDate');
                        //         let dataFormatada = (dateObject.getFullYear() + "-" + adicionaZero(((dateObject.getMonth() + 1))) + "-" + adicionaZero((dateObject.getDate()))) ;
                        //         $("form[name='cadastrar_pessoa_fisica_formulario_individual']").find("#data_vigencia").attr("value",dataFormatada);
                        //     }
                        // });
                    }
                });


                return false;
            });

            $('body').on('click','.valores-acomodacao',function(e){
                let valor_plano = $(this).find('.valor_plano').text().replace("R$ ","");
                let tipo = $(this).find('.tipo').text();
                console.log(tipo);
                $("#valor").val(valor_plano);
                $("#acomodacao").val(tipo);
                if(!$(this).hasClass('destaque')) {
                    $('#data_vigencia').val('')
                    $('#data_boleto').val('');
                    $('#valor_adesao').val('');
                }
                $(".valores-acomodacao").removeClass('destaque');
                $(this).addClass('destaque');
                $('body,html').animate({
                    scrollTop:$(window).scrollTop() + $(window).height(),
                },1500);
                $("#btn_submit").html("<button type='button' class='btn btn-block btn-light my-4 salvar_contrato'>Salvar Contrato</button>")
                $('.valores-acomodacao').not('.destaque').each(function(i,e){
                    $(e).find('.vigente').val('')
                    $(e).find('.boleto').val('')
                    $(e).find('.valor_adesao').val('')
                });
                if($(e.target).is('.form-control')) {
                    return;
                }
            });

            $("body").on('change','input[name="vigente"]',function(){
                let data_vigencia = $(this).val();
                $(this).closest('body').find('#data_vigencia').val(data_vigencia);
                //$("#data_boleto").val(data_boleto);
            });

            $("body").on('change','input[name="boleto"]',function(){
                let data_boleto = $(this).val();
                $(this).closest('body').find('#data_boleto').val(data_boleto);
                //$("#data_boleto").val(data_boleto);
            });

            $("body").on('change','input[name="adesao"]',function(){
                let valor_adesao = $(this).val();
                $(this).closest('body').find('#valor_adesao').val(valor_adesao);

            });








            $("body").on('click','.salvar_contrato',function(){
                let data_vigencia = $("body").find("#data_vigencia").val();
                let data_boleto = $("body").find("#data_boleto").val();
                let valor_adesao = $("body").find("#valor_adesao").val();
                let valor_plano = $("body").find("#valor").val();



                let data = {
                    'users_individual' : $("#users_individual").val(),
                    'tabela_origem_individual' : $("#tabela_origem_individual").val(),
                    'nome_individual': $("#nome_individual").val(),
                    'cpf_individual' : $("#cpf_individual").val(),
                    'data_nascimento_individual':  $("#data_nascimento_individual").val(),
                    'email_individual' : $("#email_individual").val(),
                    'celular_individual' : $("#celular_individual").val(),
                    'tabela_origem_individual' : $("#tabela_origem_individual").val(),
                    'cep_individual' : $("#cep_individual").val(),
                    'bairro_individual' : $("#bairro_individual").val(),
                    'rua_individual' : $("#rua_individual").val(),
                    'cidade_origem_individual' : $("#cidade_origem_individual").val(),
                    'uf_individual' : $("#uf_individual").val(),
                    'codigo_externo_individual' : $("#codigo_externo_individual_cadastrar").val(),
                    'coparticipacao' : $('input:radio[name=coparticipacao_individual]').is(':checked'),
                    'odonto_individual' : $('input:radio[name=odonto_individual]').is(':checked'),
                    'faixas_etarias' : [
                        $("#faixa-input-0-18_individual").val(),
                        $("#faixa-input-19-23_individual").val(),
                        $("#faixa-input-24-28_individual").val(),
                        $("#faixa-input-29-33_individual").val(),
                        $("#faixa-input-34-38_individual").val(),
                        $("#faixa-input-39-43_individual").val(),
                        $("#faixa-input-44-48_individual").val(),
                        $("#faixa-input-49-53_individual").val(),
                        $("#faixa-input-54-58_individual").val(),
                        $("#faixa-input-59_individual").val()
                    ],
                    'data_vigencia':data_vigencia,
                    'data_boleto' : data_boleto,
                    'valor_adesao' : valor_adesao,
                    'valor' : valor_plano

                }





                $.ajax({
                    url:"{{route('individual.store')}}",
                    method:"POST",
                    data:data,

                    beforeSend:function() {


                        if(data_vigencia == "") {
                            alert("Preencher o campo data vigencia")
                            return false;
                        }

                        if(data_boleto == "") {
                            alert("Preencher o campo data boleto")
                            return false;
                        }

                        if(valor_adesao == "") {
                            alert("Preencher o campo valor adesão")
                            return false;
                        }
                    },

                    success:function(res) {
                        console.log(res);
                        // if(res == "sem_resultado") {
                        //     toastr["error"]("CPF ou codigo externo invalidos")
                        //     toastr.options = {
                        //         "closeButton": false,
                        //         "debug": false,
                        //         "newestOnTop": false,
                        //         "progressBar": false,
                        //         "positionClass": "toast-top-right",
                        //         "preventDuplicates": false,
                        //         "onclick": null,
                        //         "showDuration": "300",
                        //         "hideDuration": "1000",
                        //         "timeOut": "5000",
                        //         "extendedTimeOut": "1000",
                        //         "showEasing": "swing",
                        //         "hideEasing": "linear",
                        //         "showMethod": "fadeIn",
                        //         "hideMethod": "fadeOut"
                        //     }
                        //
                        // } else {
                        //     $(location).prop('href','/admin/financeiro')
                        // }

                        // if(res == "contratos") {
                        //     $(location).prop('href','/admin/contratos');
                        //     return true;
                        // } else {
                        //     $(location).prop('href','/admin/contrato');
                        //     return true;
                        // }
                    }
                })
                return false;
            })











        })

    </script>





</x-app-layout>
