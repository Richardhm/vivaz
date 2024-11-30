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
    <link rel="stylesheet" href="{{asset('css/ranking.css')}}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        let audioDesbloqueado = false;
        let liderAtual = @json($liderAtual);
        let somCarro = new Audio('carro_ultrapassagem.mp3');
        let somFogos = new Audio('fogos.mp3');
        let isAnimating = false; // Controle para evitar animações simultâneas


        function gerarConfetes() {
            const confettiContainer = document.getElementById('confetti-container');
            const colors = ['#ff0', '#f00', '#0f0', '#00f', '#ff69b4', '#ff8c00', '#1e90ff', '#32cd32'];

            for (let i = 0; i < 100; i++) {  // Gera 100 confetes
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');

                // Define uma cor aleatória para cada confete
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.backgroundColor = randomColor;

                // Define uma posição horizontal aleatória (de 0 a 100% da largura da tela)
                confetti.style.left = Math.random() * 100 + 'vw';

                // Define tamanhos aleatórios para os confetes
                const randomSize = Math.random() * 10 + 5;  // Entre 5px e 15px
                confetti.style.width = randomSize + 'px';
                confetti.style.height = randomSize + 'px';

                // Adiciona a animação com uma duração aleatória
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's'; // Entre 2s e 5s de duração

                confettiContainer.appendChild(confetti);
            }

            // Remove os confetes após 6 segundos (tempo suficiente para cair)
            setTimeout(() => {
                confettiContainer.innerHTML = '';  // Limpa os confetes
            }, 6000);  // 6 segundos
        }


        function desbloquearAudio() {

            if(!audioDesbloqueado) {
                somCarro.muted = true;
                somCarro.play().then(() => {
                    audioDesbloqueado = true;
                    console.log("Áudio desbloqueado.");
                }).catch(error => {
                    console.error("Erro ao desbloquear áudio:", error);
                });
                somFogos.muted = true;
                somFogos.play().then(() => {
                    audioDesbloqueado = true;
                    console.log("Áudio desbloqueado 2.");
                }).catch(error => {
                    console.error("Erro ao desbloquear áudio:", error);
                });
            }

        }

        function animacaoVenda(corretor, imagemCorretor, quantidadeVidas) {
            //if (isAnimating) return; // Impede animações duplicadas
            // isAnimating = true;

            // desbloquearAudio();
            // if(audioDesbloqueado) {
            //     somCarro.muted = false;
            //     somFogos.muted = false;
            // }





            $('#rankingModal').removeClass('aparecer').addClass('ocultar');
            // Elementos que irão aparecer
            const fundoPreto = $("#fundo-preto");
            const imagem     = $("#imagem-corretor");
            const vidas      = $("#quantidade-vidas");
            const imagem2    = $(".assumir_lider");

            // Definir as informações do corretor e quantidade de vidas
            vidas.text(quantidadeVidas + " Vidas");
            imagem.attr("src", imagemCorretor);
            imagem2.attr("src", imagemCorretor);
            // Mostrar o fundo preto com a imagem do corretor e a quantidade de vidas
            fundoPreto.removeClass('ocultar').addClass('aparecer');
            // Iniciar o som da venda (áudio de 6 segundos)
            const somVenda = new Audio('/som_venda.mp3');
            somVenda.play();
            // Quando o áudio terminar, ocultar a animação
            somVenda.onended = function() {
                fundoPreto.removeClass('aparecer').addClass('ocultar');
                //isAnimating = false;
            };
            gerarConfetes();
            setTimeout(() => {
                fundoPreto.removeClass('aparecer').addClass('ocultar');
                //isAnimating = false;
            }, 6000);
            // Começar a animação dos fogos e o som após 6 segundos
            setTimeout(function() {
                let fogosBg = $("#fundo-preto-fogos");
                fogosBg.find("#quantidade-vidas-fogos").text(quantidadeVidas + " Vidas");
                $("#imagem-corretor-fogos").attr('src',imagemCorretor);
                let fogosContainer = $("#fogos-container");
                fogosBg.removeClass('ocultar').addClass('aparecer');
                const somFogos = new Audio('fogos.mp3');
                somFogos.play();
                // Definir o tempo de duração da animação dos fogos (20 segundos)
                setTimeout(function() {
                    somFogos.pause();
                    somFogos.currentTime = 0;
                    fogosContainer.fadeOut(300);
                    fogosBg.removeClass('aparecer').addClass('ocultar');
                }, 20000); // 20 segundos
            }, 6000); // Iniciar os fogos após 6 segundos (tempo da venda)
        }

        somCarro.onplay = function() {
            console.log("Som do carro começou.");
        };
        somCarro.onerror = function(e) {
            console.error("Erro ao carregar som do carro:", e);
        };

        somFogos.onplay = function() {
            console.log("Som do fogos começou.");
        };
        somFogos.onerror = function(e) {
            console.error("Erro ao carregar som do fogo:", e);
        };




        var usuarioInteragiu = false;

        function verificarTrocaDeLider(novoRanking, venda) {
            //if (isAnimating) return; // Impede execuções simultâneas da função
            // console.log("Verificar Lider Atual:", liderAtual);
            // console.log("Venda:", venda);
            //
            // desbloquearAudio();
            // if(audioDesbloqueado) {
            //     console.log("OLaaaaaa");
            //     somCarro.muted = false;
            //     somFogos.muted = false;
            // }
            //;

            if(novoRanking && novoRanking.length > 0) {
                $('#rankingModal').removeClass('aparecer').addClass('ocultar');
                const novoLider = novoRanking[0];
                if (novoLider.nome != liderAtual?.trim()) {
                    liderAtual = novoLider.nome.trim();
                    $(".assumir_lider").attr("src", venda.image);
                    $(".quantidade_vidas").text(venda.total);
                    let popUp = $("#popup-primeiro");
                    let fogosBg = $("#fogos-bg");
                    let fogosContainer = $("#fogos-container");
                    fogosBg.removeClass('ocultar').addClass('aparecer');
                    if(usuarioInteragiu) {
                        isAnimating = true;


                        somCarro.play();
                        somCarro.onended = function() {
                            popUp.fadeIn(300);
                            console.log("Som de carro finalizado.");

                            somFogos.play();
                            somFogos.onended = function() {
                                fogosContainer.fadeOut(300);
                                fogosBg.addClass('ocultar').removeClass("aparecer");
                                popUp.fadeOut(4000);
                                isAnimating = false;
                            };
                        };
                    }
                } else {
                    //console.log("Apenas Mais 1 venda");
                    // console.log("Venda feita pelo líder atual, sem troca de líder.");
                    animacaoVenda(venda.nome,venda.image,venda.total);
                }
            }
        }
        document.addEventListener('click', () => usuarioInteragiu = true);
        document.addEventListener('keydown', () => usuarioInteragiu = true);
        function abaEstaVisivel() {
            return document.visibilityState === 'visible';
        }
    </script>

    <script type="module">
        Echo.channel('ranking-channel').listen('.ranking.updated', (event) => {
            //desbloquearAudio();
            verificarTrocaDeLider(event.novoRanking, event.venda);
        });
    </script>


    <script>
        var ranking = "{{ route('ranking.atualizar') }}";

    </script>
