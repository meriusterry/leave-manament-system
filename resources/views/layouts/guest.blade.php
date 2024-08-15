<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        @vite('resources/css/app.css')
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
  

    <body class="flex items-center justify-center min-h-screen bg-white-90">
        <div class="w-full max-w-md bg-white shadow-lg p-8">
    
            {{ $slot }}
            
        </div>
    </body>
    
</html>
