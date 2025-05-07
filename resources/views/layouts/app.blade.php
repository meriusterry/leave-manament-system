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
<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">

        {{-- Sidebar --}}
        <aside class="bg-gray-800 text-white w-64 p-4">
            <div class="logo text-xl font-semibold mb-8 flex items-center gap-2">
                <div class="flex justify-center mb-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-80 h-12">
                </div>
            </div>
            @if (auth()->user() && auth()->user()->access === 'True')
            <nav class="space-y-2 mt-4">
                <div class="border-b border-gray-300 my-4 mt-2"></div>
        
                <!-- Home -->
                <a href="{{ route('leaves.dashboard') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Home Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Home
                </a>
        
                <!-- Users -->
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Users Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 20h5v-2a4 4 0 0 0-5-3.87M9 20H4v-2a4 4 0 0 1 5-3.87m6-2.13a4 4 0 1 0-6 0m6 0a4 4 0 1 1-6 0"/>
                    </svg>
                    Users
                </a>
        
                <!-- Leave Types -->
                <a href="{{ route('admin.createleavetypes') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Clipboard Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 2a1 1 0 0 0-1 1v1H5.5A1.5 1.5 0 0 0 4 5.5v13A1.5 1.5 0 0 0 5.5 20h13a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 18.5 4H16V3a1 1 0 0 0-1-1H9z" />
                    </svg>
                    Leave Types
                </a>
        
                <!-- Holidays -->
                <a href="{{ route('admin.holidays') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Calendar Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                    </svg>
                    Holidays
                </a>
        
                <!-- Approval -->
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Check Badge Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 12l2 2l4-4M12 2a10 10 0 1 1-7.07 2.93A10 10 0 0 1 12 2z"/>
                    </svg>
                    Approval
                </a>
        
                <!-- My Leaves -->
                <a href="{{ route('leaves.dashboard') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                    <!-- Document Text Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 16h8M8 12h8m-6 4h6m2-10H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                    </svg>
                    My Leaves
                </a>
            </nav>
            @else
            <!-- Non-admin view -->
            <a href="{{ route('leaves.dashboard') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                <!-- Home Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Home
            </a>
            <a href="{{ route('leaves.dashboard') }}" class="block px-4 py-2  hover:bg-gray-700 transition-colors flex items-center gap-2">
                <!-- Document Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M8 16h8M8 12h8m-6 4h6m2-10H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                </svg>
                My Leaves
            </a>
            @endif
        </aside>
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Top Navigation --}}
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="#">
                                    <img src="{{ asset('images/DX LOGO 2.png') }}" alt="Logo" class="w-20">
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->firstName }} {{ Auth::user()->surname }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Flash Messages --}}
            <div class="fixed top-0 right-0 m-4 z-50">
                @if(session('success'))
                    <div class="bg-green-400 text-white p-4 rounded shadow-lg mb-2" id="flash-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="bg-red-400 text-white p-4 rounded shadow-lg mb-2" id="flash-message">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Page Header --}}
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // Auto-dismiss flash messages after 5 seconds
        setTimeout(() => {
            const flashMessages = document.querySelectorAll('#flash-message');
            flashMessages.forEach(message => message.remove());
        }, 5000); // 5000ms = 5 seconds
    </script>
</body>
</html>
