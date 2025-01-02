<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo -->
            <div>
                <a href="/" aria-label="Inicio">
                    <x-application-logo class="w-24 h-24 fill-current text-gray-500 dark:text-gray-300" />
                </a>
            </div>

            <!-- Content Container -->
            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white shadow-lg rounded-lg dark:bg-gray-800">
                {{ $slot }}
            </div>

            <!-- Footer (Optional) -->
            <footer class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ now()->year }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.
            </footer>
        </div>
    </body>
</html>