</head>
<body>
<div id="overlay"></div>
<div id="loading">
    <span style="font-size:1.3em;">.</span>
    <span style="font-size:1.3em;">.</span>
    <span style="font-size:1.3em;">.</span>
</div>
<x-modal-ranking :vendasDiarias="$vendasDiarias"></x-modal-ranking>
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
                    <input type="number" id="meta_individual" name="meta_individual" class="form-control-sm text-black" required placeholder="Meta Individual" >
                </div>
                <div style="width: 12%;">
                    <label for="individual">Individual:</label>
                    <input type="number" id="individual" name="individual" required class="form-control-sm text-black" placeholder="Valor Individual">
                </div>
                <div style="width: 12%;">
                    <label for="meta_super_simples">Meta Super Simples:</label>
                    <input type="number" id="meta_super_simples" name="meta_super_simples" required class="form-control-sm text-black" placeholder="Meta Super Simples">
                </div>
                <div style="width: 12%;">
                    <label for="super_simples">Super Simples:</label>
                    <input type="number" id="super_simples" name="super_simples" required class="form-control-sm text-black" placeholder="Super Simples">
                </div>
                <div style="width: 12%;">
                    <label for="meta_pme">Meta PME:</label>
                    <input type="number" id="meta_pme" name="meta_pme" required class="form-control-sm text-black" placeholder="Meta PME">
                </div>
                <div style="width: 12%;">
                    <label for="pme">PME:</label>
                    <input type="number" id="pme" name="pme" required class="form-control-sm text-black" placeholder="PME">
                </div>
                <div style="width: 12%;">
                    <label for="meta_adesao">Meta Adesão:</label>
                    <input type="number" id="meta_adesao" name="meta_adesao" required class="form-control-sm text-black" placeholder="Meta Adesão">
                </div>
                <div style="width: 12%;">
                    <label for="adesao">Adesão:</label>
                    <input type="number" id="adesao" name="adesao" required class="form-control-sm text-black" placeholder="Adesão">
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
                        <td><input type="number" name="concessionarias[{{$c->id}}][meta_individual]" class="meta_vidas bg-individual text-black" placeholder="Meta" value="{{$c->meta_individual}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][individual]" class="valor_vidas bg-individual text-black" placeholder="Vidas" value="{{$c->individual}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][meta_super_simples]" class="meta_vidas bg-super-simples text-black" placeholder="Meta" value="{{$c->meta_super_simples}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][super_simples]" class="valor_vidas bg-super-simples text-black" placeholder="Vidas" value="{{$c->super_simples}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][meta_pme]" class="meta_vidas bg-pme text-black" placeholder="Meta" value="{{$c->meta_pme}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][pme]" class="valor_vidas bg-pme text-black" placeholder="Vidas" value="{{$c->pme}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][meta_adesao]" class="meta_vidas bg-adesao text-black" placeholder="Meta" value="{{$c->meta_adesao}}"></td>
                        <td><input type="number" name="concessionarias[{{$c->id}}][adesao]" class="valor_vidas bg-adesao text-black" placeholder="Vidas" value="{{$c->adesao}}"></td>
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
        <div style="width:30%;display:flex;align-items: center;align-content: center;justify-content: space-between;">
            <div style="display:flex;">
                <img src="{{asset('trofeu.png')}}" alt="Trofeu" style="width:25px;">
                <h5 class="my-auto font-italic" style="font-style: italic;">Ranking de Vendass</h5>
            </div>
            <div>
                <span class="bg-white py-1 px-4 rounded" style="font-weight: bold;font-size: 1.2em;color:#335B99;" id="mes_ano">Goiania - Novembro/2024</span>
            </div>
        </div>
        <div style="width:36%;text-align: center;">
            <span class="bg-white py-1 px-4 rounded" style="font-weight: bold;font-size: 2.5em;color:#335B99;" id="titulo_ranking">Ranking - Diario</span>
        </div>
        <div class="d-flex justify-content-between items-center" style="width:33%;font-size: 1em;">
            <div class="d-flex text-center flex-wrap">
                <span style="width:100%;margin:0;padding:0;">Faltam <span style="color:#F8DA22;font-weight:bold;" id="quantidade_dias">21</span> dias</span>
                <span style="width:100%;">para o</span>
                <span style="width:100%;margin:0;padding:0;">fim do mês</span>
            </div>

