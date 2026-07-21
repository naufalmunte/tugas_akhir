<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistem Informasi Door Smeer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EDF3FB] font-sans">
    <div class="flex h-screen">
        @include('layouts.sidebar')

        <div class="flex flex-1 flex-col overflow-hidden">
            @include('layouts.navbar')

            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
