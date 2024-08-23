<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="{{asset('build/assets/jquery.js')}}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="{{asset('build/datatables/dataTables.dataTables.min.css')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="{{asset('build/datatables/dataTables.min.js')}}"></script>

        <style>


            .container_principal {
                background:url({{asset('fred01.jpeg')}}) no-repeat;
                background-position: center center;
                background-size: cover;
                min-height: 100vh;
                display: flex;
                align-items: flex-start;
            }
            .container_formulario {
                background:rgba(254,254,254,0.18);
                backdrop-filter: blur(15px);
            }
            .navbar {
                position:relative;
                background:rgba(254,254,254,0.18);
                top:5px;
                left:5px;
                backdrop-filter: blur(15px);
                border:2px solid rgba(254,254,254,0.5);
                border-radius:15px;
                width:45px;
                padding:10px;
                transition: 0.3s 0s ease-out;
            }
            .profile {
                position:relative;
                width:100%;
                height:100%;
                justify-content:space-between;
                align-items:center;
                display: grid;
                place-content: center;
                padding-bottom: 20px;
                scale: .8;
            }

            .profile::after {
                position:absolute;
                content:'';
                width:100%;
                height:2px;
                background:#fff;
                opacity:0.5;
                left:0;
                bottom: -20px;
            }
            .profile .imgbox {
                position:relative;
                height:42px;
                width:42px;
                border:2px solid #fff;
                border-radius:50%;
                overflow: hidden;
            }
            .imgbox img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .heading {
                color:#fff;
                display:none;
            }
            .heading h3 {
                font-size:1.15em;
                font-weight:500;
            }

            .heading h4{
                opacity:0.5;
                font-size:1em;
                font-weight:400;
            }

            .navbar ul {
                margin-top:40px;
            }
            .navbar ul li {
                list-style: none;
                position:relative;
            }
            .navbar ul li a {
                color:#fff;
                font-size:1.2em;
                font-weight:400;
                display:block;
                height:60px;
                line-height:60px;
                text-decoration:none;
                text-transform: capitalize;
                border-radius:8px;
                transition: .4s .05s ease-out;
                text-align: center;
                padding:0;
            }
            .navbar ul li a span {
                display:none;
            }
            .navbar ul li:hover a {
                color:#333;
                background:#FFF;
                transition: 0s ease-out;
            }
            .navbar ul li a i {
                scale: 1.3;
                display: inline-block;
                margin:0;
            }
            .navbar ul li::before {
                position:absolute;
                content:attr(text-data);
                padding: 8px 12px;
                background:#fff;
                color:#333;
                font-weight:500;
                top: 50%;
                left:50px;
                transform: translateX(10px) translateY(-30%);
                border-radius:8px;
                text-transform:capitalize;
                opacity: 0;
                visibility: hidden;
                z-index: 9999;
            }
            .navbar ul li::after {
                position:absolute;
                content:'';
                border:10px solid #fff;
                border-bottom-color:transparent;
                border-top-color:transparent;
                border-left-color:transparent;
                left:20px;
                top:50%;
                transform: translateX(30px) translateY(-50%);
                opacity: 0;
                visibility: hidden;
            }
            .navbar ul li:hover::before,
            .navbar ul li:hover::after {
                transform: translateX(0px) translateY(-30%);
                opacity: 1;
                visibility: visible;
                transition: 0.15s ease-out;
            }

            main {
                flex: 1; /* O main ocupará o espaço restante */
                margin-left: 5px; /* Espaço entre a navbar e o main */
                /*background: rgba(255, 255, 255, 0.5); !* Ajuste de fundo para melhor visualização *!*/
                /*padding: 1px;*/
                /*border-radius: 15px;*/

            }

        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="container_principal min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <div class="navbar">
                <div class="profile">
                    <div class="imgbox">
                        <img src="{{asset('2vzOt5oxSsZl6X3OiovpxVdW1B5SZFPIjIYeJuy1old.png')}}" alt="User">
                    </div>
                    <div class="heading">
                        <h3 class="title">WebKit Coding</h3>
                        <h4 class="label">Developer</h4>
                    </div>
                </div>

                <ul>
                    <li text-data="dashboard">
                        <a href="#dashboard">
                            <i class="fas fa-home fa-xs"></i>
                            <span>dashboard</span>
                        </a>
                    </li>
                    <li text-data="ranking">
                        <a href="#ranking">
                            <i class="fa-solid fa-ranking-star fa-xs"></i>
                            <span>ranking</span>
                        </a>
                    </li>
                    <li text-data="vendedores">
                        <a href="#">
                            <i class="fas fa-users fa-xs"></i>
                            <span>vendedores</span>
                        </a>
                    </li>
                    <li text-data="orçamento">
                        <a href="{{route('orcamento')}}">
                            <i class="fa-solid fa-file-pdf fa-xs"></i>
                            <span>orçamento</span>
                        </a>
                    </li>

                    <li text-data="estrela">
                        <a href="{{route('estrela.index')}}">
                            <i class="fas fa-star fa-xs"></i>
                            <span>estrela</span>
                        </a>
                    </li>
                    <li text-data="financeiro">
                        <a href="{{route('financeiro.index')}}">
                            <i class="far fa-credit-card fa-xs"></i>
                            <span>financeiro</span>
                        </a>
                    </li>
                    <li text-data="gerente">
                        <a href="#gerente">
                            <i class="fas fa-money-bill-wave-alt fa-xs"></i>
                            <span>gerente</span>
                        </a>
                    </li>

                    <li text-data="configurações">
                        <a href="#configuracoes">
                            <i class="fas fa-cog fa-xs"></i>
                            <span>configurações</span>
                        </a>
                    </li>
                </ul>
            </div>

            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            $(document).ready(function(){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("input[name='operadoras']").on('change',function(){
                   let valor = $(this).val();

                   if($("#resultado").is(":visible")){
                       $("input[name='planos-radio']").prop('checked', false);
                       $("#resultado").hide().empty();
                   }



                    $.ajax({
                        url: '{{route('buscar_planos')}}',  // URL da rota que irá processar a requisição
                        type: 'POST',
                        data: { administradora_id: valor },
                        success: function(response) {
                            // Atualiza a lista de planos com os dados recebidos
                            $('#planos').removeClass('hidden').find('div[data-plano]').each(function() {
                                let planoId = $(this).data('plano');
                                if (response.planos.includes(planoId)) {
                                    $(this).show();  // Mostra o plano
                                } else {
                                    $(this).hide();  // Esconde o plano
                                }
                            });
                        },
                        error: function() {
                            alert('Erro ao buscar os planos. Tente novamente.');
                        }
                    });





                });




                /*****************verificar se cidade e minus estão preenchidos para aparecer administradoras*******/
                function checkFields() {
                    var hasValue = false;
                    // Verifica se algum campo de texto tem valor diferente de vazio ou zero
                    $('input[type="text"]').each(function() {

                        if ($(this).val().trim() !== '' && $(this).val() !== '0') {
                            hasValue = true;
                        }
                    });

                    // Verifica se o select está preenchido
                    var cidadeSelected = $('#cidade').val() !== '';

                    // Se ambas as condições forem verdadeiras, remova a classe 'hidden'
                    if (hasValue && cidadeSelected) {
                        $('#operadoras').removeClass('hidden');
                    } else {
                        $('#operadoras').addClass('hidden');
                    }

                    if($("#planos").is(":visible") && $("#operadoras").is(":visible") && $("#resultado").is(":visible")) {
                        atualizarResultado();
                    }






                }

                $('input[type="text"]').on('input', checkFields);

                // Monitora mudança no select
                $('#cidade').on('change', checkFields);

                /*****************verificar se cidade e minus estão preenchidos para aparecer administradoras*******/




                /***********Incrementar valores aos input*****************************/
                let counterInput = $("input[type='text']");
                let incrementButton = $("button:contains('+')");
                let decrementButton = $("button:contains('-')");
                incrementButton.click(function() {
                    console.log("Olaaaaaaa");
                    let inputField = $(this).siblings("input[type='text']");
                    let currentValue = parseInt(inputField.val()) || 0;
                    if (getTotal() < 8) {
                        inputField.val(currentValue + 1);
                        inputField.trigger('input'); // Dispara o evento 'input' no campo de texto
                    }
                });

                // Adiciona evento de clique para decremento
                decrementButton.click(function() {
                    let inputField = $(this).siblings("input[type='text']");
                    let currentValue = parseInt(inputField.val()) || 0;
                    if (currentValue > 0) {
                        inputField.val(currentValue - 1);
                        inputField.trigger('input'); // Dispara o evento 'input' no campo de texto
                    }
                });


                function getTotal() {
                    let total = 0;
                    $("input[type='text']").each(function() {
                        total += parseInt($(this).val()) || 0;
                    });
                    return total;
                }
                /***********Incrementar valores aos input*****************************/


                function atualizarResultado() {

                    setTimeout(()=>{
                        let cidade = "";
                        let plano = "";
                        let operadora = "";
                        let faixas = [];

                        cidade = $("#cidade").val();
                        plano = $("input[name='planos-radio']:checked").val();
                        operadora = $("input[name='operadoras']:checked").val();

                        faixas = [{

                            '1' : $("body").find("#input_0_18").val(),
                            '2' : $("body").find('#input_19_23').val(),
                            '3' : $("body").find('#input_24_28').val(),
                            '4' : $("body").find('#input_29_33').val(),
                            '5' : $("body").find('#input_34_38').val(),
                            '6' : $("body").find('#input_39_43').val(),
                            '7' : $("body").find('#input_44_48').val(),
                            '8' : $("body").find('#input_49_53').val(),
                            '9' : $("body").find('#input_54_58').val(),
                            '10' : $("body").find('#input_59').val()

                        }];

                        $.ajax({
                            url: "{{ route('orcamento.montarOrcamento') }}",
                            method: "POST",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "tabela_origem": cidade,
                                "plano": plano,
                                "operadora": operadora,
                                "faixas": faixas,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(res) {

                                $("#resultado").removeClass('hidden').slideDown('slow').html(res);
                                // //interacaoContador++;
                                return false;
                            }
                        });


                    },0.1);


                    return false;

                }

                $("body").on('click',"input[name='planos-radio']",function(){
                    let valor = $(this).val();
                    atualizarResultado();
                });


                $("body").on('click',".downloadLink",function(e){
                    e.preventDefault();
                    let linkUrl = $(this).attr("href");

                    let cidade = "";
                    let plano = "";
                    let operadora = "";
                    let faixas = [];
                    let odonto = "";



                    cidade = $("#cidade").val();
                    plano = $("input[name='planos-radio']:checked").val();
                    operadora = $("input[name='operadoras']:checked").val();
                    odonto = $(this).attr('data-odonto');


                    faixas = [{
                        '1' : $("body").find("#input_0_18").val(),
                        '2' : $("body").find('#input_19_23').val(),
                        '3' : $("body").find('#input_24_28').val(),
                        '4' : $("body").find('#input_29_33').val(),
                        '5' : $("body").find('#input_34_38').val(),
                        '6' : $("body").find('#input_39_43').val(),
                        '7' : $("body").find('#input_44_48').val(),
                        '8' : $("body").find('#input_49_53').val(),
                        '9' : $("body").find('#input_54_58').val(),
                        '10' : $("body").find('#input_59').val()
                    }];

                    $.ajax({
                        url: "{{route('gerar.imagem')}}",
                        method: "POST",
                        data: {
                            "tabela_origem": cidade,
                            "plano": plano,
                            "operadora": operadora,
                            "faixas": faixas,
                            "odonto" : odonto,
                            //"cliente" : cliente,
                            //"_token": "{{ csrf_token() }}"
                        },
                        // success:function(res){
                        //     console.log(res);
                        // }
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success:function(blob,status,xhr,ppp) {
                            if(blob.size && blob.size != undefined) {

                                var filename = "";
                                var disposition = xhr.getResponseHeader('Content-Disposition');
                                if (disposition && disposition.indexOf('attachment') !== -1) {
                                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                    var matches = filenameRegex.exec(disposition);
                                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                                }
                                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                    window.navigator.msSaveBlob(blob, filename);
                                } else {
                                    var URL = window.URL || window.webkitURL;
                                    var downloadUrl = URL.createObjectURL(blob);
                                    if (filename) {
                                        var a = document.createElement("a");
                                        if (typeof a.download === 'undefined') {
                                            window.location.href = downloadUrl;
                                        } else {
                                            a.href = downloadUrl;
                                            a.download = filename;
                                            document.body.appendChild(a);
                                            a.click();
                                        }
                                    } else {
                                        window.location.href = downloadUrl;
                                    }
                                    setTimeout(function () {
                                        URL.revokeObjectURL(downloadUrl);
                                    },100);
                                }




                            }
                        }
                    });
                    return false;
                });


                //});
            });
        </script>

    </body>
</html>