{{--            <button style="border:none;background-color:#0dcaf0;color:#FFF;border-radius:5%;font-size:1em;padding:7px;display:flex;align-items:center;align-self: center;" onclick="enviarMensagem()">Teste</button>--}}
            <button style="border:none;background-color:#0dcaf0;color:#FFF;border-radius:5%;font-size:1em;padding:7px;display:flex;align-items:center;align-self: center;" id="modal_concessionarias">Concessionarias</button>
            <button style="border:none;background-color:#0dcaf0;color:#FFF;border-radius:5%;font-size:1em;padding:7px;margin:0 15px 0 5px;display:flex;align-items:center;align-self: center;" id="modal_ranking_diario">Ranking</button>
            <div class="d-flex flex-column text-center" style="font-size: 1.5em;">
                <span id="aqui_data">09/08/2024</span>
                <span id="aqui_hora">12:40</span>
            </div>
        </div>
    </div>
</nav>

<div class="carrossel-container ocultar">
    <div class="slides-container">

        <div class="slide-carrossel">
            <img src="{{asset('slides/01.jpg')}}" alt="Imagem 1">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/02.jpg')}}" alt="Imagem 2">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/03.jpg')}}" alt="Imagem 3">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/04.jpg')}}" alt="Imagem 4">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/05.jpg')}}" alt="Imagem 5">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/06.jpg')}}" alt="Imagem 6">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/07.jpg')}}" alt="Imagem 7">
        </div>
        <div class="slide-carrossel">
            <img src="{{asset('slides/08.jpg')}}" alt="Imagem 8">
        </div>

    </div>
</div>

