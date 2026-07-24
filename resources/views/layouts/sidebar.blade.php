<aside id="main-sidebar" class="fixed top-0 left-0 z-40 w-60 h-screen transition-transform -translate-x-full md:translate-x-0 md:static flex flex-col bg-[#3A4163] text-white">
    <div class="flex items-center justify-center h-16 border-b border-white/10">
        <h1 class="text-lg font-bold">Door Smeer</h1>
    </div>

    <div class="flex-1 overflow-y-auto py-3">
        @if (auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-house w-4"></i>
                <span>Dashboard</span>
            </a>

            <button type="button" class="flex items-center w-full px-5 py-2 text-sm hover:bg-[#5AA8D6] transition" data-collapse-toggle="master-data">
                <i class="fa-solid fa-database w-4"></i>
                <span class="flex-1 ml-3 text-left">Master Data</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <ul id="master-data" class="{{ request()->routeIs('admin.pelanggan.*', 'admin.kendaraan.*', 'admin.kategori-layanan.*', 'admin.layanan.*', 'admin.karyawan.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('admin.pelanggan.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-users w-4"></i> Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kendaraan.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-car w-4"></i> Kendaraan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori-layanan.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-layer-group w-4"></i> Kategori Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.layanan.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-soap w-4"></i> Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.karyawan.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-user-tie w-4"></i> Karyawan
                    </a>
                </li>
            </ul>

            <button type="button" class="flex items-center w-full px-5 py-2 text-sm hover:bg-[#5AA8D6] transition" data-collapse-toggle="transaksi">
                <i class="fa-solid fa-cart-shopping w-4"></i>
                <span class="flex-1 ml-3 text-left">Transaksi</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <ul id="transaksi" class="{{ request()->routeIs('admin.order.*', 'admin.antrean.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('admin.order.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-cart-shopping w-4"></i> Order
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.antrean.index') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-list-check w-4"></i> Antrean
                    </a>
                </li>
            </ul>

            <a href="{{ route('admin.stok.index') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-boxes-stacked w-4"></i>
                <span>Stok</span>
            </a>
        @endif

        @if (auth()->user()->role == 'owner')
            <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-house w-4"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('owner.users.index') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-users w-4"></i>
                <span>Kelola User</span>
            </a>
            <a href="{{ route('owner.periode-gaji.index') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-money-bill w-4"></i>
                <span>Kelola Gaji</span>
            </a>

            <button type="button" class="flex items-center w-full px-5 py-2 text-sm hover:bg-[#5AA8D6] transition" data-collapse-toggle="laporan-owner">
                <i class="fa-solid fa-chart-column w-4"></i>
                <span class="flex-1 ml-3 text-left">Laporan</span>
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>
            <ul id="laporan-owner" class="{{ request()->routeIs('owner.laporan.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('owner.laporan.order') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-cart-shopping w-4"></i> Order
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.laporan.stok') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-boxes-stacked w-4"></i> Stok
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.laporan.gaji') }}" class="flex items-center gap-3 pl-11 py-2 text-sm hover:bg-[#5AA8D6]">
                        <i class="fa-solid fa-money-bill w-4"></i> Gaji
                    </a>
                </li>
            </ul>
            <a href="{{ route('owner.profil-bisnis.index') }}" class="flex items-center gap-3 px-5 py-2 text-sm hover:bg-[#5AA8D6] transition">
                <i class="fa-solid fa-building w-4"></i>
                <span>Profil Bisnis</span>
            </a>
        @endif
    </div>

    <div class="border-t border-white/10 p-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-2 py-2 text-sm hover:bg-red-500 rounded-lg transition">
                <i class="fa-solid fa-right-from-bracket w-4"></i> Logout
            </button>
        </form>
    </div>
</aside>