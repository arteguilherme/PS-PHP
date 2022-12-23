<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    @if (Route::has('login'))
        <div class="flex justify-center items-center w-full bg-blue-900 h-[400px] max-h-full mb-12" style="background-image: url({{ url('/images/mecanico_bg.jpg') }})">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-4 py-2 mr-4 uppercase font-semibold text-ls text-white border-2 border-white hover:bg-white hover:text-gray-800 rounded-lg transition delay-50 duration-150 ease-in-out">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 mr-4 uppercase font-semibold text-ls text-white border-2 border-white hover:bg-white hover:text-gray-800 rounded-lg transition delay-50 duration-150 ease-in-out">Entrar</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white font-semibold text-ls text-grey-800 uppercase border border-transparent rounded-md tracking-widest hover:bg-gray-700 hover:text-white transition ease-in-out duration-150">Cadastrar</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 overflow-x-auto relative">
        <table class="w-full table-auto">
            <thead
                class="text-xs text-gray-700 uppercase">
            <tr>
                <th class="py-3 px-6">
                    {{ __('Placa') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Tipo Veículo') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Marca') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Modelo') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Ano') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Cor') }}
                </th>
                <th class="py-3 px-6">
                    {{ __('Data Criação') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
                <tr class="border-b border-gray-300">
                    <td class="py-3">{{ $vehicle->placa }}</td>
                    <td class="py-3">{{ $vehicle->typeVehicle->name }}</td>
                    <td class="py-3">{{ $vehicle->marca }}</td>
                    <td class="py-3">{{ $vehicle->modelo }}</td>
                    <td class="py-3">{{ $vehicle->ano }}</td>
                    <td class="py-3">{{ $vehicle->cor }}</td>
                    <td class="py-3">{{ $vehicle->criado_em->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
