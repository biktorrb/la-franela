<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome (para los iconos) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts (Tailwind CSS con Vite, y Alpine.js cargado desde app.js) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <div
            x-data="{
                sidebarOpen: window.innerWidth >= 768 ? true : false,
                isDesktop: window.innerWidth >= 768,
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    // Console.log para depuración, puedes quitarlo cuando funcione
                    console.log('Sidebar toggle button clicked! New state:', this.sidebarOpen);
                }
            }"
            @resize.window="isDesktop = window.innerWidth >= 768; if (isDesktop) sidebarOpen = true"
            class="flex flex-col h-screen"
        >

            <!-- HEADER SUPERIOR-->
            <header class="bg-white shadow w-full py-2"> 
                <div class="flex items-center px-4">
                    <!-- Botón del sidebar (visible solo en móvil)-->
                    <button
                        @click="toggleSidebar()"
                        class="md:hidden p-2 text-gray-600 focus:outline-none focus:bg-gray-200"
                    >
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <!-- Título del Header / Slot $header -->
                    <div class="ml-4 py-2"> 
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">La Franela</h2> 
                    </div>                    
                </div>
            </header>
            <!-- CONTENEDOR PARA SIDEBAR Y CONTENIDO PRINCIPAL -->
            <div class="flex flex-1 overflow-hidden">
                <!-- SIDEBAR-->
                @include('components.sidebar')
                <!-- CONTENIDO PRINCIPAL-->                
                <main class="flex-1 p-6 overflow-y-auto">
                    <div class="ml-4 py-2"> 
                        {{ $header ?? '' }} 
                    </div>
                    {{ $main_content ?? '' }}
                </main>
            </div> 
            <!-- Overlay para el sidebar en móvil -->
            <div
                x-show="!isDesktop && sidebarOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 bg-black opacity-50 z-40"
            ></div>
        </div>
    </body>
</html>

