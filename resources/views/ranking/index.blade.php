<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <style>
        .stage {width: 95%;flex-grow: 1;background-image: url('{{ asset('podium2.png') }}');background-size: cover;background-repeat: no-repeat;background-position: center;display: flex;justify-content: space-around;align-items: flex-end;margin: 0 auto;}
    </style>
    <script src="{{asset('assets/jquery.min.js')}}"></script>
</head>
<body>


<!-- Modal -->
<div id="planilhaModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>


        <div id="concessionariaForm" style="display: none; margin-top: 20px;">

                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" style="width: 100%;" class="form-control-sm" required placeholder="Digitar o nome da Concessionaria">
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <div style="width: 12%;">
                        <label for="meta_individual">Meta Individual:</label>
                        <input type="number" id="meta_individual" name="meta_individual" class="form-control-sm" required placeholder="Meta Individual">
                    </div>
                    <div style="width: 12%;">
                        <label for="individual">Individual:</label>
                        <input type="number" id="individual" name="individual" required class="form-control-sm" placeholder="Valor Individual">
                    </div>

                    <div style="width: 12%;">
                        <label for="meta_super_simples">Meta Super Simples:</label>
                        <input type="number" id="meta_super_simples" name="meta_super_simples" required class="form-control-sm" placeholder="Meta Super Simples">
                    </div>
                    <div style="width: 12%;">
                        <label for="super_simples">Super Simples:</label>
                        <input type="number" id="super_simples" name="super_simples" required class="form-control-sm" placeholder="Super Simples">
                    </div>

                    <div style="width: 12%;">
                        <label for="meta_pme">Meta PME:</label>
                        <input type="number" id="meta_pme" name="meta_pme" required class="form-control-sm" placeholder="Meta PME">
                    </div>
                    <div style="width: 12%;">
                        <label for="pme">PME:</label>
                        <input type="number" id="pme" name="pme" required class="form-control-sm" placeholder="PME">
                    </div>

                    <div style="width: 12%;">
                        <label for="meta_adesao">Meta Adesão:</label>
                        <input type="number" id="meta_adesao" name="meta_adesao" required class="form-control-sm" placeholder="Meta Adesão">
                    </div>
                    <div style="width: 12%;">
                        <label for="adesao">Adesão:</label>
                        <input type="number" id="adesao" name="adesao" required class="form-control-sm" placeholder="Adesão">
                    </div>
                </div>
                <button type="submit" class="btn-cadastro btn-primary btn mt-2" style="width: 100%;">Cadastrar</button>

        </div>

        <div class="modal-body">

            <table style="width:80%;margin:0 auto;">
                <thead>
                <tr>
                    <th rowspan="2" class="bg-gray-100 bg-opacity-10 text-white">Concessionaria</th>
                    <th colspan="2" class="bg-individual">Individual</th>
                    <th colspan="2" class="bg-super-simples">Super Simples</th>
                    <th colspan="2" class="bg-pme">PME</th>
                    <th colspan="2" class="bg-adesao">Adesão</th>
                    <th colspan="3" class="bg-total-geral" style="margin-left: 10px;">Total Geral</th>
                </tr>
                <tr>
                    <th class="bg-individual">META</th>
                    <th class="bg-individual">VIDAS</th>
                    <th class="bg-super-simples">META</th>
                    <th class="bg-super-simples">VIDAS</th>
                    <th class="bg-pme">META</th>
                    <th class="bg-pme">VIDAS</th>
                    <th class="bg-adesao">META</th>
                    <th class="bg-adesao">VIDAS</th>
                    <th class="bg-total-geral">META</th>
                    <th class="bg-total-geral">VIDAS</th>
                    <th class="bg-total-geral">%</th>
                </tr>
                </thead>
                <tbody>

                    @php
                        $meta_individual_total = 0;
                        $meta_individual_vidas_total = 0;
                        $meta_individual_total_porcentagem = 0;
                    @endphp

                    @foreach($concessionarias as $c)
                        @php
                            $meta_individual_total = $c->meta_individual + $c->meta_super_simples + $c->meta_pme + $c->meta_adesao;
                            $meta_individual_vidas_total = $c->individual + $c->super_simples + $c->pme + $c->adesao;
                            $meta_individual_total_porcentagem = ($meta_individual_vidas_total != 0 && $meta_individual_total != 0) ? round(($meta_individual_vidas_total / $meta_individual_total) * 100, 2) : 0;
                        @endphp

                        <tr data-id="{{$c->id}}">
                            <td class="bg-gray-700 bg-opacity-20 text-white">{{$c->nome}}</td>

                            <td><input type="number" name="concessionarias[{{$c->id}}][meta_individual]" class="meta_vidas bg-individual" placeholder="Meta" value="{{$c->meta_individual}}"></td>
                            <td><input type="number" name="concessionarias[{{$c->id}}][individual]" class="valor_vidas bg-individual" placeholder="Vidas" value="{{$c->individual}}"></td>

                            <td><input type="number" name="concessionarias[{{$c->id}}][meta_super_simples]" class="meta_vidas bg-super-simples" placeholder="Meta" value="{{$c->meta_super_simples}}"></td>
                            <td><input type="number" name="concessionarias[{{$c->id}}][super_simples]" class="valor_vidas bg-super-simples" placeholder="Vidas" value="{{$c->super_simples}}"></td>

                            <td><input type="number" name="concessionarias[{{$c->id}}][meta_pme]" class="meta_vidas bg-pme" placeholder="Meta" value="{{$c->meta_pme}}"></td>
                            <td><input type="number" name="concessionarias[{{$c->id}}][pme]" class="valor_vidas bg-pme" placeholder="Vidas" value="{{$c->pme}}"></td>

                            <td><input type="number" name="concessionarias[{{$c->id}}][meta_adesao]" class="meta_vidas bg-adesao" placeholder="Meta" value="{{$c->meta_adesao}}"></td>
                            <td><input type="number" name="concessionarias[{{$c->id}}][adesao]" class="valor_vidas bg-adesao" placeholder="Vidas" value="{{$c->adesao}}"></td>

                            <td style="padding-left: 30px;color:white;" id="meta_individual_total"><span>{{$meta_individual_total}}</span></td>
                            <td style="padding-left: 30px;color:white;" id="meta_individual_vidas_total"><span>{{$meta_individual_vidas_total}}</span></td>
                            <td style="padding-left: 30px;color:white;" id="meta_individual_total_porcentagem"><span>{{$meta_individual_total_porcentagem}}</span></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>











        </div>
    </div>
