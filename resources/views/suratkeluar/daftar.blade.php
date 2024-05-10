@extends('layout.master')

@section('judul')
    Surat Keluar
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a href="/suratkeluar/create" class="mx-2 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a>
                        <a href="/suratkeluar/download" class="mx-2 float-sm-left btn btn-danger btn-sm"
                            data-toggle="tooltip" data-placement="top" title="Print"> <i class="fas fa-print"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dokumen</a></li>
                            <li class="breadcrumb-item"><a href="#">Surat Keluar</a></li>
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
                        <h3 class="card-title"> <b>Daftar Surat Keluar</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped table-hover">
                            <colgroup>
                                <col width="1%">
                                <col width="10%">
                                <col width="10%">
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($suratkeluar as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $data->nomor }}</td>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->perihal }}</td>
                                        <td>{{ $data->tujuan }}</td>
                                        <td>
                                            <a href="/suratkeluar/{{ $data->id }}" class="btn btn-secondary btn-sm mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Detail"> <i
                                                    class="fas fa-sticky-note"></i>
                                            </a>
                                            <a href="/suratkeluar/{{ $data->id }}/edit" class="btn btn-info btn-sm mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                    class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="/suratkeluar/{{ $data->id }}" class="d-inline" method="POST"
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
                            {{-- <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection