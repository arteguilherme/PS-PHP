<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
                   class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Entrar</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cadastrar</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <table class="table-auto w-full border-separate border-spacing-2">
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
                <tr>
                    <td class="pb-3">{{ $vehicle->placa }}</td>
                    <td class="pb-3">{{ $vehicle->typeVehicle->name }}</td>
                    <td class="pb-3">{{ $vehicle->marca }}</td>
                    <td class="pb-3">{{ $vehicle->modelo }}</td>
                    <td class="pb-3">{{ $vehicle->ano }}</td>
                    <td class="pb-3">{{ $vehicle->cor }}</td>
                    <td class="pb-3">{{ $vehicle->criado_em->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