<main id="principal" class="d-flex flex-column flex-grow">

    <div class="d-flex" style="min-height:99%;">
        <div style="display:flex;flex-basis:50%;flex-direction:column;">
            @php
                $total_vidas=$totals[0]->total_individual + $totals[0]->total_coletivo + $totals[0]->total_empresarial;
                $meta=10;
                $porcentagem=($total_vidas / $meta) * 100;
            @endphp
            <div id="header_esquerda" style="background-color:#2e4a7a; width:95%; border-radius:8px; margin:10px auto; padding:10px; display:flex; align-items:center; justify-content: space-between; height: 70px;">
                <div style="background-color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:3%;">
                    <img src="{{asset('foguete.png')}}" alt="Hapvida" style="width:80%;height:auto;">
                </div>
                <div class="container-meta">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Meta</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="aqui_meta">13</span>
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

            <div id="header_esquerda_concessionaria" class="ocultar" style="background-color:#2e4a7a; width:95%; border-radius:8px; margin:10px auto; padding:10px; display:flex; align-items:center; justify-content: space-between; height: 70px;">
                <div style="background-color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:3%;">
                    <img src="{{asset('foguete.png')}}" alt="Hapvida" style="width:80%;height:auto;">
                </div>
                <div class="container-meta">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Meta</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_concessioanaria_meta">3096</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Individual</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_individual_concessionaria">0</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Super Simples</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_super_simples_concessionaria">0</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">PME</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_pme_concessionaria">0</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Adesão</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_adesao_concessionaria">0</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Total</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_vidas_concessionaria">0</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">%</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_porcentagem_concessionaria">O%</span>
                </div>

            </div>

            <div id="header_esquerda_estrela" class="ocultar" style="background-color:#2e4a7a; width:95%; border-radius:8px; margin:10px auto; padding:10px; display:flex; align-items:center; justify-content: space-around; height: 70px;">
                <div style="background-color:white;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:3%;">
                    <img src="{{asset('foguete.png')}}" alt="Hapvida" style="width:80%;height:auto;">
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">3 Estrelas</span>
                    <div class="d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    </div>
                    <span style="color:#FFF;">150 a 190 vidas</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">4 Estrelas</span>
                    <div class="d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>

                    </div>
                    <span style="color:#FFF;">151 a 250 vidas</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">5 Estrelas</span>
                    <div class="d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path fill="#FFD700" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    </div>
                    <span style="color:#FFF;">Apartir de 251 vidas</span>
                </div>
            </div>
            <div class="stage">
            </div>
        </div>
        <div id="dados_direito" style="overflow-y:hidden;height:100%;width:49%;">

        </div>
        {{-- Fim Direita --}}
    </div>
</main>

<!-- Card do 1º lugar -->
<div id="popup-primeiro" class="ocultar" style="position:fixed;inset: 0;z-index: 50;background-color:black;opacity: 50;">
    <div style="width:400px;height:400px;border-radius:10px;color:white;display:flex;flex-direction:column;margin:5px auto;">

        <!-- Header: Compacto com menos altura -->
        <div class="header" style="flex: 0 0 10%; display: flex; align-items: center; justify-content: space-between; padding: 0 10px;background-color:red;">
            <img src="{{asset('medalha-primeiro.png')}}" style="width:100px;height:100px;" alt="">
            <p style="font-size:1.5em; display:flex; flex-direction:column; justify-content:center; color:#FFF; text-align:center; line-height: 1;">
                <span style="font-size:2em; font-weight: bold;" class="quantidade_vidas"></span>
                <span style="font-weight: bold;">Vidas</span>
            </p>
        </div>

        <!-- Corpo: Diminuir o tamanho da imagem para encaixar melhor -->
        <div class="corpo  w-full" style="flex: 1; display: flex; justify-content: center; align-items: flex-start;">
            <img src="" class="assumir_lider" style="width:550px;height:550px;border-radius:50%;box-sizing:border-box;" alt="" title="">
        </div>

        <!-- Footer: Mais compacto com menos altura -->
        <div class="footer w-full bg-gray-200" style="flex: 0 0 10%; display: flex; justify-content: center; align-items: center; font-size: 1.5em; color:#FFF; font-weight:bold;">
            1º Lugar no Ranking
        </div>

    </div>
</div>







<!-- Fundo preto para os fogos de artifício -->
<div id="fogos-bg" class="ocultar"  style="display:flex;background-color: black;z-index: 50;inset: 0;position: fixed;align-items: center;justify-content: center; --tw-bg-opacity: 0.8;">
    <div style="border-radius:10px;color:white;display:flex;flex-direction:column;margin-bottom: 20px;">

        <!-- Header: Compacto com menos altura -->
        <div class="header" style="flex: 0 0 10%; display: flex; align-items: center; justify-content: space-between; padding: 0 10px;width:100%;">
                <img src="{{asset('medalha-primeiro.png')}}" style="width:100px;height:100px;" alt="">
            <p style="font-size:1.5em; display:flex; flex-direction:column; justify-content:center; color:white; text-align:center; line-height: 1;">
                <span style="font-size:2em; font-weight: bold;" class="quantidade_vidas"></span>
                <span style="font-weight: bold;">Vidas</span>
            </p>
        </div>

        <!-- Corpo: Diminuir o tamanho da imagem para encaixar melhor -->
        <div class="corpo" style="display: flex; justify-content: center; align-items: flex-start;">
            <img src="" class="assumir_lider" style="width:550px;height:550px;border-radius:50%;box-sizing:border-box;">
        </div>

        <!-- Footer: Mais compacto com menos altura -->
        <div class="footer footer_ranking" style="flex: 0 0 10%;display:flex;justify-content: center;align-items:center;font-size:1.5em;color:#FFF;font-weight:bold;">
            1º Lugar no Ranking
        </div>


    </div>
