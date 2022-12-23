<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Veículo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            {{ __('Selecione o tipo de veículo:') }}
                        </label>
                        <div class="flex items-center space-x-2">
                            @foreach($typeVehicles as $typeVehicle)
                                <input class="" type="radio" value="{{$typeVehicle->id}}"
                                       id={{ $typeVehicle->slug }} name="typeVehicle" {{ old('typeVehicle') == $typeVehicle->id ? 'checked' : '' }}>
                                <label for={{ $typeVehicle->slug }}>{{ $typeVehicle->name }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="grid gap-4 grid-cols-2">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700" for="placa">
                                {{ __('Placa') }}
                            </label>
                            <input id="placa"
                                   class="border-gray-300 uppercase focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                   type="text" name="placa" value="{{ old('placa') }}">
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700" for="cor">
                                {{ __('Cor') }}
                            </label>
                            <input id="cor"
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                   type="text" name="cor" value="{{ old('cor') }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="label-marca block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Marca') }}
                        </label>
                        <select
                            id="marca"
                            name="marca"
                            class="border-gray-300 focus:border-indigo-500 disabled:opacity-25 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled>
                            <option value="">{{ __('Selecione uma marca') }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="label-modelo block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Modelo') }}
                        </label>
                        <select
                            id="modelo"
                            name="modelo"
                            class="border-gray-300 focus:border-indigo-500 disabled:opacity-25 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled>
                            <option value="">{{ __('Selecione um modelo') }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="label-ano block font-medium text-sm text-gray-700" for="marca">
                            {{ __('Ano') }}
                        </label>
                        <select
                            id="ano"
                            name="ano"
                            class="border-gray-300 focus:border-indigo-500 disabled:opacity-25 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            disabled>
                            <option value="">{{ __('Selecione o ano') }}</option>
                        </select>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex justify-between items-center">
                        <a class="flex items-center justify-center px-4 py-2  uppercase font-semibold text-xs border-2 border-gray-800 hover:bg-gray-800 hover:text-gray-100 p-3 rounded-lg transition delay-50 duration-150 ease-in-out" href="{{ route('dashboard') }}"><i class="fa-solid fa-arrow-left mr-2"></i> {{ __('Voltar') }}</a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Adicionar veículo') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    option:empty {
        display: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {

        $('input[type="radio"][name=typeVehicle]').change(function () {

            var typeVehicle = $('input[name=typeVehicle]:checked').val();

            $('#marca').empty().append('<option value="">Selecione uma marca</option>');
            $('#modelo').empty().append('<option value="">Selecione um modelo</option>');
            $('#ano').empty().append('<option value="">Selecione o ano</option>');

            document.querySelector("#marca").setAttribute("disabled", 'true');
            document.querySelector("#modelo").setAttribute("disabled", 'true');
            document.querySelector("#ano").setAttribute("disabled", 'true');

            $(".label-marca").append('<i class="fa-solid fa-sync fa-spin" style="--fa-animation-duration: .5s;"></i>');

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
                    $('.fa-spin').remove();
                }
            });
        });

        $('select[name=marca]').change(function () {
            var typeVehicle = $('input[name=typeVehicle]:checked').val();

            $(".label-modelo").append('<i class="fa-solid fa-sync fa-spin" style="--fa-animation-duration: .5s;"></i>');

            $.ajax({
                url: "{{ url('vehicles/getModelos') }}/" + typeVehicle + "/" + this.value,
                method: "get",
                datatype: "json",
                success: function (response) {
                    var modelos = response.modelos;
                    modelos.map((modelo) => {
                        var options = `<option value="${modelo.codigo}">${modelo.nome}<option>`;
                        $("#modelo").append(options);
                    });
                    document.querySelector("#modelo").removeAttribute("disabled");
                    $('.fa-spin').remove();
                }
            });
        });

        $('select[name=modelo]').change(function () {

            var typeVehicle = $('input[name=typeVehicle]:checked').val();
            var marca = $('select[name=marca]').val();

            $(".label-ano").append('<i class="fa-solid fa-sync fa-spin" style="--fa-animation-duration: .5s;"></i>');

            $.ajax({
                url: "{{ url('vehicles/getAno') }}/" + typeVehicle + "/" + marca + "/" + this.value,
                method: "get",
                datatype: "json",
                success: function (response) {
                    response.map((ano) => {
                        var options = `<option  value="${ano.codigo}">${ano.nome}<option>`;
                        $("#ano").append(options);
                    });
                    document.querySelector("#ano").removeAttribute("disabled");
                    $('.fa-spin').remove();
                }
            });
        });

    });
</script>
