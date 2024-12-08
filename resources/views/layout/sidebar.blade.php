{{-- SIDEBAR --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- PROFILE --}}
    <div class="user-panel d-flex align-items-center">
        <a href="" class="brand-link mt-1 d-flex">
            <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image"
                style="opacity: .8">
            <span class="brand-text font-weight-light"> <b>STACIA </b>UMJ</span>
        </a>
    </div>
    {{-- PROFILE --}}

    {{-- MENU --}}
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('anggota-foto/' . Auth::user()->anggota->foto) }}" class="img-circle elevation-2"
                    alt="Profil">
            </div>

            <div class="info">
                <a class="d-block">{{ Auth::user()->nama }}</a>
                <a class="d-block"> <small>{{ Auth::user()->anggota->nra }}</small></a>
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
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ \Route::is('dashboard.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                    <!-- Surat -->
                    <li class="nav-item {{ \Route::is('.*') ? 'menu-open' : '' }}">
                        <a href="surat"
                            class="nav-link {{ \Route::is('suratkeluar.*', 'suratmasuk.*', 'suratketerangan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Surat
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
                                <a href="/suratkeluar"
                                    class="nav-link {{ \Route::is('suratkeluar.*') ? 'active' : '' }}">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/suratketerangan"
                                    class="nav-link {{ \Route::is('suratketerangan.*') ? 'active' : '' }}">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Surat Keterangan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 4))
                    <!-- Logistik -->
                    <li class="nav-item">
                        <a href="/logistik" class="nav-link {{ \Route::is('logistik.*') ? 'active' : '' }}"
                            data-toggle="tooltip" data-placement="top" title="Logistik">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Logistik
                            </p>
                        </a>
                    </li>
                @endif

                <!-- Program -->
                <li class="nav-item">
                    <a href="/program" class="nav-link {{ \Route::is('program.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Program">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Program
                        </p>
                    </a>
                </li>

                @if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                    <li class="nav-header">Manajemen</li>
                    <!-- Pengumuman -->
                    <li class="nav-item">
                        <a href="/pengumuman" class="nav-link {{ \Route::is('pengumuman.*') ? 'active' : '' }}"
                            data-toggle="tooltip" data-placement="top" title="Pengumuman">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                Pengumuman
                            </p>
                        </a>
                    </li>

                    <!-- Pengurus -->
                    <li class="nav-item">
                        <a href="/pengurus" class="nav-link {{ \Route::is('pengurus.*') ? 'active' : '' }}"
                            data-toggle="tooltip" data-placement="top" title="Pengurus">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pengurus
                            </p>
                        </a>
                    </li>

                    <!-- Anggota -->
                    <li class="nav-item">
                        <a href="/anggota" class="nav-link {{ \Route::is('anggota.*') ? 'active' : '' }}"
                            data-toggle="tooltip" data-placement="top" title="Anggota">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Anggota
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">Konfigurasi</li>
                <!-- Profil -->
                <li class="nav-item">
                    <a href="/profil" class="nav-link {{ \Route::is('profil.*') ? 'active' : '' }}"
                        data-toggle="tooltip" data-placement="top" title="Profil">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>

                <!-- Keluar -->
                <li class="nav-item">
                    <a href="/logout" class="nav-link {{ \Route::is('logout.*') ? 'active' : '' }}"
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