</div>



<nav class="navbar navbar-expand-md navbar-light shadow-lg py-2 text-sm" style="background-color:#006EB6;">
    <div class="container-fluid text-white">
        <div style="width:25%;display:flex;align-items: center;align-content: center;">
            <img src="{{asset('trofeu.png')}}" alt="Trofeu" style="width:25px;">
            <h5 class="my-auto font-italic" style="font-style: italic;">Ranking de Vendas</h5>
        </div>
        <div style="width:41%;text-align: center;color:black;">
            <span class="bg-white py-1 px-4 rounded" style="font-weight: bold;font-size: 1.1em;color:#335B99;" id="mes_ano">Goiania - Agosto/2024</span>
        </div>
        <div class="d-flex justify-content-between" style="width:33%;font-size: 0.875em;">
            <div class="d-flex flex-column text-center">
                <span>Faltam <span style="color:#F8DA22;font-weight:bold;" id="quantidade_dias">21</span> dias</span>
                <span>fim do mês</span>
            </div>
            <button style="border:none;background-color:#0dcaf0;color:#FFF;border-radius:10%;padding:0 20px;font-size:2em;" id="modal_concessionarias">+</button>
            <div class="d-flex flex-column text-center" style="font-size: 0.875em;">
                <span id="aqui_data">09/08/2024</span>
                <span id="aqui_hora">12:40</span>
            </div>
        </div>
    </div>
</nav>

