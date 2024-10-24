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

{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--    <script type="module">--}}
{{--        Echo.private("App.Models.User.183").notification((e) => {--}}
{{--            console.log("Oaaaapppppppppppppppssssssssssssss");--}}
{{--            console.log(e);--}}
{{--            // if(e.type === "App\\Notifications\\MessageTestNotification") {--}}
{{--            //--}}
{{--            //     toastr[e.status](e.body);--}}
{{--            // }--}}
{{--        });--}}
{{--    </script>--}}



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
        <div style="width:30%;display:flex;align-items: center;align-content: center;justify-content: space-between;">
            <div style="display:flex;">
                <img src="{{asset('trofeu.png')}}" alt="Trofeu" style="width:25px;">
                <h5 class="my-auto font-italic" style="font-style: italic;">Ranking de Vendas</h5>
            </div>
            <div>
                <span class="bg-white py-1 px-4 rounded" style="font-weight: bold;font-size: 1.2em;color:#335B99;" id="mes_ano">Goiania - Agosto/2024</span>
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
                        <span style="color:#6a1a21;" class="aqui_meta">10</span>
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
                        <span style="color:#6a1a21;" class="total_individual_concessionaria">12</span>
                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Super Simples</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_super_simples_concessionaria">13</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">PME</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_pme_concessionaria">15</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Adesão</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_adesao_concessionaria">18</span>

                </div>
                <div style="display:flex;flex-direction:column;">
                    <span style="color:#FFF;font-weight:bold;display:flex;justify-content:center;">Total</span>
                    <span style="background-color:rgba(255, 255, 255, 0.8);padding:5px 15px;display:flex;justify-content:center;border-radius:10px;font-weight:bold;width:80px;border:2px solid yellow;">
                        <span style="color:#6a1a21;" class="total_vidas_concessionaria">20</span>
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
<div id="popup-primeiro" class="fixed inset-0 z-50 bg-black bg-opacity-50 ocultar">
    <div style="width:400px;height:400px;border-radius:10px;color:white;display:flex;flex-direction:column;margin:5px auto;">

        <!-- Header: Compacto com menos altura -->
        <div class="header w-full bg-red-700 border-b" style="flex: 0 0 10%; display: flex; align-items: center; justify-content: space-between; padding: 0 10px;">
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
<div id="fogos-bg" class="fixed inset-0 z-49 bg-black bg-opacity-50 ocultar"  style="justify-content: center; align-items: center;">
    <div style="width:400px;height:400px;border-radius:10px;color:white;display:flex;flex-direction:column;margin:5px auto;">

        <!-- Header: Compacto com menos altura -->
        <div class="header w-full bg-red-700 border-b" style="flex: 0 0 10%; display: flex; align-items: center; justify-content: space-between; padding: 0 10px;">
            <img src="{{asset('medalha-primeiro.png')}}" style="width:100px;height:100px;" alt="">
            <p style="font-size:1.5em; display:flex; flex-direction:column; justify-content:center; color:white; text-align:center; line-height: 1;">
                <span style="font-size:2em; font-weight: bold;" class="quantidade_vidas"></span>
                <span style="font-weight: bold;">Vidas</span>
            </p>
        </div>

        <!-- Corpo: Diminuir o tamanho da imagem para encaixar melhor -->
        <div class="corpo w-full" style="flex: 1; display: flex; justify-content: center; align-items: flex-start;">
            <img src="" class="assumir_lider" style="width:550px;height:550px;border-radius:50%;box-sizing:border-box;" alt="Rebeca" title="Rebeca">
        </div>

        <!-- Footer: Mais compacto com menos altura -->
        <div class="footer footer_ranking w-full bg-gray-200" style="flex: 0 0 10%;display:flex;justify-content: center;align-items:center;font-size:1.5em;color:#FFF;font-weight:bold;">
            1º Lugar no Ranking
        </div>

    </div>
</div>

<div id="fundo-preto" class="ocultar fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80">
    <div class="text-center">
        <p id="quantidade-vidas" style="font-size: 2.5em; color: white; font-weight: bold;">10 Vidas</p>
        <img id="imagem-corretor" src="" alt="Corretor" style="width: 550px; height: 550px; border-radius: 50%; margin-top: 20px;">
    </div>
    <div id="confetti-container"></div>
</div>

<!-- Animação dos fogos (opcionalmente um canvas para os fogos) -->
<div id="fogos-container" class="fixed inset-0 z-50 hidden">
    <!-- Conteúdo dos fogos (Canvas, SVG, etc) -->
</div>


<!-- Fundo preto para a animação do carro -->
<div id="carro-bg" class="fixed inset-0 bg-black opacity-90 ocultar"></div>

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

        let liderAtual = @json($liderAtual);

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

        function animacaoVenda(corretor, imagemCorretor, quantidadeVidas) {



            $('#rankingModal').removeClass('aparecer').addClass('ocultar');
            // Elementos que irão aparecer
            const fundoPreto = $("#fundo-preto");
            const imagem = $("#imagem-corretor");
            const vidas = $("#quantidade-vidas");
            const imagem2 = $(".assumir_lider");


            console.log("Vidasssssss ",vidas);


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
            };
            gerarConfetes();
            // Definir um timeout para garantir que o fundo preto suma após 6 segundos (ou caso o áudio não termine corretamente)
            setTimeout(function() {
                fundoPreto.removeClass('aparecer').addClass('ocultar');
            }, 6000); // 6 segundos = 6000 milissegundos

            // Começar a animação dos fogos e o som após 6 segundos
            setTimeout(function() {
                let fogosBg = $("#fogos-bg");
                let fogosContainer = $("#fogos-container");
                fogosBg.removeClass('ocultar').addClass('flex');
                const somFogos = new Audio('fogos.mp3');
                somFogos.play();
                // Definir o tempo de duração da animação dos fogos (20 segundos)
                setTimeout(function() {
                    somFogos.pause();
                    somFogos.currentTime = 0;
                    fogosContainer.fadeOut(300);
                    fogosBg.fadeOut(300);
                }, 20000); // 20 segundos
            }, 6000); // Iniciar os fogos após 6 segundos (tempo da venda)
        }


        // Função para verificar a troca de liderança
        function verificarTrocaDeLider(novoRanking,venda) {
            $('#rankingModal').removeClass('aparecer').addClass('ocultar');
            if (novoRanking && novoRanking.length > 0) {
                const novoLider = novoRanking[0]; // O primeiro da lista é o novo líder
                // Se o líder atual for diferente do novo líder
                if (liderAtual !== novoLider.nome) {
                    liderAtual = novoLider.nome; // Atualiza o líder atual
                    $(".assumir_lider").attr("src",novoLider.image);
                    $(".quantidade_vidas").text(venda.total);
                    let popUp = $("#popup-primeiro");
                    let fogosBg = $("#fogos-bg");
                    let fogosContainer = $("#fogos-container");
                    fogosBg.removeClass('ocultar').addClass('flex');
                    const somCarro = new Audio('carro_ultrapassagem.mp3');
                    somCarro.play();
                    somCarro.onended = function() {
                        fogosBg.removeClass('aparecer').addClass('ocultar');
                        popUp.fadeIn(300);
                        const somFogos = new Audio('fogos.mp3');
                        somFogos.play();
                        setTimeout(function() {
                            somFogos.pause();
                            somFogos.currentTime = 0;
                            fogosContainer.fadeOut(300); // Esconde os fogos
                            fogosBg.fadeOut(300); // Esconde o fundo preto
                            popUp.fadeOut(300); // Finalmente esconde o card do 1º lugar
                        }, 20000); // Ajuste o tempo de acordo com a duração da animação dos fogos
                    };

                    //verificarTrocaDeLider(novoRanking);
                    //fecharRankingModal();
                    //exibirPopUpComFogos(liderAtual, novoLider.image); // Exibe o pop-up e toca os sons
                } else {
                    console.log(venda.total);
                    //console.log("Apenas Uma Venda");
                    animacaoVenda(venda.nome,venda.image, venda.total);
                }
            }
        }

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
            //animacaoVenda('Rebeca Vaz', '/users/rebeca_vaz_08cbe841.jpg', 10);
            //verificarTrocaDeLider();
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

        function changeActiveButton() {
            footerButtons.removeClass('active');
            footerButtons.eq(activeButtonIndex).addClass('active');

            let corretora = footerButtons.eq(activeButtonIndex).data('corretora');

            if (corretora != "carrossel") {
                $(".carrossel-container").addClass("ocultar");
                $("#principal").addClass("d-flex").addClass('flex-column').addClass('flex-grow').removeClass('ocultar');
                $("#footer-aqui").removeClass("ocultar");

                // Faz a requisição AJAX para atualizar a aba com os dados corretos
                $.ajax({
                    url: '{{ route('ranking.filtragem') }}',
                    type: 'GET',
                    data: { corretora: corretora },
                    success: function (data) {
                        // Atualiza o conteúdo do ranking e os valores do lado direito
                        $(".stage").html(data.podium);
                        $("#dados_direito").html(data.ranking);


                        let total_vidas = parseInt(data.totals[0].total_individual) + parseInt(data.totals[0].total_coletivo) + parseInt(data.totals[0].total_empresarial);
                        let meta = 0;

                        // Define metas específicas por aba

                        switch (corretora) {
                            case 'accert':
                                meta = 236;
                                $("#titulo_ranking").text("Ranking - Accert");
                                break;
                            case 'innove':
                                meta = 236;
                                $("#titulo_ranking").text("Ranking - Innove");
                                break;
                            case 'diario':
                                meta = 13;
                                $("#titulo_ranking").text("Ranking - Diario");
                                break;
                            case 'semanal':
                                meta = 65;
                                $("#titulo_ranking").text("Ranking - Semanal");
                                break;
                            case 'estrela':
                                meta = 150;
                                $("#titulo_ranking").text("Ranking - Estrela");
                                break;
                            case 'concessi':
                                meta = 3629;
                                $("#titulo_ranking").text("Ranking - Concessionária");
                                break;
                            case 'vivaz':
                                meta = 472;
                                $("#titulo_ranking").text("Ranking - Vivaz");
                                break;
                        }

                        let numGroups; // Define numGroups fora do if

                        // Verifica se a corretora é "concessi" para contar os slides específicos
                        if (corretora === "concessi") {
                            console.log("Contando .slide-corretora para concessi");

                            $(".total_concessioanaria_meta").text(data.totals[0].meta_total);
                            $(".total_individual_concessionaria").text(data.totals[0].total_individual);
                            $(".total_super_simples_concessionaria").text(data.totals[0].total_super_simples);

                            $(".total_pme_concessionaria").text(data.totals[0].total_pme);
                            $(".total_adesao_concessionaria").text(data.totals[0].total_adesao);
                            $(".total_vidas_concessionaria").text(data.totals[0].total_vidas);
                            $(".total_porcentagem_concessionaria").text(data.totals[0].porcentagem_geral);

                            numGroups = document.querySelectorAll('.slide-corretora').length;
                            createSlideShowCorretora(numGroups);
                        } else {
                            $(".total_individual").text(data.totals[0].total_individual);
                            $(".total_coletivo").text(data.totals[0].total_coletivo);
                            $(".total_empresarial").text(data.totals[0].total_empresarial);
                            numGroups = document.querySelectorAll('.slide-group').length;
                            createSlideShow(numGroups);
                        }

                        let porcentagem = (total_vidas / meta) * 100;
                        $(".total_vidas").text(total_vidas);
                        $(".total_porcentagem").text(porcentagem.toFixed(2));

                        // Chama a função para criar o slide show com o número correto de grupos


                        // Atualiza o header de acordo com a corretora
                        updateHeader(corretora);

                        // Calcula o tempo de exibição da aba atual (mínimo de 15 segundos por grupo)
                        let abaTime = Math.max(15, numGroups * 15);
                        setTimeout(() => {
                            activeButtonIndex = (activeButtonIndex + 1) % footerButtons.length; // Muda para a próxima aba
                            changeActiveButton(); // Chama a função para mudar para a próxima aba
                        }, abaTime * 1000); // Tempo total da aba em milissegundos
                    }
                });

            } else {
                // Lógica para exibir o carrossel
                $("#principal").removeClass("d-flex").removeClass('flex-column').removeClass('flex-grow').addClass('ocultar');
                $(".carrossel-container").removeClass("ocultar");
                $("#footer-aqui").addClass("ocultar");

                // Reinicia o carrossel e define um tempo fixo de 25 segundos
                currentSlide = 0;
                showSlide(currentSlide);
                setTimeout(() => {
                    // Após 25 segundos, muda para a próxima aba
                    activeButtonIndex = (activeButtonIndex + 1) % footerButtons.length; // Muda para a próxima aba
                    changeActiveButton(); // Chama a função para mudar para a próxima aba
                }, 63000); // 45 segundos para o carrossel
                startCarousel(); // Inicia o carrossel
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
            }

            // Exibe o primeiro grupo de slides
            showSlideGroup(currentGroup);

            // Tempo de exibição de cada grupo (mínimo de 15 segundos)
            let groupTime = Math.max(15, 15);

            setInterval(nextSlideGroup, groupTime * 1000);
        }


        // Função para atualizar o header de acordo com a corretora
        function updateHeader(corretora) {
            // Lógica de atualização de header conforme a corretora
            if (corretora === 'concessi') {
                $("#header_esquerda_concessionaria").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda_estrela").removeClass('aparecer').addClass('ocultar');
            } else if (corretora === 'estrela') {
                $("#header_esquerda_estrela").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda_concessionaria").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda").removeClass('aparecer').addClass('ocultar');
            } else {
                $("#header_esquerda").removeClass('ocultar').addClass('aparecer');
                $("#header_esquerda_concessionaria").removeClass('aparecer').addClass('ocultar');
                $("#header_esquerda_estrela").removeClass('aparecer').addClass('ocultar');
            }
        }

        function showSlide(index) {
            const slideWidth = 100; // Cada slide ocupa 100% da largura
            slidesContainer.css('transform', `translateX(-${index * slideWidth}%)`); // Mover o contêiner dos slides
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

        changeActiveButton(); // Inicia o processo


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
