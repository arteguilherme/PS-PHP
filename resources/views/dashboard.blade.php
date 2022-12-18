<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex items-center justify-between p-6">
                        <h3 class="text-2xl">{{ __('Lista de veículos') }}</h3>
                        <a href="{{ route('vehicles.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Adicionar veiculo') }}</a>
                    </div>
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Placa') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Tipo Veículo') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Marca') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Modelo') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Ano') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Cor') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('Data Criação') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $vehicle->placa }}
                                    </th>
                                    <td class="py-4 px-6">
                                        <h1>{{ $vehicle->placa }}</h1>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $vehicle->marca }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $vehicle->modelo }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $vehicle->ano }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $vehicle->cor }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ date('d-m-Y', strtotime($vehicle->criado_em)) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6">
                        {!! $vehicles->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
