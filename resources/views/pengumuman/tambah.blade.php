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
                        {{-- <h5 class="m-0 float-sm-left">#</h5> --}}
                        {{-- <a href="/logistik" class="m-0 float-sm-left btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="Kembali"> <i class="fas fa-step-backward"></i> </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Pengumuman</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Tambah Data Pengumuman</b> </h3>
                    </div>

                    <form action="/pengumuman" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" class="form-control" placeholder="Judul"
                                            autocomplete="off">
                                    </div>
                                    @error('judul')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="isi">Isi</label>
                                        <textarea name="isi" id="summernote" class="form-control" placeholder="Isi"></textarea>
                                    </div>
                                    @error('isi')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary toastrDefaultSuccess" data-toggle="tooltip"
                                data-placement="bottom" title="Simpan"> <i class="fas fa-database"></i> </i>
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection
