@extends('layout.master')

@section('judul')
    Program
@endsection

@push('script')
    {{-- Select 2 Multiple --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        <a href="/program" class="mx-2 float-sm-left btn btn-primary" data-toggle="tooltip" data-placement="top"
                            title="Kembali"> <i class="fas fa-step-backward"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Program</a></li>
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
                        <h3 class="card-title"> <b>Tambah Data Program</b> </h3>
                    </div>

                    <form action="/program" method="POST" enctype="multipart/form-data">
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
                                        <label for="tgl_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" class="form-control"
                                            placeholder="Tanggal Mulai" autocomplete="off" value="{{ old('tgl_mulai') }}">
                                    </div>
                                    @error('tgl_mulai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="pengurus_id">Tahun Periode</label>
                                        <select name="pengurus_id" class="form-control">
                                            <option value="" disabled selected>Tahun Periode</option>
                                            @foreach ($pengurus as $data)
                                                <option value="{{ $data->id }}">{{ $data->tahun_periode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pengurus_id')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="summernote" class="form-control" placeholder="Deskripsi"></textarea>
                                    </div>
                                    @error('deskripsi')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="proposal">Proposal</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="proposal" class="custom-file-input"
                                                            onchange="previewImage('image-source1', 'image-preview1');"
                                                            id="image-source1">
                                                        <label class="custom-file-label">File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Unggah</span>
                                                    </div>
                                                </div>
                                                <div class="product-image-thumb mt-2">
                                                    <embed src="{{ asset('proposal-file/no-document.pdf') }}" width="95"
                                                        height="88" id="image-preview1" alt="Pratinjau File" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lpj">Laporan Pertanggung Jawaban</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="lpj" class="custom-file-input"
                                                            onchange="previewImage('image-source2', 'image-preview2');"
                                                            id="image-source2">
                                                        <label class="custom-file-label">File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Unggah</span>
                                                    </div>
                                                </div>
                                                <div class="product-image-thumb mt-2">
                                                    <embed src="{{ asset('lpj-file/no-document.pdf') }}" width="95"
                                                        height="88" id="image-preview2" alt="Pratinjau File" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Program</label>
                                        <select name="jenis" class="form-control">
                                            <option value="" disabled selected>Jenis Program</option>
                                            <option value="1">Wajib</option>
                                            <option value="2">Pilihan</option>
                                            <option value="3">Insidentil</option>
                                        </select>
                                    </div>
                                    @error('jenis')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="tgl_selesai">Tanggal Selesai</label>
                                        <input type="date" name="tgl_selesai" class="form-control"
                                            placeholder="Tanggal Selesai" autocomplete="off"
                                            value="{{ old('tgl_selesai') }}">
                                    </div>
                                    @error('tgl_selesai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    {{-- <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Tunggu">Tunggu</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror --}}

                                    <input type="hidden" name="status" class="form-control" autocomplete="off"
                                        value="Tunggu">

                                    <div class="form-group">
                                        <label for="ketua_id">Ketua</label>
                                        <select name="ketua_id" class="form-control" data-placeholder="Ketua">
                                            <option value="#" disabled selected>Ketua</option>
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ketua_id')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="sekretaris_id">Sekretaris</label>
                                        <select name="sekretaris_id" class="form-control" data-placeholder="Sekretaris">
                                            <option value="#" disabled selected>Sekretaris</option>
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sekretaris_id')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="bendahara_id">Bendahara</label>
                                        <select name="bendahara_id" class="form-control" data-placeholder="Bendahara">
                                            <option value="#" disabled selected>Bendahara</option>
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bendahara_id')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="anggota_id">Anggota</label>
                                        <select name="anggota_id[]" class="form-control select2" multiple="multiple"
                                            data-placeholder="Anggota">
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('anggota_id')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    {{-- <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="proposal">Proposal</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="proposal" class="custom-file-input"
                                                            onchange="previewImage('image-source1', 'image-preview1');"
                                                            id="image-source1">
                                                        <label class="custom-file-label">File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Unggah</span>
                                                    </div>
                                                </div>
                                                <div class="product-image-thumb mt-2">
                                                    <embed src="{{ asset('proposal-file/no-document.pdf') }}"
                                                        width="95" height="88" id="image-preview1"
                                                        alt="Pratinjau File" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="lpj">Laporan Pertanggung Jawaban</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="lpj" class="custom-file-input"
                                                            onchange="previewImage('image-source2', 'image-preview2');"
                                                            id="image-source2">
                                                        <label class="custom-file-label">File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Unggah</span>
                                                    </div>
                                                </div>
                                                <div class="product-image-thumb mt-2">
                                                    <embed src="{{ asset('lpj-file/no-document.pdf') }}" width="95"
                                                        height="88" id="image-preview2" alt="Pratinjau File" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

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