</div>

<div id="fundo-preto-fogos" class="ocultar" style="display:flex;background-color: black;z-index: 50;inset: 0;position: fixed;align-items: center;justify-content: center; --tw-bg-opacity: 0.8;">
    <div class="text-center">
        <p id="quantidade-vidas-fogos" style="font-size: 2.5em; color: white; font-weight: bold;"></p>
        <img id="imagem-corretor-fogos" src="" alt="Corretor" style="width: 550px; height: 550px; border-radius: 50%; margin-top: 20px;">
    </div>
</div>


<div id="fundo-preto" class="ocultar" style="display:flex;background-color: black;z-index: 50;inset: 0;position: fixed;align-items: center;justify-content: center; --tw-bg-opacity: 0.8;">
    <div class="text-center">
        <p id="quantidade-vidas" style="font-size: 2.5em; color: white; font-weight: bold;">10 Vidas</p>
        <img id="imagem-corretor" src="" alt="Corretor" style="width: 550px; height: 550px; border-radius: 50%; margin-top: 20px;">
    </div>
    <div id="confetti-container"></div>
</div>

<!-- Animação dos fogos (opcionalmente um canvas para os fogos) -->
<div id="fogos-container" class="hidden" style="position:fixed;z-index: 50;inset: 0;">
    <!-- Conteúdo dos fogos (Canvas, SVG, etc) -->
</div>

<!-- Fundo preto para a animação do carro -->
<div id="carro-bg" class="ocultar" style="background-color:black;inset:0;position:fixed;opacity: 0.9;"></div>

<footer id="footer-aqui">
    <div class="footer-buttons d-flex justify-content-between">
        <button class="footer-btn active" data-corretora="diario">Diario</button>
        <button class="footer-btn" data-corretora="semanal">Semanal</button>
        <button class="footer-btn" data-corretora="vivaz">Vivaz</button>
        <button class="footer-btn" data-corretora="accert">Equipe Accert</button>
        <button class="footer-btn" data-corretora="innove">Equipe Innove</button>
        <button class="footer-btn" data-corretora="concessi">Concessionarias</button>
        <button class="footer-btn" data-corretora="estrela">Estrelas</button>
        <button class="footer-btn" data-corretora="carrossel">Campanhas</button>
    </div>
    <div class="d-flex justify-content-center" style="background-color:#2e4a7a;">
        <img src="{{asset('hapvida-notreDame.png')}}" alt="Hapvida Logo" class="img-fluid my-auto" style="max-width: 200px;">
    </div>
