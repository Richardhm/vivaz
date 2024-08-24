<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('folder_vivaz04.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: top left;
            image-rendering: optimizeQuality;
            position: relative;
        }
        .container {
            position: absolute;
            top: 380px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
        }

        .tabela-container {
            max-height: calc(100vh - 600px);
            overflow-y: auto;
        }

        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: separate;
            border-spacing: 5px 5px;
        }

        td, th {
            padding: 5px;
            text-align: center;
            text-transform: capitalize;

        }


        th {
            background-color: rgb(5,53,95);
            color: white;
        }

        tfoot td {
            font-weight: bold;
            background-color: rgb(5,53,95);
            color: white;
        }

        tbody .tbody_com_copart {
            background-color:#366EBF;
            color:#FFF;
        }

        tbody .tbody_sem_copart {
            background-color:#F88058;
            color:#FFF;
        }

        tbody .tbody_faixa_etaria,
        thead .title {
            background-color: rgb(5,53,95);
            color: white;
        }
        thead .title {
            text-transform: capitalize;
        }

        .lembretes {
            margin-top: 3px;
            padding: 0;
            text-align: left;

        }

        .lembretes p {
            margin: 2px 0;
            color:rgb(19,82,135);
            font-size: 0.8em;
        }

        /* Novos estilos */
        .faixa-etaria {
            text-align: center;
            font-size: 0.875em;
            background-color: rgb(5,53,95);
            color:#FFF;
        }

        .apart-enfer {
            text-align: center;
            font-size: 0.875em;
            color: rgb(5,53,95);
        }

        .apart {
            background-color: rgb(5,53,95);
            color:white;
        }

        .copart-parcial {
            background-color: rgb(255,89,33);
            color:white;
        }

        #valores_coparticipacao h3 {
            margin: 15px 0 10px 0;
            width: 100%;
            color:rgb(19,82,135);

        }

        #valores_coparticipacao > div {
            float:left;

        }

        #valores_coparticipacao .section-title {
            background-color: rgb(19,82,135);
            font-size: 0.8em;
            color: #FFF;
            margin: 0;
            padding: 10px;
        }

        #valores_coparticipacao .section-content {
            background-color: rgb(230,231,233);
            margin: 0;
            padding: 0;
        }

        #valores_coparticipacao .section-content p {
            color: rgb(19,82,135);
            font-size: 0.8em;
            margin: 0 0 5px 0;
            padding: 0;
        }

        /* Estilos do footer */
        .footer {
            position: absolute;
            bottom: 20px;
            width: calc(100% - 40px); /* Ajusta a largura do footer */
            height: 310px; /* Define a altura do footer */
            padding: 10px;
            box-sizing: border-box;
        }

        .footer img {
            position: absolute;
            bottom: 3px;
            left: 20px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .footer .middle, .footer .right {
            position: absolute;
            bottom: 10px;
            color: white;
        }

        .footer .middle {
            bottom:10px;
            left: 400px;
        }

        .footer .middle p {
            margin: 0;
            color:#FFFFFF;
            font-weight: bold;
        }

        .footer .right {
            right: 30px;
            text-align: left;
        }

        .footer .right p {
            margin: 0;
            color:#FFFFFF;
            font-weight: bold;
        }

        .cidade_container {
            position:absolute;
            top:210px;
            left:42%;
            font-weight: bold;
            font-size: 1.7em;
            color:#366EBF;
        }

        .frase_container {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -1263%);
            text-align: center;
            font-weight: bold;
            font-size: 1.5em;
            color: white;
        }

    </style>
