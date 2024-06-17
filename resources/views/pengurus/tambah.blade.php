@extends('layout.master')

@section('judul')
    Pengurus
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <h5 class="m-0 float-sm-left">#</h5> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Pengurus</a></li>
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
                        <h3 class="card-title"> <b>Tambah Data Pengurus</b> </h3>
                    </div>

                    <form action="/pengurus" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tahun_periode">Tahun Periode</label>
                                        <input type="text" name="tahun_periode" class="form-control"
                                            placeholder="Tahun Periode" autocomplete="off">
                                    </div>
                                    @error('tahun_periode')
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
                            <button type="submit" class="btn btn-primary btn-sm toastrDefaultSuccess" data-toggle="tooltip"
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