</footer>
<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
        function getMonthName(monthIndex) {
            const months = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];
            return months[monthIndex];
        }
        function updateMonthYear() {
            const now = new Date();
            const month = getMonthName(now.getMonth());
            const year = now.getFullYear();
            document.getElementById('mes_ano').textContent = `Goiania - ${month}/${year}`;
        }
        updateMonthYear();
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString('pt-BR');
            const time = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('aqui_data').textContent = date;
            document.getElementById('aqui_hora').textContent = time;
        }
        function updateDaysRemaining() {
            const now = new Date();
            const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);
            const daysRemaining = Math.ceil((endOfMonth - now) / (1000 * 60 * 60 * 24));
            document.getElementById('quantidade_dias').textContent = daysRemaining;
        }
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
        };
        window.onclick = function(event) {
            if (event.target == document.getElementById('planilhaModal')) {
                document.getElementById('planilhaModal').style.display = 'none';
                salvarConcecionario();
            }
        };
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

        function fecharRankingModal() {
            $('.modal_ranking_diario').removeClass('aparecer').addClass('ocultar');
        }

        function abrirFogosModal() {
            $('#fogosModal').addClass('aparecer').removeClass('ocultar');
        }

        // Variável global para armazenar o líder atual


        function exibirPopUpComFogos(nome, imagem) {
            let popUp = $("#popup-primeiro");
            // let carroContainer = $("#carro-container");
            // let carroBg = $("#carro-bg");
            // let nomeContainer = $("#nome-primeiro");
            // let imagemContainer = $("#imagem-primeiro");
            // Exibe o pop-up e a animação dos fogos
            //$("#rankingModal").removeClass("aparecer").addClass("ocultar");
            $("#popup-primeiro").removeClass("ocultar").addClass("aparecer");

            // abrirFogosModal(); // Função para abrir a modal dos fogos de artifício
            // nomeContainer.html(nome);
            // imagemContainer.attr('src', imagem);
            // // Toca o som dos fogos
            // const somFogos = new Audio('fogos.mp3');
            // somFogos.play().catch(error => console.error('Erro ao reproduzir som de fogos:', error));
            // Fechar os fogos após 54 segundos
            // setTimeout(function () {
            //     popUp.addClass("ocultar").removeClass('aparecer'); // Oculta o pop-up dos fogos
            //     somFogos.pause(); // Para o som dos fogos
            //     // Agora, iniciar a animação do carro com som de ultrapassagem
            //     //exibirCarroComSom(nome);
            // }, 54000); // Após 54 segundos
        }


        // function animacaoVenda(corretor, imagemCorretor, quantidadeVidas) {
        //     $('#rankingModal').removeClass('aparecer').addClass('ocultar');
        //     const fundoPreto = $("#fundo-preto");
        //     const imagem = $("#imagem-corretor");
        //     const vidas = $("#quantidade-vidas");
        //
        //     // Definir as informações do corretor e quantidade de vidas
        //     vidas.text(quantidadeVidas + " Vidas");
        //     imagem.attr("src", imagemCorretor);
        //
        //     // Mostrar o fundo preto com a imagem do corretor e a quantidade de vidas
        //     fundoPreto.removeClass('ocultar').addClass('aparecer');
        //
        //     // Iniciar os confetes
        //     gerarConfetes();
        //
        //     // Função para repetir o áudio de venda até completar 21 segundos
        //     const somVenda = new Audio('/som_venda.mp3');
        //
        //     // Função para tocar o áudio repetidamente até 21 segundos
        //     let tempoTotal = 0;
        //     function repetirSom() {
        //         if (tempoTotal < 21000) {  // 21 segundos = 21000 milissegundos
        //             somVenda.play();
        //             somVenda.onended = function() {
        //                 tempoTotal += somVenda.duration * 1000;  // Adiciona a duração do áudio em milissegundos
        //                 repetirSom();  // Chama novamente a função para repetir o áudio
        //             };
        //         }
        //     }
        //
        //     // Iniciar a reprodução do áudio pela primeira vez
        //     repetirSom();
        //
        //     // Definir um timeout para garantir que o fundo preto suma após 21 segundos
        //     setTimeout(function() {
        //         fundoPreto.removeClass('aparecer').addClass('ocultar');
        //     }, 21000); // 21 segundos = 21000 milissegundos
        // }




        // function animacaoVenda(corretor, imagemCorretor, quantidadeVidas) {
        //     $('#rankingModal').removeClass('aparecer').addClass('ocultar');
        //     // Elementos que irão aparecer
        //     const fundoPreto = $("#fundo-preto");
        //     const imagem = $("#imagem-corretor");
        //     const vidas = $("#quantidade-vidas");
        //     const imagem2 = $(".assumir_lider");
        //     // Definir as informações do corretor e quantidade de vidas
        //     vidas.text(quantidadeVidas + " Vidas");
        //     imagem.attr("src", imagemCorretor);
        //     imagem2.attr("src", imagemCorretor);
        //
        //     // Mostrar o fundo preto com a imagem do corretor e a quantidade de vidas
        //     fundoPreto.removeClass('ocultar').addClass('aparecer');
        //
        //     // Iniciar o som da venda (áudio de 6 segundos)
        //     const somVenda = new Audio('/som_venda.mp3');
        //     somVenda.play();
        //
        //     // Quando o áudio terminar, ocultar a animação
        //     somVenda.onended = function() {
        //         fundoPreto.removeClass('aparecer').addClass('ocultar');
        //     };
        //     gerarConfetes();
        //     // Definir um timeout para garantir que o fundo preto suma após 6 segundos (ou caso o áudio não termine corretamente)
        //     setTimeout(function() {
        //         fundoPreto.removeClass('aparecer').addClass('ocultar');
        //     }, 6000); // 6 segundos = 6000 milissegundos
        //
        //
        //     let fogosBg = $("#fogos-bg");
        //     let fogosContainer = $("#fogos-container");
        //     fogosBg.removeClass('ocultar').addClass('flex');
        //
        //     const somFogos = new Audio('fogos.mp3');
        //     somFogos.play();
        //     setTimeout(function() {
        //         somFogos.pause();
        //         somFogos.currentTime = 0;
        //         fogosContainer.fadeOut(300);
        //         fogosBg.fadeOut(300);
        //         popUp.fadeOut(300);
        //
        //     }, 20000); // Ajuste o tempo de acordo com a duração da animação dos fogos
        //
        //
        // }

        // Função para verificar a troca de liderança
        $("body").on('change','#user_id',function(){
            let user_id = $(this).val();
            $("#overlay").show();
            $("#loading").show();
            $.ajax({
                url:"{{route('ranking.verificar.corretor')}}",
                method:"POST",
                data: {user_id},
                success:function(res) {
                    $("body").find("input[name='vidas_individual']").val(res.individual);
                    $("body").find("input[name='vidas_coletivo']").val(res.coletivo);
                    $("body").find("input[name='vidas_empresarial']").val(res.empresarial);
                },
                complete: function() {
                    // Ocultar o loading quando a requisição AJAX for concluída
                    $("#overlay").hide();
                    $("#loading").hide();
                }
            });
        });

        //AJAX para atualizar o ranking e verificar troca de liderança
        $('#rankingForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: ranking,
                method: "POST",
                data: $(this).serialize(),
                success: function (res) {
                    // if (res && res.ranking && res.ranking.length > 0) {
                    //     verificarTrocaDeLider(res.ranking,res.venda);
                    // }
                }
            });
        });

        let activeButtonIndex = 0; // Começamos com o índice 0 (Vivaz)
        const footerButtons = $('.footer-btn'); // Botões do rodapé
        const slidesContainer = $('.slides-container');
        const totalSlides = $('.slide-carrossel').length; // Total de slides
        let currentSlide = 0; // Índice do slide atual

        $(footerButtons).on('click', function () {
            activeButtonIndex = footerButtons.index(this); // Atualiza o índice do botão ativo
            trocaDeAba(); // Chama trocaDeAba com o novo índice
        });

        function trocaDeAba() {
            desbloquearAudio();
            document.body.dispatchEvent(new Event('click'));
            footerButtons.removeClass('active'); // Remove a classe 'active' de todos os botões
            footerButtons.eq(activeButtonIndex).addClass('active'); // Adiciona 'active' ao botão atual

            let corretora = footerButtons.eq(activeButtonIndex).data('corretora'); // Define a corretora pelo índice ativo

            if (corretora !== "carrossel") {

                if(corretora == "diario") {
                    $("#titulo_ranking").text("Ranking - Diario");
                } else if(corretora == "semanal") {
                    $("#titulo_ranking").text("Ranking - Semanal");
                } else if(corretora == "accert") {
                    $("#titulo_ranking").text("Ranking - Accert");
                } else if(corretora === "innove") {
                    $("#titulo_ranking").text("Ranking - Innove");
                } else if(corretora == "estrela") {
                    $("#titulo_ranking").text("Ranking - Estrela");
                } else if(corretora == "vivaz") {
                    $("#titulo_ranking").text("Ranking - Vivaz");
                } else if(corretora == "concessi") {
                    $("#titulo_ranking").text("Ranking - Concessionárias");
                }



                $(".carrossel-container").addClass("ocultar");
                $("#principal").addClass("d-flex flex-column flex-grow").removeClass('ocultar');
                $("#footer-aqui").removeClass("ocultar");
                document.body.dispatchEvent(new Event('click'));
                $.ajax({
                    url: '{{ route('ranking.filtragem') }}',
                    type: 'GET',
                    data: { corretora: corretora },
                    success: function (data) {

                        // Atualiza o conteúdo do ranking e os valores do lado direito
                        $(".stage").html(data.podium);
                        $("#dados_direito").html(data.ranking);
                        let total_vidas = parseInt(data.totals[0].total_individual) + parseInt(data.totals[0].total_coletivo) + parseInt(data.totals[0].total_empresarial);
                        let meta = defineMetaPorCorretora(corretora);

                        $(".aqui_meta").text(meta);
                        $(".total_vidas").text(total_vidas);
                        $(".total_porcentagem").text(((total_vidas / meta) * 100).toFixed(2));
                        updateHeader(corretora,data.totals[0]);
                        let numGroups = corretora === "concessi" ? $('.slide-corretora').length : $('.slide-group').length;
                        if (corretora === "concessi") {
                            createSlideShowCorretora(numGroups);
                        } else {
                            createSlideShow(numGroups);
                        }
                        setTimeout(() => {
                            activeButtonIndex = (activeButtonIndex + 1) % footerButtons.length;
                            changeActiveButton(); // Troca para o próximo botão após o tempo
                        }, numGroups * 15000);
                    }
                });
            } else {
                iniciarCarrossel();
            }
        }

        function defineMetaPorCorretora(corretora) {
            switch (corretora) {
                case 'accert': return 236;
                case 'innove': return 236;
                case 'diario': return 10;
                case 'semanal': return 65;
                case 'estrela': return 150;
                case 'concessi': return 3629;
                case 'vivaz': return 472;
                default: return 0;
            }
        }

        function iniciarCarrossel() {
            $("#principal").addClass('ocultar');
            $(".carrossel-container").removeClass("ocultar");
            $("#footer-aqui").addClass("ocultar");
            $("#titulo_ranking").text("Ranking - Campanhas")
            currentSlide = 0;
            showSlide(currentSlide);
            startCarousel();
            setTimeout(() => {
                activeButtonIndex = (activeButtonIndex + 1) % footerButtons.length;
                changeActiveButton();
            }, 63000); // 63 segundos para o carrossel
        }

        function changeActiveButton() {
            trocaDeAba(); // Chama a troca de aba para o próximo botão
        }

        // Funções auxiliares para slides e cabeçalho omitidas para brevidade, mas mantidas iguais
        trocaDeAba()

        function updateHeader(corretora,totais) {
            // Lógica de atualização de header conforme a corretora
            if (corretora === 'concessi') {
                $("#header_esquerda_concessionaria").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda_estrela").removeClass('aparecer').addClass('ocultar');

                $(".total_individual_concessionaria").text(totais.total_individual);
                $(".total_super_simples_concessionaria").text(totais.total_super_simples);
                $(".total_pme_concessionaria").text(totais.total_pme);
                $(".total_adesao_concessionaria").text(totais.total_adesao);
                $(".total_vidas_concessionaria").text(totais.total_vidas);
                $(".total_porcentagem_concessionaria").text(totais.porcentagem_geral);



            } else if (corretora === 'estrela') {
                $("#header_esquerda_estrela").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda_concessionaria").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda").removeClass('aparecer').addClass('ocultar');
            } else {
                $("#header_esquerda").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda_concessionaria").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda_estrela").removeClass('aparecer').addClass('ocultar');

                $(".total_individual").text(totais.total_individual);
                $(".total_coletivo").text(totais.total_coletivo);
                $(".total_empresarial").text(totais.total_empresarial);




            }
        }

        function createSlideShow(numGroups) {
            const slideGroups = document.querySelectorAll('.slide-group');
            let currentGroup = 0;
            function showSlideGroup(n) {
                slideGroups.forEach((group, index) => {
                    group.style.display = index === n ? 'flex' : 'none';
                });
            }
            function nextSlideGroup() {
                currentGroup = (currentGroup + 1) % slideGroups.length;
                showSlideGroup(currentGroup);
            }
            // Exibe o primeiro grupo de slides
            showSlideGroup(currentGroup);
            // Tempo de exibição de cada grupo (mínimo de 15 segundos)
            let groupTime = Math.max(15, 15);
            setInterval(nextSlideGroup, groupTime * 1000);
        }

        function showSlide(index) {
            const slideWidth = 100; // Cada slide ocupa 100% da largura
            slidesContainer.css('transform', `translateX(-${index * slideWidth}%)`); // Mover o contêiner dos slides
        }



        function createSlideShowCorretora(numGroups) {
            const slideGroups = document.querySelectorAll('.slide-corretora');
            let currentGroup = 0;

            function showSlideGroup(n) {
                slideGroups.forEach((group, index) => {
                    group.style.display = index === n ? 'block' : 'none';
                });
            }
            function nextSlideGroup() {
                currentGroup = (currentGroup + 1) % slideGroups.length;
                showSlideGroup(currentGroup);
            }            // Exibe o primeiro grupo de slides
            showSlideGroup(currentGroup);
            // Tempo de exibição de cada grupo (mínimo de 15 segundos)
            let groupTime = Math.max(15, 15);
            setInterval(nextSlideGroup, groupTime * 1000);
        }

        let carouselInterval;

        function startCarousel() {
            currentSlide = 0; // Sempre começa do primeiro slide
            if (carouselInterval) {
                clearInterval(carouselInterval);
            }
            carouselInterval = setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides; // Avança para o próximo slide, volta ao primeiro se chegar ao final
                showSlide(currentSlide); // Mostra o slide atual
            }, 7000); // Troca a cada 3 segundos
        }





        function logCorretora() {
            const currentButton = footerButtons.eq(activeButtonIndex);
        }


        function numberFormat(number, decimals = 2, decPoint = '.', thousandsSep = ',') {
            // Define o número de decimais
            const fixedNumber = number.toFixed(decimals);

            // Separa a parte inteira da parte decimal
            let [integerPart, decimalPart] = fixedNumber.split('.');

            // Adiciona separadores de milhares
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);

            // Junta a parte inteira e decimal com o separador decimal
            return decimalPart ? integerPart + decPoint + decimalPart : integerPart;
        }


    });
</script>

<script src="{{asset('js/ranking.js')}}"></script>



</body>
</html>
