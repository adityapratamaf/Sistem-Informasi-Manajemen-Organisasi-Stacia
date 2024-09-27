@extends('layout.master')

@section('judul')
    Program
@endsection

@push('script')
    {{-- Select 2 --}}
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
                        {{-- <h5 class="m-0 float-sm-left">#</h5> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Program</a></li>
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
                        <h3 class="card-title"> <b>Ubah Data Program</b> </h3>
                    </div>

                    <form action="/program/{{ $program->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama"
                                            autocomplete="off" value="{{ $program->nama }}">
                                    </div>
                                    @error('nama')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="tgl_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" class="form-control"
                                            placeholder="Tanggal Mulai" autocomplete="off"
                                            value="{{ $program->tgl_mulai }}">
                                    </div>
                                    @error('tgl_mulai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="pengurus_id">Tahun Periode</label>
                                        <select class="form-control" name="pengurus_id" id="pengurus_id">
                                            @foreach ($pengurus as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ old('pengurus_id', $pengurusId) == $data->id ? 'selected' : '' }}>
                                                    {{ $data->tahun_periode }}
                                                </option>
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
                                        <textarea name="deskripsi" id="summernote" class="form-control" placeholder="Deskripsi">{{ $program->deskripsi }}</textarea>
                                    </div>
                                    @error('deskripsi')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Program</label>
                                        <select name="jenis" class="form-control">
                                            <option value="1" {{ $program->jenis == 1 ? 'selected' : '' }}>Wajib
                                            </option>
                                            <option value="2" {{ $program->jenis == 2 ? 'selected' : '' }}>Pilihan
                                            </option>
                                            <option value="3" {{ $program->jenis == 3 ? 'selected' : '' }}>
                                                Insidentil
                                            </option>
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
                                            value="{{ $program->tgl_selesai }}">
                                    </div>
                                    @error('tgl_selesai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Tunggu" {{ $program->status == 'Tunggu' ? 'selected' : '' }}>
                                                Tunggu
                                            </option>
                                            <option value="Sukses" {{ $program->status == 'Sukses' ? 'selected' : '' }}>
                                                Sukses
                                            </option>
                                            <option value="Batal" {{ $program->status == 'Batal' ? 'selected' : '' }}>
                                                Batal
                                            </option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="users_id[]">Panitia</label>
                                        <select name="users_id[]" class="form-control select2" multiple="multiple"
                                            data-placeholder="Panitia">
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ in_array($data->id, $panitia) ? 'selected' : '' }}>
                                                    {{ $data->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('users_id[]')
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
                                                    <embed src="{{ asset('proposal-file/' . $program->proposal) }}"
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
                                                    <embed src="{{ asset('lpj-file/' . $program->lpj) }}" width="95"
                                                        height="88" id="image-preview2" alt="Pratinjau File" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
