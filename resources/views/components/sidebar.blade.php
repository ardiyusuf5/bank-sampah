<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
            <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('petugas.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_dark.svg') }}" alt="navbar brand" class="navbar-brand" height="25">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">

                {{-- MENU ADMIN --}}
                @if (auth()->user()->role == 'admin')
                    <!-- Dashboard -->
                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Data Master -->
                    @php $isDataMasterActive = request()->routeIs('admin.nasabah.*', 'admin.petugas.*', 'admin.sampah.*', 'admin.pengepul.*'); @endphp
                    <li class="nav-item {{ $isDataMasterActive ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#data-master-admin" class="{{ $isDataMasterActive ? '' : 'collapsed' }}" aria-expanded="{{ $isDataMasterActive ? 'true' : 'false' }}">
                            <i class="fas fa-database"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $isDataMasterActive ? 'show' : '' }}" id="data-master-admin">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('admin.nasabah.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.nasabah.index') }}">
                                        <span class="sub-item">Data Nasabah</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.petugas.index') }}">
                                        <span class="sub-item">Data Petugas</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.sampah.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sampah.index') }}">
                                        <span class="sub-item">Data Sampah</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.pengepul.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.pengepul.index') }}">
                                        <span class="sub-item">Data Pengepul</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Manajemen Konten -->
                    @php $isKontenActive = request()->routeIs('admin.artikel.*', 'admin.video.*'); @endphp
                    <li class="nav-item {{ $isKontenActive ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#manajemen-konten" class="{{ $isKontenActive ? '' : 'collapsed' }}" aria-expanded="{{ $isKontenActive ? 'true' : 'false' }}">
                            <i class="fas fa-file-alt"></i>
                            <p>Manajemen Konten</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $isKontenActive ? 'show' : '' }}" id="manajemen-konten">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.artikel.index') }}">
                                        <span class="sub-item">Data Artikel</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.video.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.video.index') }}">
                                        <span class="sub-item">Data Video</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Transaksi -->
                    @php $isTransaksiAdminActive = request()->routeIs('admin.transaksi.*', 'admin.tarik-saldo.*', 'admin.pengiriman.*'); @endphp
                    <li class="nav-item {{ $isTransaksiAdminActive ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#transaksi-admin" class="{{ $isTransaksiAdminActive ? '' : 'collapsed' }}" aria-expanded="{{ $isTransaksiAdminActive ? 'true' : 'false' }}">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $isTransaksiAdminActive ? 'show' : '' }}" id="transaksi-admin">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.transaksi.index') }}">
                                        <span class="sub-item">Transaksi Setoran</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.tarik-saldo.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.tarik-saldo.index') }}">
                                        <span class="sub-item">Tarik Saldo</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.pengiriman.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.pengiriman.index') }}">
                                        <span class="sub-item">Pengiriman Sampah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Laporan -->
                    <li class="nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.laporan.index') }}">
                            <i class="fas fa-print"></i>
                            <p>Cetak Laporan</p>
                        </a>
                    </li>
                @endif

                {{-- MENU PETUGAS --}}
                @if (auth()->user()->role == 'petugas')
                    <!-- Dashboard -->
                    <li class="nav-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('petugas.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Data Master -->
                    @php $isDataMasterPetugas = request()->routeIs('petugas.nasabah.*'); @endphp
                    <li class="nav-item {{ $isDataMasterPetugas ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#data-master-petugas" class="{{ $isDataMasterPetugas ? '' : 'collapsed' }}" aria-expanded="{{ $isDataMasterPetugas ? 'true' : 'false' }}">
                            <i class="fas fa-database"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $isDataMasterPetugas ? 'show' : '' }}" id="data-master-petugas">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('petugas.nasabah.*') ? 'active' : '' }}">
                                    <a href="{{ route('petugas.nasabah.index') }}">
                                        <span class="sub-item">Data Nasabah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Transaksi -->
                    @php $isTransaksiPetugas = request()->routeIs('petugas.transaksi.*'); @endphp
                    <li class="nav-item {{ $isTransaksiPetugas ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#transaksi-petugas" class="{{ $isTransaksiPetugas ? '' : 'collapsed' }}" aria-expanded="{{ $isTransaksiPetugas ? 'true' : 'false' }}">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $isTransaksiPetugas ? 'show' : '' }}" id="transaksi-petugas">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                                    <a href="{{ route('petugas.transaksi.index') }}">
                                        <span class="sub-item">Transaksi Setoran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <a href="#" class="text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt text-danger"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
