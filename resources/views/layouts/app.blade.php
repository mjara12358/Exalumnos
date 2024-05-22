<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="visibility: hidden;">
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

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="flex flex-col min-h-[75vh] bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="shadow bg-gradient-to-b from-blue-500 from-20% via-blue-400 to-transparent dark:from-blue-500 dark:via-blue-400">
                    <div class="max-w-7xl mx-auto py-6 px-4 pb-8 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
            
        </div>

        <div class="bg-gray-100 dark:bg-gray-900">
            <x-footer />
        </div>

        @stack('modals')

        @livewireScripts

        <script src="/path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="/path/to/flowbite/dist/datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </body>
</html>
