@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h1 class="heading text-2xl font-semibold text-gray-800">
                Tambah User
            </h1>
            <p class="body-text text-sm text-gray-500">
                Tambahkan data user baru.
            </p>
        </div>

        <form action="{{ route('owner.users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                    @error('username')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 pr-10 focus:border-[#5AA8D6] focus:outline-none">
                        <button type="button" onclick="togglePassword('password', 'eye-password')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-[#5AA8D6] transition">
                            <i id="eye-password" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 pr-10 focus:border-[#5AA8D6] focus:outline-none">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-password-confirm')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-[#5AA8D6] transition">
                            <i id="eye-password-confirm" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Role
                    </label>

                    <select name="role"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                        <option value="">Pilih Role</option>
                        <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>
                            Owner
                        </option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                    </select>
                    @error('role')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('owner.users.index') }}"
                    class="rounded-lg bg-gray-500 px-5 py-2 text-white transition hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-white transition hover:bg-[#3A4163]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
