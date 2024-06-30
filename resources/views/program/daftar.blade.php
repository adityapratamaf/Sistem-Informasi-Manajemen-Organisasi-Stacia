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
                        <a href="/program/create" class="mx-2 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a>
                        <a href="/program/download" class="mx-2 float-sm-left btn btn-danger btn-sm" data-toggle="tooltip"
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

                <div class="card card-primary card-outline">

                    <div class="card-header">
                        <h3 class="card-title"> <b>Daftar Data Program</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-hover table-condensed">
                            <colgroup>
                                <col width="1%">
                                <col width="25%">
                                <col width="25%">
                                <col width="15%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($program as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->tgl_mulai }} - {{ $data->tgl_selesai }}</td>
                                        <td>
                                            @if ($data->jenis == '1')
                                                <span class="badge badge-primary">Wajib</span>
                                            @elseif ($data->jenis == '2')
                                                <span class="badge badge-primary">Pilihan</span>
                                            @elseif ($data->jenis == '3')
                                                <span class="badge badge-primary">Insidentil</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->status == 'Tunggu')
                                                <span class="badge badge-primary">Tunggu</span>
                                            @elseif ($data->status == 'Proses')
                                                <span class="badge badge-info">Proses</span>
                                            @elseif ($data->status == 'Tunda')
                                                <span class="badge badge-warning">Tunda</span>
                                            @elseif ($data->status == 'Sukses')
                                                <span class="badge badge-success">Sukses</span>
                                            @elseif ($data->status == 'Batal')
                                                <span class="badge badge-danger">Batal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/program/{{ $data->id }}" class="btn btn-secondary btn-sm mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Detail"> <i
                                                    class="fas fa-sticky-note"></i>
                                            </a>
                                            <a href="/program/{{ $data->id }}/edit" class="btn btn-info btn-sm mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                    class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="/program/{{ $data->id }}" class="d-inline" method="POST"
                                                onclick="return confirm('Hapus Data ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm mx-2" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus"> <i class="fas fa-trash-alt"></i>
                                                </button>
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
