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

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                @error('username')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                    <option value="">-- Pilih Role --</option>

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

            <button
                type="submit"
                class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-white transition hover:bg-[#3A4163]">

                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Simpan

            </button>

        </div>

    </form>

</div>
@endsection