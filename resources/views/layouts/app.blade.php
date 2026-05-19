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
    <body class="bg-[#D0E3FF] font-sans antialiased m-0 p-0 flex flex-col md:flex-row min-h-screen text-black">

        <!-- Sidebar Menu Navigasi Pimpinan -->
        <div class="w-full relative md:fixed md:top-0 md:bottom-0 md:left-0 md:w-[260px] bg-[#081F5C] text-white flex flex-col z-[100] shadow-[4px_0_15px_rgba(8,31,92,0.1)]">
            <div class="p-6 text-[20px] font-bold text-center border-b border-[#D0E3FF]/20 tracking-[0.5px]">
                Pimpinan Panel
            </div>
            
            <ul class="list-none py-5 px-3 m-0 grow">
                <li class="mb-2">
                    <a href="/pimpinan/dashboard" 
                       class="block py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                       {{ request()->is('pimpinan/dashboard') 
                          ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                          : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                       }}">
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="/pimpinan/laporan" 
                       class="block py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                       {{ request()->is('pimpinan/laporan') 
                          ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                          : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                       }}">
                        Laporan Pimpinan
                    </a>
                </li>
            </ul>

            <div class="border-t border-[#D0E3FF]/20 py-[15px] px-6">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#e53e3e] hover:bg-[#c53030] text-white border-none p-3 rounded-[8px] font-semibold cursor-pointer transition-colors duration-200">
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>

        <!-- Area Konten Halaman Dinamis -->
        <div class="grow p-5 md:p-10 box-border w-full md:ml-[260px] md:max-w-[calc(100%-260px)]">

            <!-- Banner Selamat Datang / Dynamic Page Heading -->
            @isset($header)
                <div class="bg-gradient-to-br from-[#081F5C] to-[#1a3a8f] text-white py-6 px-[30px] rounded-xl shadow-[0_4px_20px_rgba(8,31,92,0.15)] mb-[30px]">
                    <div class="text-xl font-bold tracking-[0.3px]">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Page Content (Slot Komponen Laravel) -->
            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
</html>