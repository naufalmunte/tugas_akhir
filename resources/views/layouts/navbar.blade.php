<nav class="bg-white shadow-sm border-b px-6 py-4 flex justify-between items-center">
    <div>
        <h1 class="heading text-xl font-semibold text-[#3A4163]">
            @yield('page-title')
        </h1>
    </div>
    <div class="flex items-center gap-4">
        <span class="text-gray-600">
            {{ Auth::user()->name }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="text-red-500 hover:text-red-700">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</nav>