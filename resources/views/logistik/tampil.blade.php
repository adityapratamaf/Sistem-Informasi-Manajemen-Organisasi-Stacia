@extends('layout.master')

@section('judul')
    Logistik
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a href="/logistik/create" class="m-0 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i> </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Logistik</a></li>
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
                        <h3 class="card-title"> <b>Daftar Data Logistik</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <colgroup>
                                <col width="5%">
                                <col width="30%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nomor</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Pemakaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($logistik as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $data->nomor }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>
                                            @if ($data->status == 1)
                                                <span class="badge badge-success">LAYAK</span>
                                            @else
                                                <span class="badge badge-warning">TIDAK LAYAK</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->pemakaian == 1)
                                                <span class="badge badge-success">TERSEDIA</span>
                                            @else
                                                <span class="badge badge-warning">TIDAK TERSEDIA</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/cast/.." class="btn btn-outline-secondary btn-sm mr-2"
                                                data-toggle="tooltip" data-placement="top" title="Detail"> <i
                                                    class="fas fa-sticky-note"></i>
                                            </a>
                                            <a href="/cast/../edit" class="btn btn-outline-info btn-sm mr-2"
                                                data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                    class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="/logistik/.." class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm mr-2" data-toggle="tooltip"
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
