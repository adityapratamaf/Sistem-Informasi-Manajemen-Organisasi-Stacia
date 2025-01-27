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
                        {{-- <h5 class="m-0 float-sm-left">#</h5> --}}
                        {{-- <a href="/logistik" class="m-0 float-sm-left btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="Kembali"> <i class="fas fa-step-backward"></i> </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Logistik</a></li>
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
                        <h3 class="card-title"> <b>Tambah Data Logistik</b> </h3>
                    </div>

                    <form action="/logistik" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama"
                                            autocomplete="off" value="{{ old('nama') }}">
                                    </div>
                                    @error('nama')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="merek">Merek</label>
                                        <input type="text" name="merek" class="form-control" placeholder="Merek"
                                            autocomplete="off" value="{{ old('merek') }}">
                                    </div>
                                    @error('merek')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Status</option>
                                            <option value="1">Layak</option>
                                            <option value="0">Tidak Layak</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="merek">Keterangan</label>
                                        <textarea name="keterangan" id="summernote" class="form-control" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
                                    </div>
                                    @error('merek')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nomor">Nomor</label>
                                        <input type="text" name="nomor" class="form-control" placeholder="Nomor"
                                            autocomplete="off" value="{{ old('nomor') }}">
                                    </div>
                                    @error('nomor')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="tahun_pembelian">Tahun Pembelian</label>
                                        <input type="number" name="tahun_pembelian" class="form-control"
                                            placeholder="Tahun Pembelian" autocomplete="off"
                                            value="{{ old('tahun_pembelian') }}">
                                    </div>
                                    @error('tahun_pembelian')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="pemakaian">Pemakaian</label>
                                        <select name="pemakaian" class="form-control">
                                            <option value="">Pemakaian</option>
                                            <option value="1">Tersedia</option>
                                            <option value="0">Tidak Tersedia</option>
                                        </select>
                                    </div>
                                    @error('pemakaian')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input"
                                                    onchange="previewImage('image-source1', 'image-preview1');"
                                                    id="image-source1">
                                                <label class="custom-file-label">Foto</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Unggah</span>
                                            </div>
                                        </div>
                                        <div class="product-image-thumb mt-2">
                                            <img src="{{ asset('logistik-foto/no-image.png') }}" id="image-preview1"
                                                alt="Pratinjau Foto" />
                                        </div>
                                    </div>
                                    @error('foto')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
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
