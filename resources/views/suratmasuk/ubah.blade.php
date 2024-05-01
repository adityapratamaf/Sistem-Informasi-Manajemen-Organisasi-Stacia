@extends('layout.master')

@section('judul')
    Surat Masuk
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <a href="/logistik" class="m-0 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Kembali"> <i class="fas fa-step-backward"></i> </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Surat Masuk</a></li>
                            <li class="breadcrumb-item active">Ubah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Ubah Data Surat Masuk</b> </h3>
                    </div>

                    <form action="/suratmasuk/{{ $suratmasuk->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nomor">Nomor</label>
                                        <input type="text" name="nomor" class="form-control" placeholder="Nomor"
                                            autocomplete="off" value="{{ $suratmasuk->nomor }}">
                                    </div>
                                    @error('nomor')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" name="perihal" class="form-control" placeholder="Perihal"
                                            autocomplete="off" value="{{ $suratmasuk->perihal }}">
                                    </div>
                                    @error('perihal')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="isi">Isi</label>
                                        <textarea name="isi" id="summernote" class="form-control" placeholder="Isi">{{ $suratmasuk->isi }}</textarea>
                                    </div>
                                    @error('isi')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal"
                                            autocomplete="off" value="{{ $suratmasuk->tanggal }}">
                                    </div>
                                    @error('tanggal')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="asal">Asal</label>
                                        <input type="text" name="asal" class="form-control" placeholder="Asal"
                                            autocomplete="off" value="{{ $suratmasuk->asal }}">
                                    </div>
                                    @error('asal')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                    onchange="previewImage();" id="image-source">
                                                <label class="custom-file-label">File</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Unggah</span>
                                            </div>
                                        </div>
                                        <div class="product-image-thumb mt-2">
                                            <embed src="{{ asset('suratmasuk-file/' . $suratmasuk->file) }}" width="95"
                                                height="88" id="image-preview" alt="Pratinjau File" />
                                        </div>
                                    </div>
                                    @error('file')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip"
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
