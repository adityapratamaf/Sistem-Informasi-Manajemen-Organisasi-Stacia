@extends('layout.master')

@section('judul')
    Program
@endsection

@section('isi')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        <a href="/program/create" class="mr-2 float-sm-left btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a>
                        <a href="/program/download" class="mr-2 float-sm-left btn btn-danger" data-toggle="tooltip"
                            data-placement="top" title="Print" target="_blank"> <i class="fas fa-print"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Program</a></li>
                            <li class="breadcrumb-item active">Daftar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                {{-- Search --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><b>Pencarian Data Program</b></h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('program.daftar') }}">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Nama"
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="Tunggu" {{ request('status') == 'Tunggu' ? 'selected' : '' }}>Tunggu
                                        </option>
                                        <option value="Sukses" {{ request('status') == 'Sukses' ? 'selected' : '' }}>Sukses
                                        </option>
                                        <option value="Batal" {{ request('status') == 'Batal' ? 'selected' : '' }}>Batal
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="jenis" class="form-control">
                                        <option value="">Jenis</option>
                                        <option value="1" {{ request('jenis') == '1' ? 'selected' : '' }}>Wajib
                                        </option>
                                        <option value="2" {{ request('jenis') == '2' ? 'selected' : '' }}>Pilihan
                                        </option>
                                        <option value="3" {{ request('jenis') == '3' ? 'selected' : '' }}>Insidentil
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="periode" class="form-control">
                                        <option value="">Periode</option>
                                        @foreach ($periodeOptions as $periode)
                                            <option value="{{ $periode }}"
                                                {{ request('periode') == $periode ? 'selected' : '' }}>
                                                {{ $periode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary mr-2" data-toggle="tooltip"
                                        data-placement="top" title="Pencarian">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('program.daftar') }}" class="btn btn-secondary mr-2"
                                        data-toggle="tooltip" data-placement="top" title="Reset">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Daftar --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Daftar Data Program</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-hover table-condensed">
                            <colgroup>
                                <col width="1%">
                                <col width="25%">
                                <col width="20%">
                                <col width="10%">
                                <col width="10%">
                                <col width="25%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Statistik</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($program as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            {{ $data->nama }}
                                            <br>
                                            <small>
                                                <i class="fas fa-stamp"></i> :
                                                @if ($data->jenis == '1')
                                                    <span>Wajib</span>
                                                @elseif ($data->jenis == '2')
                                                    <span>Pilihan</span>
                                                @elseif ($data->jenis == '3')
                                                    <span>Insidentil</span>
                                                @endif
                                                <br>
                                                <i class="fas fa-calendar"></i> :
                                                {{ date('d M Y', strtotime($data->tgl_mulai)) }} -
                                                {{ date('d M Y', strtotime($data->tgl_selesai)) }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar {{ $data->persentaseProgres == 100 ? 'bg-success' : 'bg-info' }} text-dark"
                                                    role="progressbar"
                                                    style="width: {{ number_format($data->persentaseProgres, 0) }}%; transition: width 0.5s ease;"
                                                    aria-valuenow="{{ number_format($data->persentaseProgres, 0) }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ number_format($data->persentaseProgres, 0) }}%
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $data->pengurus->tahun_periode }}</td>
                                        <td>
                                            @if ($data->status == 'Tunggu')
                                                <span class="badge badge-primary">Tunggu</span>
                                            @elseif ($data->status == 'Sukses')
                                                <span class="badge badge-success">Sukses</span>
                                            @elseif ($data->status == 'Batal')
                                                <span class="badge badge-danger">Batal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="program/keuangan/{{ $data->id }}" class="btn btn-primary mr-2"
                                                data-toggle="tooltip" data-placement="top" title="Keuangan"> <i
                                                    class="fas fa-shopping-bag"></i>
                                            </a>
                                            <a href="program/pekerjaan/{{ $data->id }}" class="btn btn-success mr-2"
                                                data-toggle="tooltip" data-placement="top" title="Pekerjaan"> <i
                                                    class="fas fa-server"></i>
                                            </a>
                                            <a href="/program/{{ $data->id }}" class="btn btn-secondary mr-2"
                                                data-toggle="tooltip" data-placement="top" title="Detail"> <i
                                                    class="fas fa-sticky-note"></i>
                                            </a>

                                            @if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 5))
                                                <a href="/program/{{ $data->id }}/edit" class="btn btn-info mr-2"
                                                    data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                        class="fas fa-pen-alt"></i>
                                                </a>
                                                <form action="/program/{{ $data->id }}" class="d-inline"
                                                    method="POST" onclick="return confirm('Hapus Data ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger mr-2" data-toggle="tooltip"
                                                        data-placement="top" title="Hapus"> <i
                                                            class="fas fa-trash-alt"></i>
                                                    </button>
                                            @endif

                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection
