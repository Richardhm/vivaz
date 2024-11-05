<main id="aba_odonto" class="hidden">

    <section class="flex justify-between flex-wrap content-start">
        <!--COLUNA DA ESQUERDA-->
        <div class="flex flex-col text-white basis-[16%] rounded-lg">
            <div class="flex mb-1 justify-between">
                <span class="bg-[rgba(254,254,254,0.18)] create_odonto hover:cursor-pointer backdrop-blur-[15px] text-white text-sm py-2 text-center rounded w-full">
                    <a class="text-center text-white">Cadastrar</a>
                </span>
            </div>
            <select class="flex w-full py-2 text-lg bg-[rgba(254,254,254,0.18)] focus:outline-none text-white active:outline-none active:bg-[rgba(254,254,254,0.18)] hover:bg-gray-800 py-2 text-center focus:bg-gray-800 w-full text-xs px-1 me-2 mb-1 text-sm font-medium text-black rounded-lg hover:border-transparent focus:border-transparent border-transparent" id="select_usuario_odonto">
                <option value="todos" class="text-center">---Escolher Corretor---</option>
            </select>
        </div>
        <!--FIM COLUNA DA ESQUERDA-->

        <!--COLUNA DA CENTRAL-->
        <div class="basis-[83%]">
            <div class="bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] text-white rounded-lg p-1">
                <table id="tabela_odonto" class="table-auto table-sm listardadosodonto w-full">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Corretor</th>

                        <th>Valor</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--FIM COLUNA CENTRAL-->
    </section>

</main>

