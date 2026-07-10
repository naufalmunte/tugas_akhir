<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistem Informasi Door Smeer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EDF3FB]">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.navbar')

            <main class="flex-1 p-6">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>
    </div>
</body>
</html>