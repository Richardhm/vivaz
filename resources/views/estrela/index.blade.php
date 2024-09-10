<x-app-layout>
    <section class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] rounded" style="width:95%;margin: 20px auto;padding:10px 20px;">
        <div class="flex w-full mx-auto flex-col">

            {{--Coluna 01--}}
            <div class="flex justify-between items-center">
                <div class="flex flex-col text-center text-white" style="font-size: 1.5em;line-height: 1em;font-style: italic;">
                    <span class="font-italic">Ranking</span>
                    <span>de
                        <span style="color:#ffc107;">Vendas</span>
                    </span>
                </div>
                <div class="flex flex-col text-white text-center" style="line-height: 1.6em;">
                    <span style="font-size:2em;font-weight:bold;">{{$ano_atual}}</span>
                    <span>{{$semestre}}º Semestre</span>
                </div>
                <div>
                    <span class="text-white w-100 d-block font-italic text-center" style="font-size:1.2em;font-style: italic;">Programa Estrela</span>
                    <div class="flex items-center justify-between" style="border:1px solid #FFF;border-radius:5px;margin-bottom:10px;line-height: 1.1em;">
                        <svg class="w-10 h-10 text-gray-800 text-white hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"/>
                            <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd"/>
                            <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z"/>
                        </svg>
                        <span class="flex flex-col flex-wrap text-white">
                            <span style="color:#ffc107;margin-bottom:0;padding-bottom:0;">Melhores</span>
                            <span style="display:flex;">VENDEDORES</span>
                        </span>
                    </div>
                </div>
            </div>
            {{--Fim Coluna 01--}}

            {{--Coluna 02--}}
            <div class="content_table w-full">
                <table class="table w-full table-borderless">
                    <thead style="position: sticky; top: 0;">
                    <tr>
                        <th style="width:3%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:10px;text-align:center;">
                                #
                            </div>
                        </th>
                        <th style="width:20%;">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:10px;text-align:left;">
                                VENDEDORES
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                JUL<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                AGO<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                SET<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                OUT<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                NOV<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                DEZ<br />25 Vidas
                            </div>
                        </th>
                        <th style="width:5.6%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:center;">
                                TOTAL<br />150 Vidas
                            </div>
                        </th>
                        <th style="width:4%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:10px;text-align:center;">
                                %
                            </div>
                        </th>
                        <th style="width:5%">
                            <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:10px;text-align:center;">
                                FALTAM
                            </div>
                        </th>
                        <th style="width:20%">
                            <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:10px;text-align:center;">
                                STATUS
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ranking as $r)
                        @if($r->quantidade != 0)
                            <tr>
                                <td style="width:3%">{{$loop->iteration}}°</td>
                                <td style="width:20%;">
                                    <div style="background-color:white;border-radius:8px;width:96%;color:black;padding:3px;text-align:left;">
                                        {{$r->usuario}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->julho}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->agosto}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->setembro}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->outubro}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->novembro}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->dezembro}}
                                    </div>
                                </td>
                                <td style="width:5.6%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->quantidade}}
                                    </div>
                                </td>
                                <td style="width:4%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:6px;font-size:0.7em;">
                                        @if($r->status == "nao_classificado")
                                            {{number_format(($r->quantidade / 150) * 100,2)}}
                                        @elseif($r->status == "tres_estrelas")
                                            {{number_format((($r->quantidade - 150) / (190 - 150)) * 100, 2)}}
                                        @elseif($r->status == "quatro_estrelas")
                                            {{number_format((($r->quantidade - 191) / (250 - 191)) * 100, 2)}}
                                        @else
                                            100
                                        @endif
                                    </div>
                                </td>
                                <td style="width:4%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        {{$r->falta}}
                                    </div>
                                </td>
                                <td style="width:20%">
                                    <div style="background-color:white;border-radius:8px;width:90%;color:black;padding:3px;">
                                        @if($r->status == "nao_classificado")
                                            Não Classificado
                                        @elseif($r->status == "tres_estrelas")
                                            <div class="d-flex">
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                            </div>

                                        @elseif($r->status == "quatro_estrelas")
                                            <div class="d-flex">
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                            </div>
                                        @else
                                            <div class="d-flex">
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                                <i class="fas fa-star fa-xs"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--Fim Coluna 02--}}

            {{--Coluna 03--}}
            <div class="flex w-100 py-2 items-center">
                <div class="flex justify-between" style="width:50%;">

                    <div class="flex flex-col text-white text-center" style="line-height:1;font-size:0.785em;">
                        <span>3 Estrelas</span>
                        <span>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                        </span>
                        <span>
                            150 a 190 vidas
                        </span>
                    </div>

                    <div class="flex flex-col text-white text-center" style="line-height:1;font-size:0.785em;">
                        <span>4 Estrelas</span>
                        <span>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                        </span>
                        <span>191 a 250 vidas</span>
                    </div>

                    <div class="flex flex-col text-white text-center" style="line-height:1;font-size:0.785em;">
                        <span>5 Estrelas</span>
                        <span>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                            <i class="fas fa-star fa-xs"></i>
                        </span>
                        <span>Apartir de 251 vidas</span>
                    </div>


                </div>


                <div class="flex align-center justify-end" style="width:50%;line-height:1;font-size:0.785em;">
                    <div>
                        <div>
                            <img src="{{asset('logo-hapvida-NotreDame-Intermedica.png')}}" alt="Hapvida" style="width:200px;background-color:white;padding:10px;border-radius:5px;">
                        </div>
                    </div>
                </div>

            </div>
        </div>

            {{--Fim Coluna 03--}}





        </div>
    </section>


    <style>
        table {
            border-collapse: separate;
        }
        .table th, .table td {
            padding:0 !important;
        }


        table tr th {
            font-size:0.7em;
            text-align: center;
            color:#FFF;
        }

        table tbody tr td {
            font-size:0.85em;
            text-align: center;
            color:#FFF;
        }




        .content_table {
            background-color: rgba(255, 193, 7, 0.5);
            border-radius:10px;height:595px;min-height: 595px;overflow:auto;
            backdrop-filter: blur(30px);



        }

        /* Estilo da barra de rolagem */
        .content_table::-webkit-scrollbar {
            width: 10px; /* Largura da barra de rolagem */
        }

        /* Estilo da "trilha" da barra de rolagem */
        .content_table::-webkit-scrollbar-track {
            background: #f1f1f1; /* Cor de fundo da trilha */
            border-radius: 5px; /* Raio das bordas da trilha */
        }

        /* Estilo do "polegar" da barra de rolagem */
        .content_table::-webkit-scrollbar-thumb {
            background: #0c525d; /* Cor do polegar da barra de rolagem */
            border-radius: 5px; /* Raio das bordas do polegar */
        }

        /* Estilo do "polegar" da barra de rolagem quando o mouse passa por cima */
        .content_table::-webkit-scrollbar-thumb:hover {
            background: #555; /* Cor do polegar da barra de rolagem ao passar o mouse */
        }


    </style>

</x-app-layout>