<main id="principal" class="d-flex flex-column flex-grow">
    <div class="d-flex" style="min-height:99%;">
        <div style="display: flex;flex-basis:50%;flex-direction:column;">

            @php
                $total_vidas = $totals[0]->total_individual + $totals[0]->total_coletivo + $totals[0]->total_empresarial;
                $meta = 200;
                $porcentagem = ($total_vidas / $meta) * 100;
            @endphp

            <div id="header_esquerda" style="background-color:#2e4a7a; width:95%; border-radius:8px; margin:10px auto; padding:10px; display:flex; align-items:center; justify-content: space-between; height: 70px;">
                <div style="background-color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:3%;">
                    <img src="{{asset('foguete.png')}}" alt="Hapvida" style="width:80%;height:auto;">
                </div>

                <div class="container-meta">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Meta</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;">200</span>
                    </span>
                </div>

                @if(isset($totals[0]) && !empty($totals[0]))


                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Individual</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_individual">{{$totals[0]->total_individual}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Coletivo</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_coletivo">{{$totals[0]->total_coletivo}}</span>
                     </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Empresarial</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_empresarial">{{$totals[0]->total_empresarial}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Total</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_vidas">{{$total_vidas}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">%</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_porcentagem">{{ number_format($porcentagem, 2) }}%</span>
                    </span>
                </div>
                @endif
            </div>


            <div id="header_esquerda_concessionaria" style="display:none;background-color:#2e4a7a; width:95%; border-radius:8px; margin:10px auto; padding:10px; align-items:center; justify-content: space-between; height: 70px;">
                <div style="background-color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:3%;">
                    <img src="{{asset('foguete.png')}}" alt="Hapvida" style="width:80%;height:auto;">
                </div>
                @if(isset($totals_con[0]) && !empty($totals_con[0]))
                <div class="container-meta">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Meta</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;">{{$totals_con[0]->total_meta}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Individual</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_individual">{{$totals_con[0]->total_individual}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Super Simples</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_super_simples">{{$totals_con[0]->total_super_simples}}</span>
                     </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">PME</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_pme">{{$totals_con[0]->total_pme}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Adesão</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_adesao">{{$totals_con[0]->total_adesao}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Total</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_vidas">{{$totals_con[0]->total_vidas}}</span>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">%</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_porcentagem">{{ number_format($totals_con[0]->porcentagem_geral, 2) }}%</span>
                    </span>
                </div>
                @endif
            </div>



            <div class="stage">

            </div>
        </div>

        <div id="dados_direito" style="display: flex;flex-basis:50%;flex-direction:column;margin-top:10px;overflow-y: hidden;height:100%;position:relative;">

            @php
                $slideCount = 0;
            @endphp

            @foreach($ranking as $i => $r)
                @if ($i % 6 === 0)
                    <div class="slide" style="height:80%;">
                        @endif
                        <section style="display:flex;width:99%;justify-content:center;margin:5px auto;background-color:#2e4a7a;border-radius:10px;">
                            <!-- 1º Div: Posição ocupa toda a altura da section -->
                            <div style="background-color:#5d859e;font-weight:bold;color:#FFF;padding:5px 35px;font-size:1.2em;display: flex;align-items: center;justify-content: center;border-radius:5px;">
                                {{$loop->iteration}}°
                            </div>

                            <!-- 2º Div: Imagem centralizada no eixo Y com border-radius, próxima da 1ª div -->
                            <div style="flex: 0 1 auto; display: flex; align-items: center; margin-left: 8px;">
                                <img src="{{ asset($r->imagem) }}" class="rounded" style="height:60px;width:60px;border-radius:50%;" />
                            </div>

                            <!-- 3º Div: Próxima da 2ª div -->
                            <div style="display:flex;flex-direction: column;margin-left: 8px;color:#FFF;font-size:0.875em;min-width:50%">
                                <p style="margin:0;padding:0;">{{$r->corretor}}</p>
                                <div style="display:flex;margin:0;padding:0;justify-content:space-between;">
                                    <p style="margin:0;padding:0;">Meta: 200 Vidas</p>
                                    <p style="margin:0;padding:0;">Total: {{$r->quantidade_vidas}} Vidas</p>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <!-- Barra de Progresso -->
                                    <div class="progress" style="flex-grow: 1; margin-right: 10px; position: relative; background-color: #e0e0e0; height: 20px; border-radius: 10px;">
                                        @php
                                            $porcentagem = ($r->quantidade_vidas / 200) * 100;
                                        @endphp
                                        <div class="progress-bar bg-orange progress-bar-striped" role="progressbar" aria-valuenow="{{$porcentagem}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentagem}}%; background-color: #FFA500; height: 100%; border-radius: 10px;">
                                        </div>
                                    </div>
                                    <!-- Percentual ao lado direito -->
                                    <span style="color: #FFF; font-weight: bold; margin-left: 10px;">{{$porcentagem}}%</span>
                                </div>
                                <div>
                                    <p>Faltam: {{200 - $r->quantidade_vidas}} Vidas</p>
                                </div>
                            </div>

                            <!-- 4º Div: Encostado do lado direito -->
                            <div style="flex: 3;text-align: right;padding:2px;color:#FFF;font-size:0.875em;">
                                <p style="margin:0;padding:0;">Individual: {{$r->quantidade_individual}} vidas</p>
                                <p style="margin:0;padding:0;">Coletivo: {{$r->quantidade_coletivo}} vidas</p>
                                <p style="margin:0;padding:0;">Empresarial: {{$r->quantidade_empresarial}} vidas</p>
                                <p style="margin:0;padding:0;">Total: {{$r->quantidade_vidas}} vidas</p>
                            </div>
                        </section>
                        @if (($i + 1) % 6 === 0)
                    </div>
                @endif
            @endforeach


        </div>
        {{-- Fim Direita --}}
    </div>
</main>

<footer>
    <div class="footer-buttons d-flex justify-content-between">

        <button class="footer-btn active" data-corretora="vivaz">Time Vivaz</button>
        <button class="footer-btn" data-corretora="accert">Time Accert</button>
        <button class="footer-btn" data-corretora="innove">Time Innove</button>
        <button class="footer-btn" data-corretora="concessi">Concessionarias</button>
        <button class="footer-btn" data-corretora="estrela">Estrelas</button>
    </div>
    <div class="d-flex justify-content-center" style="background-color:#2e4a7a;">
        <img src="{{asset('hapvida-notreDame.png')}}" alt="Hapvida Logo" class="img-fluid my-auto" style="max-width: 200px;">
    </div>
</footer>


<script>
    window.onload = function() {


        function calcularTotalMeta(linha) {
            let totalMeta = 0;
            linha.find('.meta_vidas').each(function() {
                let valor = parseFloat($(this).val()) || 0;
                totalMeta += valor;
            });
            linha.find('#total_meta').text(totalMeta);
            calcularPorcentagem(linha, totalMeta);
        }


        function calcularTotalVidas(linha) {
            let totalVidas = 0;
            linha.find('.valor_vidas').each(function() {
                let valor = parseFloat($(this).val()) || 0;
                totalVidas += valor;
            });

            linha.find('#meta_individual_vidas_total').text(totalVidas);
            let totalMeta = parseFloat(linha.find('#meta_individual_total').text()) || 0;
            calcularPorcentagem(linha, totalMeta, totalVidas);
        }


        function calcularPorcentagem(linha, totalMeta, totalVidas) {
            totalVidas = totalVidas || parseFloat(linha.find('#meta_individual_vidas_total').text()) || 0;
            let porcentagem = 0;
            if (totalMeta > 0) {
                porcentagem = (totalVidas / totalMeta) * 100;
            }
            linha.find('#meta_individual_total_porcentagem').text(porcentagem.toFixed(2));
        }


        $('.meta_vidas, .valor_vidas').on('input', function() {
            let linha = $(this).closest('tr');
            if ($(this).hasClass('meta_vidas')) {
                calcularTotalMeta(linha);
            }
            else if ($(this).hasClass('valor_vidas')) {
                calcularTotalVidas(linha);
            }
        });


        // Opcional: calcula o total inicial para todas as linhas quando a página é carregada
        // $('tr').each(function() {
        //     calcularTotalMeta($(this));
        // });


        // Função para obter o mês em português
        function getMonthName(monthIndex) {
            const months = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];
            return months[monthIndex];
        }

        // Função para atualizar o mês e o ano
        function updateMonthYear() {
            const now = new Date();
            const month = getMonthName(now.getMonth());
            const year = now.getFullYear();
            document.getElementById('mes_ano').textContent = `Goiania - ${month}/${year}`;
        }

        updateMonthYear();


        // Função para atualizar a data e hora
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString('pt-BR');
            const time = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('aqui_data').textContent = date;
            document.getElementById('aqui_hora').textContent = time;
        }

        // Função para calcular os dias restantes até o final do mês
        function updateDaysRemaining() {
            const now = new Date();
            const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);
            const daysRemaining = Math.ceil((endOfMonth - now) / (1000 * 60 * 60 * 24));

            document.getElementById('quantidade_dias').textContent = daysRemaining;
        }

        // Atualiza a data e hora a cada segundo
        setInterval(updateDateTime, 1000);
        // Atualiza os dias restantes uma vez ao carregar a página
        updateDaysRemaining();


        document.getElementById('modal_concessionarias').onclick = function() {
            document.getElementById('planilhaModal').style.display = 'block';
        };

        function salvarConcecionario() {
            let concessionariasData = [];
            $('tbody tr').each(function () {
                let concessionariaId = $(this).data('id');

                // Coleta os valores dos inputs correspondentes a essa concessionária
                let meta_individual = $(this).find('input[name="concessionarias[' + concessionariaId + '][meta_individual]"]').val();
                let individual = $(this).find('input[name="concessionarias[' + concessionariaId + '][individual]"]').val();

                let meta_super_simples = $(this).find('input[name="concessionarias[' + concessionariaId + '][meta_super_simples]"]').val();
                let super_simples = $(this).find('input[name="concessionarias[' + concessionariaId + '][super_simples]"]').val();

                let meta_pme = $(this).find('input[name="concessionarias[' + concessionariaId + '][meta_pme]"]').val();
                let pme = $(this).find('input[name="concessionarias[' + concessionariaId + '][pme]"]').val();

                let meta_adesao = $(this).find('input[name="concessionarias[' + concessionariaId + '][meta_adesao]"]').val();
                let adesao = $(this).find('input[name="concessionarias[' + concessionariaId + '][adesao]"]').val();

                // Adiciona os dados no array
                concessionariasData.push({
                    id: concessionariaId,
                    meta_individual: meta_individual,
                    individual: individual,
                    meta_super_simples: meta_super_simples,
                    super_simples: super_simples,
                    meta_pme: meta_pme,
                    pme: pme,
                    meta_adesao: meta_adesao,
                    adesao: adesao
                });
            });

            $.ajax({
                url: '{{route('cadastrar.concessionaria')}}',  // Define a rota para o update
                method: 'POST',
                data: {
                    concessionarias: concessionariasData  // Dados a serem enviados
                }
            });

        }
















        document.getElementsByClassName('close')[0].onclick = function() {
            document.getElementById('planilhaModal').style.display = 'none';

            salvarConcecionario();


            {{--$.ajax({--}}
            {{--    type: 'POST',--}}
            {{--    url: "{{route('cadastrar.concessionaria')}}",--}}
            {{--    data: formData,--}}
            {{--    success: function(response) {--}}
            {{--        --}}
            {{--        console.log('Dados salvos com sucesso:', response);--}}
            {{--    },--}}
            {{--    // error: function(error) {--}}
            {{--    //     console.error('Erro ao salvar os dados:', error);--}}
            {{--    // }--}}
            {{--});--}}




        };

        window.onclick = function(event) {
            if (event.target == document.getElementById('planilhaModal')) {
                document.getElementById('planilhaModal').style.display = 'none';
                salvarConcecionario()
            }
        };

// Exemplo de cálculo de porcentagem e total
        function calcularPorcentagemEtotal() {
            let metaIndividual = parseFloat(document.getElementById('meta_individual').value) || 0;
            let vidasIndividual = parseFloat(document.getElementById('vidas_individual').value) || 0;

            let metaSuperSimples = parseFloat(document.getElementById('meta_super_simples').value) || 0;
            let vidasSuperSimples = parseFloat(document.getElementById('vidas_super_simples').value) || 0;

            let metaPme = parseFloat(document.getElementById('meta_pme').value) || 0;
            let vidasPme = parseFloat(document.getElementById('vidas_pme').value) || 0;

            let metaAdesao = parseFloat(document.getElementById('meta_adesao').value) || 0;
            let vidasAdesao = parseFloat(document.getElementById('vidas_adesao').value) || 0;

            document.getElementById('percent_individual').innerText = ((vidasIndividual / metaIndividual) * 100).toFixed(2) + '%';
            document.getElementById('percent_super_simples').innerText = ((vidasSuperSimples / metaSuperSimples) * 100).toFixed(2) + '%';
            document.getElementById('percent_pme').innerText = ((vidasPme / metaPme) * 100).toFixed(2) + '%';
            document.getElementById('percent_adesao').innerText = ((vidasAdesao / metaAdesao) * 100).toFixed(2) + '%';

            document.getElementById('total_meta').innerText = metaIndividual + metaSuperSimples + metaPme + metaAdesao;
            document.getElementById('total_vidas').innerText = vidasIndividual + vidasSuperSimples + vidasPme + vidasAdesao;
        }

        // document.querySelectorAll('input[type=number]').forEach(input => {
        //     input.addEventListener('input', calcularPorcentagemEtotal);
        // });


    };



    $(document).ready(function(){



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function createSlideShow() {
            const slides = document.querySelectorAll('.slide'); // Seleciona todos os slides
            let currentSlide = 0;
            function showSlide(n) {
                slides.forEach((slide, index) => {
                    slide.style.display = index === n ? 'block' : 'none';
                });
            }
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            // Mostrar o primeiro slide inicialmente
            showSlide(currentSlide);
            // Chamar a função nextSlide a cada X segundos (ajuste o intervalo conforme necessário)
            setInterval(nextSlide, 10000); // Troca de slide a cada 3 segundos
        }
        createSlideShow();

        const footerButtons = $('.footer-btn');
        let activeButtonIndex = 0; // Começamos com o índice 0 (Vivaz)
        // Função para logar o atributo data-corretora ou "null"
        function logCorretora() {
            const currentButton = footerButtons.eq(activeButtonIndex);
            //console.log(currentButton.length ? currentButton.data('corretora') : 'null');
        }
        // Função para mudar o botão ativo
        function changeActiveButton() {
            footerButtons.removeClass('active');
            footerButtons.eq(activeButtonIndex).addClass('active');

            const corretora = footerButtons.eq(activeButtonIndex).data('corretora');

            // Fazer a chamada AJAX para atualizar o ranking com base na corretora atual
            $.ajax({
                url: '{{ route('ranking.filtragem') }}',
                type: 'GET',
                data: { corretora: corretora },
                success: function(data) {
                    $(".stage").html(data.podium);
                    $("#dados_direito").html(data.ranking);
                    $(".total_individual").text(data.totals[0].total_individual);
                    $(".total_coletivo").text(data.totals[0].total_coletivo);
                    $(".total_empresarial").text(data.totals[0].total_empresarial);
                    let total_vidas = parseInt(data.totals[0].total_individual) + parseInt(data.totals[0].total_coletivo) + parseInt(data.totals[0].total_empresarial);
                    let meta = 200;
                    let porcentagem = (total_vidas / meta) * 100;
                    $(".total_vidas").text(total_vidas);
                    $(".total_porcentagem").text(porcentagem.toFixed(2));
                    createSlideShow();

                }
            });




            logCorretora(); // Logar a corretora atual
            activeButtonIndex = (activeButtonIndex + 1) % footerButtons.length;
        }
        // Chamar a função para iniciar com o botão Vivaz e logar "null"
        changeActiveButton();
        // Iniciar o intervalo para trocar os botões
        setInterval(changeActiveButton, 5000);

    });

</script>





</body>
</html>
