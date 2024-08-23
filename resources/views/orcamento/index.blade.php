<x-app-layout>
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 flex">
        <x-informacoes :cidades="$cidades"></x-informacoes>
        <x-operadoras :operadoras="$administradoras"></x-operadoras>
        <x-planos :planos="$planos"></x-planos>
        <div class="p-1 rounded mt-2 hidden bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] border" id="resultado" style="width:30%;"></div>
    </div>
</x-app-layout>
