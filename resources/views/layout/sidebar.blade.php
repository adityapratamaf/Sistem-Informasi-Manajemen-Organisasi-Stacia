{{-- SIDEBAR --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- PROFILE --}}
    <a href="../../index3.html" class="brand-link mt-1 d-flex">
        <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    {{-- PROFILE --}}

    {{-- MENU --}}
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">Menu</li>

                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="/" class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ \Route::is('.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ \Route::is('suratkeluar.*', 'suratmasuk.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Dokumen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/suratmasuk" class="nav-link {{ \Route::is('suratmasuk.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Surat Masuk</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/suratkeluar" class="nav-link {{ \Route::is('suratkeluar.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Surat Keluar</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Surat Keterangan</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Proposal</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Laporan P J</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/logistik" class="nav-link {{ \Route::is('logistik.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Logistik">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Logistik
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/logistik" class="nav-link {{ \Route::is('program.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Logistik">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Program
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ \Route::is('dashboard.dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Keuangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-receipt nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-receipt nav-icon"></i>
                                <p>Pemasukan</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html"
                                class="nav-link {{ \Route::is('dashboard.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-receipt nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">Manajemen</li>

                <li class="nav-item">
                    <a href="/pengumuman" class="nav-link {{ \Route::is('pengumuman.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Pengumuman">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Pengumuman
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/anggota" class="nav-link {{ \Route::is('anggota.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Anggota">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pengurus
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/anggota" class="nav-link {{ \Route::is('anggota.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Anggota">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Anggota
                        </p>
                    </a>
                </li>

                <li class="nav-header">Konfigurasi</li>

                <li class="nav-item">
                    <a href="/anggota" class="nav-link {{ \Route::is('anggota.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Keluar">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
    {{-- MENU --}}

</aside>
{{-- SIDEBAR --}}
