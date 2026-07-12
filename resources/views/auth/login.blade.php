<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Informasi Door Smeer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-[#EDF3FB]">

    <div class="login-card w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-5">
            {{-- Ganti dengan logo perusahaan --}}
            <div class="w-20 h-20 rounded-full bg-[#CBE3EF] flex items-center justify-center">
                <i class="fa-solid fa-car-side text-3xl text-[#3A4163]"></i>
            </div>
        </div>

        <!-- Judul -->
        <h1 class="text-2xl font-bold text-center text-[#3A4163]">
            Door Smeer 24 Jam
        </h1>

        <p class="text-sm text-center text-gray-500 mt-2">
            Sistem Informasi Manajemen Layanan Door Smeer Mobil
        </p>

        <form method="POST" action="{{ route('login.authenticate') }}" class="mt-8 space-y-5">
            @csrf
            {{-- Alert Error --}}
            @if(session('error'))
                <div class="rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Username --}}
            <div>
                <label for="username" class="form-label">
                    Username
                </label>
                <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-input pl-10"
                        placeholder="Masukkan username"
                        required
                        autofocus>
                </div>
                @error('username')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            {{-- Password --}}
            <div>
                <label for="password" class="form-label">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input pl-11 pr-11"
                        placeholder="Masukkan password"
                        required>
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-[#3A4163]">
                        <i id="eyeIcon" class="fa-regular fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            {{-- Tombol Login --}}
            <button
                type="submit"
                class="btn-primary">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                Masuk
            </button>
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');

            }
        });
    </script>
</body>
</html>