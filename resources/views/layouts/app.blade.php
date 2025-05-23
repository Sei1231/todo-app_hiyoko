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
        <link rel="stylesheet" href="{{ asset('assets/css/firstpage.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
        </div> --}}
        <header class="bg-yellow shadow py-6 px-6 flex justify-between items-center">
            <!-- 左側の見出し -->
            <h1 class="text-xl font-bold text-[#6b4226]">TO DO LIST</h1>

            <!-- 右側のユーザーアイコン（Heroicons / 黄色） -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="#facc15" viewBox="0 0 24 24" stroke="#facc15" stroke-width="1.5" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
            </svg>
        </header>


        <main>
            @yield('content')
        </main>

        <footer></footer>
    </body>
</html>
