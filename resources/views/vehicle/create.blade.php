<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Veículo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('vehicles.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            {{ __('Selecione o tipo de veículo:') }}
                        </label>
                        <div class="flex items-center space-x-2">
                            @foreach($typeVehicles as $typeVehicle)
                                <input class="" type="radio" value="{{$typeVehicle->id}}"
                                       id={{ $typeVehicle->slug }} name="typeVehicle">
                                <label for={{ $typeVehicle->slug }}>{{ $typeVehicle->name }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="placa">
                            {{ __('Placa') }}
                        </label>
                        <input id="placa" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" name="placa">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Marca') }}
                        </label>
                        <select
                            id="marca"
                            name="marca"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled
                            required>
                                <option  value="">{{ __('Selecione uma marca') }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Modelo') }}
                        </label>
                        <select
                            id="modelo"
                            name="modelo"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled>
                                <option  value="">{{ __('Selecione um modelo') }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Ano') }}
                        </label>
                        <select
                            id="ano"
                            name="ano"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled>
                                <option  value="">{{ __('Selecione o ano') }}</option>
                        </select>
                    </div>
                    <div class="flex justify-end items-center">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Adicionar veiculo') }}
                        </button>
                    </div>
                </form>
                <div class="text-gray-900 p-6">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    option:empty{display:none;}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="radio"][name=typeVehicle]').change(function () {

            var typeVehicle = $('input[name=typeVehicle]').val();

            $.ajax({
                url: "{{ url('vehicles/getMarcas') }}/" + typeVehicle,
                method: "get",
                datatype: "json",
                success: function (response) {
                    response.map((marca) => {
                        var options = `<option  value="${marca.codigo}">${marca.nome}<option>`;
                        $("#marca").append(options);
                    });
                    document.querySelector("#marca").removeAttribute("disabled");
                }
            });
        });

        $('select[name=marca]').change(function () {
            var typeVehicle = $('input[name=typeVehicle]').val();

            $.ajax({
                url: "{{ url('vehicles/getModelos') }}/" + typeVehicle + "/" + this.value,
                method: "get",
                datatype: "json",
                success: function (response) {
                    var modelos = response.modelos;
                    modelos.map((modelo) => {
                        var options = `<option  value="${modelo.codigo}">${modelo.nome}<option>`;
                        $("#modelo").append(options);
                    });
                    document.querySelector("#modelo").removeAttribute("disabled");
                }
            });
        });

        $('select[name=modelo]').change(function () {
            var typeVehicle = $('input[name=typeVehicle]').val();
            var marca = $('select[name=marca]').val();
            $.ajax({
                url: "{{ url('vehicles/getAno') }}/" + typeVehicle + "/" + marca + "/" + this.value,
                method: "get",
                datatype: "json",
                success: function (response) {
                    console.log(response)
                    response.map((ano) => {
                        var options = `<option  value="${ano.codigo}">${ano.nome}<option>`;
                        $("#ano").append(options);
                    });
                    document.querySelector("#ano").removeAttribute("disabled");
                }
            });
        });
    });
</script>
