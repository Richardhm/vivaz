<div style="display: flex; flex-wrap: wrap; margin: 12px 0 0 0; padding: 0; background: rgba(254, 254, 254, 0.18);backdrop-filter: blur(15px); border-radius: 10px;">
    @foreach($ranking as $i => $r)
        @if ($i % 14 === 0)
            <!-- Início de um novo grupo de 14 itens -->
            <div class="slide-group" style="width: 100%; margin: 0; padding: 0; display: {{ $i === 0 ? 'flex' : 'none' }}; flex-wrap: wrap;">
                @endif

                @if ($i % 7 === 0)
                    <!-- Início de uma nova coluna a cada 7 itens -->
                    <div class="slid" style="flex-basis: 50%; padding: 5px; box-sizing: border-box;">
                        @endif

                        <!-- Cada item -->
                        <div style="margin-bottom: 5px; color: white;">
                            <div class="d-flex border text-white rounded align-items-center p-2" style="background-color: #2e4a7a;">
                                <!-- 1ª Div: Posição -->
                                <div class="text-center text-white rounded me-2"
                                     style="width:40px;height:100%;display:flex;align-items:center;justify-content:center;padding:5px 10px;font-size:1em;font-weight:bold;background:rgba(254, 254, 254, 0.18);backdrop-filter:blur(15px);">
                                    {{$loop->iteration}}°
                                </div>

                                <!-- 2ª Div: Imagem -->
                                <div class="me-2" style="flex:0 1 auto;display:flex;align-items:center;margin-left:8px;background-color: #FFF;">
                                    <img src="{{ asset($r->imagem) }}" class="rounded" style="height:60px;width:60px;border-radius:50%;">
                                </div>

                                <!-- 3ª Div: Nome e descrição -->
                                <div class="flex-grow-1">
                                    @php
                                        $nome_corretor = implode(' ', array_slice(explode(' ', $r->corretor), 0, 2)); // Limita a 2 palavras
                                    @endphp
                                    <p class="fw-bold mb-0" style="font-size: 1.2em; color: #ffdd57;">{{$nome_corretor}}</p>
                                    <div class="d-flex">
                                        <div class="d-flex flex-column" style="margin-right:8px;">
                                            <span class="d-flex justify-content-between">Jul: 0</span>
                                            <span class="d-flex justify-content-between">Ago: 0</span>
                                            <span class="d-flex justify-content-between">Set: 0</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="d-flex justify-content-between">Out: 0</span>
                                            <span class="d-flex justify-content-between">Nov: 0</span>
                                            <span class="d-flex justify-content-between">Dez: 0</span>
                                        </div>
                                    </div>

                                </div>

                                <div style="display:flex;flex-direction:column;justify-content:center;">
                                    <span class="text-center">{{$r->quantidade_vidas}}</span>
                                    <span>Vidas</span>
                                </div>

                            </div>
                        </div>

                        @if ($i % 7 === 6 || $loop->last)
                            <!-- Fecha a div da coluna após 7 itens -->
                    </div>
                @endif

                @if (($i + 1) % 14 === 0 || $loop->last)
                    <!-- Fecha a div do grupo após 14 itens -->
            </div>
        @endif
    @endforeach
</div>
