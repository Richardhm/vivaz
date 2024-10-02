<x-app-layout>
    <div class="flex w-full justify-end">
        <button id="openModalButton" class="open-modal-btn">Abrir Ranking Diário</button>
    </div>

    <script>
        var ranking = "{{ route('ranking.atualizar') }}";
    </script>

    <h2 class="text-2xl font-bold text-center my-6">Ranking Diário de Vendas</h2>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">Posição</th>
                <th scope="col" class="py-3 px-6">Corretor</th>
                <th scope="col" class="py-3 px-6">Vidas Individual</th>
                <th scope="col" class="py-3 px-6">Vidas Coletivo</th>
                <th scope="col" class="py-3 px-6">Vidas Empresarial</th>
                <th scope="col" class="py-3 px-6">Total Vidas</th>
            </tr>
            </thead>
            <tbody>
            @php
                $ii=1;
            @endphp
            @foreach($vendasDiarias as $key => $venda)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $ii++ }}
                    </td>
                    <td class="py-4 px-6">{{ $venda->nome }}</td>
                    <td class="py-4 px-6">{{ $venda->vidas_individual }}</td>
                    <td class="py-4 px-6">{{ $venda->vidas_coletivo }}</td>
                    <td class="py-4 px-6">{{ $venda->vidas_empresarial }}</td>
                    <td class="py-4 px-6 font-bold">
                        {{ $venda->vidas_individual + $venda->vidas_coletivo + $venda->vidas_empresarial }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <x-modal-ranking :vendasDiarias="$vendasDiarias"></x-modal-ranking>
    <div id="popup-primeiro" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="relative bg-white p-8 rounded-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Parabéns!</h2>
            <p class="text-xl font-medium text-gray-600 flex justify-center flex-wrap">
                <img src="" alt="" id="imagem-primeiro" style="width:200px;height:200px;border-radius:50%;">
                <p class="w-full">O corretor <span id="nome-primeiro"></span> assumiu o 1º lugar!</p>
            </p>
        </div>
    </div>
    <!-- Fundo preto para a animação do carro -->
    <div id="carro-bg" class="fixed inset-0 bg-black opacity-90 hidden"></div>
    <!-- Contêiner do carro -->
    <div id="carro-container" class="fixed bottom-10 left-full hidden">
        <img src="{{ asset('carro.gif') }}" alt="Carro" class="w-48 h-auto object-contain" />
        <span id="nome-primeiro-carro" class="absolute text-white font-bold text-xl"></span>
    </div>
    <script src="{{asset('js/ranking.js')}}"></script>
    @section('css')
        <style>
            @keyframes carro-primeira-passagem {
                0% {
                    left: 100%;  /* Começa fora da tela */
                }
                40% {
                    left: 60%; /* Movimento lento até 60% da tela */
                }
                80% {
                    left: 30%; /* Acelera um pouco mais */
                }
                100% {
                    left: -20%; /* Sai da tela */
                }
            }

            @keyframes carro-segunda-passagem {
                0% {
                    left: 100%;
                }
                100% {
                    left: -50%; /* Passa rápido, sai à esquerda */
                }
            }

            #carro-container {
                position: fixed;
                bottom: 40%;
                width: 200px;
                height: auto;
                z-index: 52; /* Aumente o z-index para que o carro fique na frente */
            }

            #carro-bg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: black;
                z-index: 51; /* Fundo preto fica atrás do carro */
                opacity: 0.9;
                display: none;
            }


            @keyframes firework {
                0% { transform: scale(0); opacity: 1; }
                100% { transform: scale(1.5); opacity: 0; }
            }

            #popup-primeiro {
                background: url({{ asset('fogos2.gif') }}) center center no-repeat, rgba(0, 0, 0, 0.5);
                background-size: cover;
                z-index: 50; /* Certifica-se de que o modal fica acima de outros elementos */
                justify-content: center;
                align-items: center;
                position: fixed;
                inset: 0;
            }

            #popup-primeiro .relative {
                z-index: 100; /* Certifique-se de que o conteúdo do modal fica acima do fundo */
                background-color: white;
                padding: 2rem;
                border-radius: 0.5rem;
            }

            .modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Fundo escuro transparente */
                display: flex;
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Centraliza verticalmente */
                z-index: 9999;
            }

            /* Esconder a modal por padrão */
            .hidden {
                display: none;
            }

            /* Conteúdo da modal */
            .modal-content {
                background-color: white; /* Fundo branco */
                padding: 20px;
                border-radius: 10px;
                width: 100%; /* Tamanho da modal */
                max-width: 1000px;
                max-height: 80vh; /* Altura máxima da modal */
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Sombra ao redor */
                position: relative; /* Para o botão de fechar */
                overflow: hidden; /* Evita que a modal cresça além da altura */
            }

            /* Botão de fechar */
            .close-button {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 24px;
                cursor: pointer;
                color: #333;
            }

            .close-button:hover {
                color: red;
            }

            /* Estilo da lista de corretores */
            .corretores-list {
                max-height: 300px; /* Define uma altura fixa para a lista de corretores */
                overflow-y: auto; /* Habilita o scroll vertical */
                margin-top: 20px;
            }

            /* Estilos para o botão de abrir modal */
            .open-modal-btn {
                padding: 10px 20px;
                background-color: #2e4a7a;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .open-modal-btn:hover {
                background-color: #00CED1;
            }

            /* Personalização do scrollbar */
            .corretores-list::-webkit-scrollbar {
                width: 8px;
            }

            .corretores-list::-webkit-scrollbar-thumb {
                background-color: #00CED1; /* Cor do scrollbar */
                border-radius: 5px;
            }

            .corretores-list::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
        </style>
    @endsection

</x-app-layout>
