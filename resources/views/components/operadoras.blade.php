<div class="p-1 rounded mt-2 ml-3 mr-3 bg-[rgba(254,254,254,0.18)] backdrop-blur-[15px] border hidden" style="width:22%;min-height:420px;" id="operadoras">
    <button class="py-1.5 w-full px-1 me-2 mb-2 text-sm font-medium text-white bg-white rounded-lg border border-gray-200 bg-gray-500 bg-opacity-10">
        Operadoras
    </button>
    @foreach($operadoras as $op)
        <label class="bg-white w-full container_image_operadora flex flex-wrap justify-between py-1 px-1 me-2 mb-1 text-sm font-medium text-white focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 bg-gray-500 bg-opacity-10 dark:hover:text-gray-900">

            <div class="flex justify-between items-center w-full">
                <div class="flex w-[50%] items-center">
                    <input type="radio" name="operadoras" id="operadoras_{{$op->id}}" value="{{$op->id}}" class="w-4 text-purple-600 bg-gray-100 border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <span class="ml-1 text-sm">{{$op->nome}}</span>
                </div>
                <div class="flex w-[50%] justify-end">
                    <img src="{{$op->logo}}" alt="Opção 1" class="image_operadora" style="width:100px;padding:5px;background-color:white;max-height:44px;border-radius:5px;height:44px;">
                </div>
            </div>
        </label>
    @endforeach
</div>
