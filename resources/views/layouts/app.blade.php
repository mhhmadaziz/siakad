<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
            integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

        <x-embed-styles />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        @include('layouts.app-header')

        <div class="flex min-h-screen flex-col bg-bgColor pt-4 md:flex-row md:pl-4">
            <!-- Page Content -->
            @include('layouts.app-sidebar')

            <main class="min-h-full w-full bg-white">
                <div class="mx-auto w-full max-w-screen-xl px-2 pt-4 md:px-16">
                    {{ Breadcrumbs::render() }}
                    <x-alert />
                </div>
                {{ $slot }}
            </main>
        </div>

        @include('layouts.app-footer')

        <!-- Include the Quill library -->
        @livewireScripts
        @livewire('wire-elements-modal')
        @stack('scripts')
    </body>
</html>
