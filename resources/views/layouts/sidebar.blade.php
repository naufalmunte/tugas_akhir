<aside id="main-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0 md:static flex flex-col bg-[#3A4163] text-white shadow-xl">
    <div class="flex items-center justify-center h-16 border-b border-white/10">
        <a href="#" class="flex items-center gap-3">
            @if (!empty($logo))
                <img src="{{ asset('storage/' . $logo) }}" alt="Logo Door Smeer" class="w-9 h-9 object-contain rounded-lg">
            @else
                <div
                    class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#5AA8D6] text-white font-black text-lg shadow-md">
                    DS
                </div>
            @endif
            <h1 class="text-xl font-bold tracking-wide text-white">Door Smeer</h1>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-4 space-y-1 px-3">
        @if (auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <button type="button"
                class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors"
                aria-controls="master-data" data-collapse-toggle="master-data">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-database w-5 text-center"></i>
                    <span>Master Data</span>
                </div>
                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
            </button>
            <ul id="master-data"
                class="space-y-1 py-1 {{ request()->routeIs('admin.pelanggan.*', 'admin.kendaraan.*', 'admin.kategori-layanan.*', 'admin.layanan.*', 'admin.karyawan.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('admin.pelanggan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.pelanggan.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-users w-4 text-center"></i> Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kendaraan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.kendaraan.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-car w-4 text-center"></i> Kendaraan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori-layanan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.kategori-layanan.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-layer-group w-4 text-center"></i> Kategori Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.layanan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.layanan.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-soap w-4 text-center"></i> Layanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.karyawan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.karyawan.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-user-tie w-4 text-center"></i> Karyawan
                    </a>
                </li>
            </ul>

            <button type="button"
                class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors"
                aria-controls="transaksi" data-collapse-toggle="transaksi">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
                    <span>Transaksi</span>
                </div>
                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
            </button>
            <ul id="transaksi"
                class="space-y-1 py-1 {{ request()->routeIs('admin.order.*', 'admin.antrean.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('admin.order.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.order.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-cart-shopping w-4 text-center"></i> Order
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.antrean.index') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.antrean.*') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-list-check w-4 text-center"></i> Proses Layanan
                    </a>
                </li>
            </ul>

            <!-- Stok -->
            <a href="{{ route('admin.stok.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('admin.stok.*') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                <span>Stok</span>
            </a>
        @endif

        @if (auth()->user()->role == 'owner')
            <a href="{{ route('owner.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.dashboard') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('owner.users.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.users.*') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-users w-5 text-center"></i>
                <span>Kelola User</span>
            </a>
            <a href="{{ route('owner.periode-gaji.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.periode-gaji.*') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-money-bill w-5 text-center"></i>
                <span>Kelola Gaji</span>
            </a>

            <button type="button"
                class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors"
                aria-controls="laporan-owner" data-collapse-toggle="laporan-owner">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-chart-column w-5 text-center"></i>
                    <span>Laporan</span>
                </div>
                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
            </button>
            <ul id="laporan-owner"
                class="space-y-1 py-1 {{ request()->routeIs('owner.laporan.*') ? 'block' : 'hidden' }}">
                <li>
                    <a href="{{ route('owner.laporan.order') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.laporan.order') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-cart-shopping w-4 text-center"></i> Order
                    </a>
                </li>
                 <li>
                    <a href="{{ route('owner.laporan.pendapatan') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.laporan.order') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-money-bill w-4 text-center"></i> Pendapatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.laporan.gaji') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.laporan.gaji') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-money-bill w-4 text-center"></i> Gaji
                    </a>
                </li>
                 <li>
                    <a href="{{ route('owner.laporan.stok') }}"
                        class="flex items-center gap-3 px-4 py-2 pl-12 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.laporan.stok') ? 'bg-[#5AA8D6]' : '' }}">
                        <i class="fa-solid fa-boxes-stacked w-4 text-center"></i> Stok
                    </a>
                </li>
            </ul>

            <a href="{{ route('owner.profil-bisnis.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-[#5AA8D6] transition-colors {{ request()->routeIs('owner.profil-bisnis.*') ? 'bg-[#5AA8D6]' : '' }}">
                <i class="fa-solid fa-building w-5 text-center"></i>
                <span>Profil Bisnis</span>
            </a>
        @endif
    </div>

    <div class="border-t border-white/10 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center justify-left gap-3 w-full px-4 py-2.5 text-sm font-semibold text-white bg-transparent hover:bg-red-600 rounded-lg transition-colors focus:ring-2 focus:ring-red-400">
                <i class="fa-solid fa-right-from-bracket w-5 text-left"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
