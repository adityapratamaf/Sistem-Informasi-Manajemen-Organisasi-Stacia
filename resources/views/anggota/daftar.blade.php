@extends('layout.master')

@section('judul')
    Anggota
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a href="/anggota/create" class="mx-2 float-sm-left btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a>
                        <a href="/anggota/download" class="mx-2 float-sm-left btn btn-danger" data-toggle="tooltip"
                            data-placement="top" title="Print" target="_blank"> <i class="fas fa-print"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anggota</a></li>
                            <li class="breadcrumb-item active">Daftar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><b>Pencarian Data Anggota</b></h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('anggota.daftar') }}">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Nama"
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="">Status Akun</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>
                                            Non Aktif
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select name="role" class="form-control">
                                        <option value="">Jenis Akun</option>
                                        <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>
                                            Administrator
                                        </option>
                                        <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>
                                            Sekertaris
                                        </option>
                                        <option value="3" {{ request('role') == '3' ? 'selected' : '' }}>
                                            Bendahara
                                        </option>
                                        <option value="4" {{ request('role') == '4' ? 'selected' : '' }}>
                                            Logistik
                                        </option>
                                        <option value="5" {{ request('role') == '5' ? 'selected' : '' }}>
                                            Kepala Bidang
                                        </option>
                                        <option value="6" {{ request('role') == '6' ? 'selected' : '' }}>
                                            User
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="jenis_anggota" class="form-control">
                                        <option value="">Jenis Anggota</option>
                                        <option value="1" {{ request('jenis_anggota') == '1' ? 'selected' : '' }}>
                                            Anggota Biasa
                                        </option>
                                        <option value="2" {{ request('jenis_anggota') == '2' ? 'selected' : '' }}>
                                            Anggota Istimewa
                                        </option>
                                        <option value="3" {{ request('jenis_anggota') == '3' ? 'selected' : '' }}>
                                            Anggota Luar Biasa
                                        </option>
                                        <option value="4" {{ request('jenis_anggota') == '3' ? 'selected' : '' }}>
                                            Anggota Kehormatan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                        data-placement="top" title="Pencarian">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('anggota.daftar') }}" class="btn btn-secondary mx-2"
                                        data-toggle="tooltip" data-placement="top" title="Reset">
                                        <i class="fas fa-sync"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Daftar Data Anggota</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-hover table-condensed">
                            <colgroup>
                                <col width="1%">
                                <col width="20%">
                                <col width="20%">
                                <col width="15%">
                                <col width="10%">
                                <col width="10%">
                                <col width="25%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nomor Registrasi Anggota</th>
                                    <th>Nama</th>
                                    <th>Jenis Anggota</th>
                                    <th>Jenis Akun</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($anggota as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $data->nra }}</td>
                                        <td>{{ $data->user->nama }}</td>
                                        <td>
                                            @if ($data->jenis_anggota == 1)
                                                Anggota Biasa
                                            @elseif ($data->jenis_anggota == 2)
                                                Anggota Istimewa
                                            @elseif ($data->jenis_anggota == 3)
                                                Anggota Luar Biasa
                                            @elseif ($data->jenis_anggota == 4)
                                                Anggota Kehormatan
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->user->role == 1)
                                                Administrator
                                            @elseif ($data->user->role == 2)
                                                Sekretaris
                                            @elseif ($data->user->role == 3)
                                                Bendahara
                                            @elseif ($data->user->role == 4)
                                                Logistik
                                            @elseif ($data->user->role == 5)
                                                Kepala Bidang
                                            @elseif ($data->user->role == 6)
                                                User
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->user->status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @elseif ($data->user->status == 2)
                                                <span class="badge badge-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::check() && Auth::user()->role == 1)
                                                <a href="{{ route('login', $data->user->id) }}"
                                                    class="btn btn-success mx-2" data-toggle="tooltip" data-placement="top"
                                                    title="Login"> <i class="fas fa-user"></i>
                                                </a>
                                            @endif
                                            <a href="/anggota/{{ $data->id }}" class="btn btn-secondary mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Detail"> <i
                                                    class="fas fa-sticky-note"></i>
                                            </a>
                                            <a href="/anggota/{{ $data->id }}/edit" class="btn btn-info mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                    class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="/anggota/{{ $data->id }}" class="d-inline" method="POST"
                                                onclick="return confirm('Hapus Data ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger mx-2" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus"> <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection
