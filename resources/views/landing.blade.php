<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_usaha }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-slate-50 antialiased">
    @include('landing.navbar')
    <div class="relative overflow-hidden font-sans pt-20">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-tr from-blue-200 to-cyan-100 rounded-full blur-3xl opacity-50 -z-10"></div>
        @include('landing.hero')
        @include('landing.tentang')
        @include('landing.keunggulan')
        @include('landing.layanan')
    </div>
    @include('landing.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>