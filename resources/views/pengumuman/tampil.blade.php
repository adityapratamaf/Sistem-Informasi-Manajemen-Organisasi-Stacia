@extends('layout.master')

@section('judul')
    Pengumuman
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a href="/pengumuman/create" class="mx-2 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Tambah"> <i class="fas fa-database"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Pengumuman</a></li>
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
                        <h3 class="card-title"> <b>Daftar Data Pengumuman</b> </h3>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <colgroup>
                                <col width="5%">
                                <col width="30%">
                                <col width="30%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($pengumuman as $key => $data)
                                    <tr>
                                        <td class="text-venter">{{ $key + 1 }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>
                                            <div class="summernote">{!! $data->isi !!}</div>
                                        </td>
                                        <td>
                                            <a href="/pengumuman/{{ $data->id }}/edit" class="btn btn-info btn-sm mx-2"
                                                data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                    class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="/pengumuman/{{ $data->id }}" class="d-inline" method="POST"
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
                                        <td colspan="4" class="text-center">Tidak Ada Data</td>
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
