<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  {{--EL LENGUAJE --}}
    <head>
        <meta charset="utf-8"> {{-- LAS ESTIQUETAS META--}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title> {{-- EL TITULO--}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- AQUI ES DONDE SE CARGAN LOS ARCHIVOS CSS Y JAVASCRIPT--}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation') {{-- ESTAMOS INCLUYENDO UN ARCHIVO LLAMADO NAVIGATION CON LA DIRECTIVA DE BLADE @include --}}

            <!-- Page Heading -->
            @if (isset($header)) {{--LUEGO PREGUNTA SI ESTA DEFINIDA LA VARIABLE $header ENTONCES VA IMPRIMIR ESTA ESTRUCTURA--}}
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }} {{--ES LA VARIABLE DONDE SE VA A IMPRIMIR LO QUE CONTENGA LA ETIQUETA--}}
            </main>
        </div>
    </body>
</html>