</head>
<body>
<p class="cidade_container">{{$cidade}}</p>
<p class="frase_container">{{$frase}}</p>
<div class="container">




    <div class="tabela-container">
        <table>
            <thead>
            <tr>
                <td class="text-center title">{{$administradora}}</td>
                <td colspan="2" class="apart">Com Coparticipação</td>
                <td colspan="2" class="copart-parcial">Coparticipação Parcial</td>
            </tr>
            <tr>
                <td class="faixa-etaria">Faixa Etária</td>
                <td class="apart-enfer apart">Apart</td>
                <td class="apart-enfer apart">Enfer</td>
                <td class="apart-enfer copart-parcial">Apart</td>
                <td class="apart-enfer copart-parcial">Enfer</td>
            </tr>
            </thead>
            <tbody>
            @php
                $dadosComOdontoComCopar = [];
                $dadosComOdontoSemCopar = [];
                $totalApartamento_com_copar = 0;
                $totalEnfermaria_com_copar = 0;
                $totalApartamento_sem_copar = 0;
                $totalEnfermaria_sem_copar = 0;
            @endphp

            @foreach($dados as $dado)
                @php
                    $faixaEtaria = $dado->faixaEtaria->nome;
                    $acomodacao = $dado->acomodacao_id;
                    $valor = $dado->valor;
                    $odonto = $dado->odonto;
                    $coparticipacao = $dado->coparticipacao;
                    $quantidade = $dado->quantidade;

                    //if($odonto == 1) {
                        // Verifica se tem coparticipação
                        $index = ($coparticipacao == 1) ? 'com_copar' : 'sem_copar';

                        if (!isset($dadosComOdonto[$faixaEtaria])) {
                            $dadosComOdonto[$faixaEtaria] = [
                                'faixa_etaria_id' => $faixaEtaria,
                                'apartamento_com_copar' => 0,
                                'enfermaria_com_copar' => 0,
                                'apartamento_sem_copar' => 0,
                                'enfermaria_sem_copar' => 0,
                                'quantidade' => $quantidade
                            ];
                        }
                        $dadosComOdonto[$faixaEtaria]["{$acomodacao}_{$index}"] = $valor ?? 0;
                    //}
                @endphp
            @endforeach


            @foreach($dadosComOdonto as $faixaEtaria => $valores)
                @for($i=0;$i<$valores['quantidade'];$i++)
                    <tr>
                        <td class="tbody_faixa_etaria">{{ $faixaEtaria }}</td>
                        <td class="tbody_com_copart">
                            {{ number_format($valores['1_com_copar'], 2, ",", ".") }}
                            @php
                                $totalApartamento_com_copar += $valores['1_com_copar'];
                            @endphp
                        </td>
                        <td class="tbody_com_copart">
                            {{ number_format($valores['2_com_copar'], 2, ",", ".") }}
                            @php
                                $totalEnfermaria_com_copar += $valores['2_com_copar'];
                            @endphp
                        </td>
                        <td class="tbody_sem_copart">
                            {{ number_format($valores['1_sem_copar'], 2, ",", ".") }}
                            @php
                                $totalApartamento_sem_copar += $valores['1_sem_copar'];
                            @endphp
                        </td>
                        <td class="tbody_sem_copart">
                            {{ number_format($valores['2_sem_copar'], 2, ",", ".") }}
                            @php
                                $totalEnfermaria_sem_copar += $valores['2_sem_copar'];
                            @endphp
                        </td>
                    </tr>
                @endfor
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <td>Total</td>
                <td>{{number_format($totalApartamento_com_copar,2,",",".")}}</td>
                <td>{{number_format($totalEnfermaria_com_copar,2,",",".")}}</td>
                <td>{{number_format($totalApartamento_sem_copar,2,",",".")}}</td>
                <td>{{number_format($totalEnfermaria_sem_copar,2,",",".")}}</td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div class="lembretes">
        <p>{{$pdf->linha01 ?? ''}}</p>
        <p>{{$pdf->linha02 ?? ''}}</p>
        <p>{{$pdf->linha03 ?? ''}}</p>
    </div>

    <div id="valores_coparticipacao">
        <h3>Coparticipação:</h3>
        <div>
            <p class="section-title" style="width:210px;">Procedimentos</p>
            <div class="section-content" style="width:225px;padding-left:5px;">
                @if($pdf->consultas_eletivas_total || $pdf->consultas_eletivas_parcial)
                    <p>Consultas Eletivas</p>
                @endif

                @if($pdf->consultas_de_urgencia_total || $pdf->consultas_de_urgencia_parcial)
                    <p>Consultas de Urgência</p>
                @endif

                @if($pdf->exames_simples_total || $pdf->exames_simples_parcial)
                    <p>Exames Simples</p>
                @endif

                @if($pdf->exames_complexos_total || $pdf->exames_complexos_parcial)
                    <p>Exames Complexos</p>
                @endif

                @if($pdf->terapias_especiais_total || $pdf->terapias_especiais_parcial)
                    <p>Terapias Especiais</p>
                @endif

                @if($pdf->demais_terapias_total || $pdf->demais_terapias_parcial)
                    <p>Demais Terapias</p>
                @endif

                @if($pdf->internacoes_total || $pdf->internacoes_parcial)
                    <p>Internações</p>
                @endif

                @if($pdf->internacoes_total || $pdf->internacoes_parcial)
                    <p>Cirurgia</p>
                @endif
            </div>
        </div>

        <div style="margin:0 0.2%;">
            <p class="section-title" style="width:115px;">Copart Total</p>
            <div class="section-content" style="width:130px;padding-left:5px;">
                <p>{{$pdf->consultas_eletivas_total ?? ''}}</p>
                <p>{{$pdf->consultas_de_urgencia_total ?? ''}}</p>
                <p>{{$pdf->exames_simples_total ?? ''}}</p>
                <p>{{$pdf->exames_complexos_total ?? ''}}</p>
                <p>{{$pdf->terapias_especiais_total ?? ''}}</p>
                <p>{{$pdf->demais_terapias_total ?? ''}}</p>
                <p>{{$pdf->internacoes_total ?? ''}}</p>
                <p>{{$pdf->cirurgia_total ?? ''}}</p>
            </div>
        </div>

        <div>
            <p class="section-title" style="width:115px;">Copart Parcial</p>
            <div class="section-content" style="width:131px;padding-left:5px;">
                <p>{{$pdf->consultas_eletivas_parcial ?? ''}}</p>
                <p>{{$pdf->consultas_de_urgencia_parcial ?? ''}}</p>
                <p>{{$pdf->exames_simples_parcial ?? ''}}</p>
                <p>{{$pdf->exames_complexos_parcial ?? ''}}</p>
                <p>{{$pdf->terapias_especiais_parcial ?? ''}}</p>
                <p>{{$pdf->demais_terapias_parcial ?? ''}}</p>
                <p>{{$pdf->internacoes_parcial ?? ''}}</p>
                <p>{{$pdf->cirurgia_parcial ?? ''}}</p>
            </div>
        </div>
    </div>



</div>


<div class="footer">
    <img src="{{ $image }}" alt="User Image">

    <div class="middle">
        <p>{{$nome}}</p>
        <p>Consultor de Vendas</p>
        <p>5645425</p>
    </div>

    <div class="right">
        <p>
        </p>

        </p>
        <p>

        </p>
    </div>
</div>



</body>
</html>

