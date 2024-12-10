<x-app-layout>
    <div style="width:95%;margin-left:2%;margin-top: 5px;">
        <ul class="flex border-b">
            <li class="-mb-px mr-1">
                <button id="tab-clt" class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold border-b-2 border-blue-500">
                    CLT
                </button>
            </li>
            <li class="mr-1">
                <button id="tab-parceiro" class="bg-white inline-block py-2 px-4 text-gray-500 hover:text-blue-500 font-semibold">
                    Parceiro
                </button>
            </li>
        </ul>

        <div id="content-clt" class="flex flex-row gap-4">
            <!-- Coluna Esquerda: Lista de Planos -->
            <div class="w-1/6 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] p-1">
                <h2 class="text-lg text-white font-bold mb-4 text-center">Planos</h2>
                <ul>
                    @foreach ($planos as $plano)
                        <li>
                            <button
                                class="block px-4 py-2 mb-2 w-full rounded border-white border-2 text-white text-center load-plan"
                                data-id="{{ $plano->id }}">
                                {{ $plano->nome }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Coluna Direita: Comissões -->
            <div class="w-5/6 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] p-6 text-white" id="comissoes-container">
                <p>Selecione um plano para visualizar as comissões.</p>
            </div>
        </div>

        <div id="content-parceiro" class="hidden w-full">


                <div class="flex w-full flex-row gap-4">
                    <!-- Coluna da Esquerda: Lista de Parceiros -->
                    <div class="p-4 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] w-1/6">
                        <h3 class="font-bold text-lg mb-4 text-center text-white">Parceiros</h3>
                        <ul id="parceiros-list" class="space-y-2">
                            @foreach ($parceiros as $parceiro)
                                <li>
                                    <button
                                        class="parceiro-btn w-full text-center text-white border-2 border-white px-4 py-2 hover:bg-blue-100 rounded"
                                        data-user-id="{{ $parceiro->id }}">
                                        {{ $parceiro->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Coluna da Direita: Comissões -->
                    <div class="w-5/6 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] border p-4">
                        <h3 class="font-bold text-lg mb-4 text-white">Comissões</h3>
                        <div id="comissoes-container-parceiro">
                            <p class="text-white">Selecione um parceiro para visualizar as comissões.</p>
                        </div>
                    </div>
                </div>


        </div>
    </div>













    </div>



    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const parceirosList = document.querySelectorAll('.parceiro-btn');

                parceirosList.forEach(button => {
                    button.addEventListener('click', async () => {
                        const userId = button.getAttribute('data-user-id');

                        try {
                            const response = await fetch("{{ route('comissoes.parceiros') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({ user_id: userId })
                            });

                            if (!response.ok) throw new Error('Erro ao buscar comissões.');

                            const comissoes = await response.json();

                            const container = document.getElementById('comissoes-container-parceiro');
                            container.innerHTML = ''; // Limpa o conteúdo anterior

                            for (const [key, comissoesPlano] of Object.entries(comissoes)) {
                                const [planoNome, administradoraNome] = key.split('-');

                                let title = `Plano: ${planoNome}`;
                                if (administradoraNome) {
                                    title += ` | Administradora: ${administradoraNome}`;
                                }

                                const planoTitulo = document.createElement('h4');
                                planoTitulo.className = 'font-bold text-md mt-4';
                                planoTitulo.innerText = title;
                                container.appendChild(planoTitulo);

                                const table = document.createElement('table');
                                table.className = 'w-full border border-gray-300 mt-2';
                                table.innerHTML = `
                        <thead>
                            <tr class="bg-white">
                                <th class="border border-gray-300 px-4 py-2">Parcela</th>
                                <th class="border border-gray-300 px-4 py-2">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${comissoesPlano.map(comissao => `
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">${comissao.parcela}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <input
                                            type="text"
                                            class="update-comissao w-full border rounded px-2 py-1"
                                            value="${comissao.valor}"
                                            data-id="${comissao.id}">
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    `;
                                container.appendChild(table);
                            }
                        } catch (error) {
                            alert('Erro ao carregar as comissões.');
                            console.error(error);
                        }
                    });
                });

                const tabCLT = document.getElementById('tab-clt');
                const tabParceiro = document.getElementById('tab-parceiro');
                const contentCLT = document.getElementById('content-clt');
                const contentParceiro = document.getElementById('content-parceiro');
                tabCLT.addEventListener('click', () => {
                    tabCLT.classList.add('text-blue-500', 'border-blue-500');
                    tabCLT.classList.remove('text-gray-500');
                    tabParceiro.classList.add('text-gray-500');
                    tabParceiro.classList.remove('text-blue-500', 'border-blue-500');
                    contentCLT.classList.remove('hidden');
                    contentParceiro.classList.add('hidden');
                });
                tabParceiro.addEventListener('click', () => {
                    tabParceiro.classList.add('text-blue-500', 'border-blue-500');
                    tabParceiro.classList.remove('text-gray-500');
                    tabCLT.classList.add('text-gray-500');
                    tabCLT.classList.remove('text-blue-500', 'border-blue-500');
                    contentCLT.classList.add('hidden');
                    contentParceiro.classList.remove('hidden');
                });

                const loadPlanButtons = document.querySelectorAll('.load-plan');
                const comissoesContainer = document.getElementById('comissoes-container');
                loadPlanButtons.forEach(button => {
                    button.addEventListener('click', async function () {
                        const planoId = this.dataset.id;
                        // Exibir um indicador de carregamento (opcional)
                        comissoesContainer.innerHTML = '<p>Carregando...</p>';
                        try {
                            // Fazer a requisição POST
                            const response = await fetch('/comissoes/post', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: JSON.stringify({ plano_id: planoId }),
                            });
                            const data = await response.json();
                            // Atualizar o conteúdo
                            let html = '';
                            data.forEach(grupo => {
                                if (grupo.administradora) {
                                    html += `<h3 class="text-md font-semibold mt-6">Administradora: ${grupo.administradora}</h3>`;
                                }

                                html += `
                                    <div id="comissoes-container">
                <form>
                    <table class="w-full border border-gray-300 mt-4">
                        <thead>
                            <tr class="">
                                <th class="border border-gray-300 px-4 py-2">Parcela</th>
                                <th class="border border-gray-300 px-4 py-2">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                                `;
                                grupo.comissoes.forEach(comissao => {
                                    html += `
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-center">${comissao.parcela}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <input type="text" name="comissoes[${comissao.id}][valor]"
                                           value="${comissao.valor}"
                                           data-id="${comissao.id}"

                                           class="w-full change_valor text-black border rounded px-2 py-1" />
                                </td>
                            </tr>
                        `;
                                });
                                html += `
                                </tbody>
                            </table>

                        </form>
                    `;
                            });
                            comissoesContainer.innerHTML = html;
                        } catch (error) {
                            console.error('Erro ao carregar as comissões:', error);
                            comissoesContainer.innerHTML = '<p>Erro ao carregar as comissões. Tente novamente.</p>';
                        }
                    });
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function(){
               $("body").on('change','.change_valor',function(){
                    let id = $(this).attr('data-id');
                    let valor = $(this).val();
                    $.ajax({
                        url:"{{route('comissoes.update')}}",
                        method:"POST",
                        data: {
                            comissao_id:id,
                            valor:valor
                        },
                        success:function(res) {
                            console.log(res);
                        }
                    })
               });

               $("body").on('change','.update-comissao',function(){
                   let id = $(this).attr('data-id');
                   let valor = $(this).val();

                   $.ajax({
                       url: "{{ route('comissoes.atualizar') }}",
                       method: "POST",
                       headers: {
                           "X-CSRF-TOKEN": "{{ csrf_token() }}"
                       },
                       data: {
                           id,
                           valor
                       },
                       success: function (response) {
                           if (response.success) {
                               alert(response.message);
                           } else {
                               alert("Erro ao atualizar a comissão.");
                           }
                       },
                       error: function (xhr) {
                           alert("Erro ao processar a solicitação.");
                           console.error(xhr.responseJSON);
                       }
                   });
               });







            });
        </script>
    @endsection

</x-app-layout>
