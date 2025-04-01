@extends('layout.master')

@section('judul')
    Program
@endsection

@push('script')
    {{-- Summernote --}}
    <script>
        $(document).ready(function() {
            $('#summernote2').summernote();
        });

        $(document).ready(function() {
            $('#summernote3').summernote();
        });

        $(document).ready(function() {
            $('#summernote4').summernote();
        });
    </script>
    {{-- Summernote --}}

    <script>
        $(function() {
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        function uploadfile() {
            var input = document.getElementById('file-input');
            var label = document.getElementById('file-label');
            var fileName = input.files[0].name;
            label.textContent = fileName;
        }
    </script>

    <script>
        function updatefile(id) {
            const input = document.getElementById('file-input-' + id);
            const label = document.getElementById('file-label-' + id);
            label.textContent = input.files[0].name;
        }
    </script>

    {{-- Select 2 Multiple --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@section('isi')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-0">

                    <div class="col-sm-6">
                        <!-- Tombol Kembali Halaman Program -->
                        <a href="/program" class="mx-2 float-sm-left btn btn-primary" data-toggle="tooltip" data-placement="top"
                            title="Kembali"> <i class="fas fa-step-backward"></i>
                        </a>
                        <!-- Tombol Print -->
                        @if ($isKetua || $isSekretaris)
                            <a href="/program/pekerjaan/{{ $program->id }}/download"
                                class="m-0 float-sm-left btn btn-danger" data-toggle="tooltip" data-placement="top"
                                title="Print" id="downloadBtn" target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Program</a></li>
                            <li class="breadcrumb-item active">Pekerjaan</li>
                        </ol>
                    </div>

                </div>

            </div>
        </div>

        <section class="content" id="area">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"> <b>Daftar Data Tugas {{ $program->nama }}</b> </h3>
                            </div>
                            <div class="card-body">

                                @if ($isKetua || $isSekretaris)
                                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal"
                                        data-target="#tambahtugas" data-toggle="tooltip" data-placement="top"
                                        title="Tambah">
                                        <i class="fas fa-database"></i>
                                    </a>
                                @endif

                                <table id="example2" class="table table-hover table-condensed">
                                    <colgroup>
                                        <col width="1%">
                                        <col width="30%">
                                        <col width="15%">
                                        @if ($isPanitia)
                                            <col width="20%">
                                        @endif
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            @if ($isPanitia)
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tugas as $key => $data)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $data->nama }}
                                                    <br>
                                                    <small class="sumernote">
                                                        <i class="fas fa-user"></i> :
                                                        {{ optional($data->users)->nama ?? 'Nama Tidak Tersedia' }}
                                                        <br>
                                                        {!! $data->deskripsi !!}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($data->status == 'Tunggu')
                                                        <span class="badge badge-primary">Tunggu</span>
                                                    @elseif ($data->status == 'Perbaikan')
                                                        <span class="badge badge-warning">Perbaikan</span>
                                                    @elseif ($data->status == 'Selesai')
                                                        <span class="badge badge-success">Selesai</span>
                                                    @endif
                                                </td>
                                                @if ($isPanitia)
                                                    <td>
                                                        <a href="" class="btn btn-info mx-2" data-toggle="modal"
                                                            data-target="#ubahtugas{{ $data->id }}"
                                                            data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                                class="fas fa-pen-alt"></i>
                                                        </a>
                                                        <form action="/tugas/destroy/{{ $data->id }}" class="d-inline"
                                                            method="POST" onclick="return confirm('Hapus Data ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger mx-2" data-toggle="tooltip"
                                                                data-placement="top" title="Hapus"> <i
                                                                    class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"> <b>Daftar Data Laporan {{ $program->nama }}</b> </h3>
                            </div>

                            <div class="card-body">

                                @if ($isPanitia)
                                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal"
                                        data-target="#tambahlaporan" data-toggle="tooltip" data-placement="top"
                                        title="Tambah">
                                        <i class="fas fa-database"></i>
                                    </a>
                                @endif

                                <table id="example3" class="table table-hover table-condensed">
                                    <colgroup>
                                        <col width="1%">
                                        <col width="30%">
                                        <col width="15%">
                                        @if ($isPanitia)
                                            <col width="20%">
                                        @endif
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            @if ($isPanitia)
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($laporan as $key => $data)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $data->tugas->nama }}
                                                    <br>
                                                    <small class="sumernote">
                                                        <i class="fas fa-calendar"></i> :
                                                        {{ date('d M Y', strtotime($data->tgl_mulai)) }} -
                                                        {{ date('d M Y', strtotime($data->tgl_selesai)) }}
                                                        <br>
                                                        <i class="fas fa-user"></i> : {{ $data->users->nama }}
                                                        <br>
                                                        <i class="fas fa-sticky-note"></i> :
                                                        @if ($data->file)
                                                            <a href="{{ route('laporan.file', ['laporan_id' => $data->id]) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                File
                                                            </a>
                                                        @endif
                                                        <br>
                                                        {!! $data->deskripsi !!}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($data->status == 'Tunggu')
                                                        <span class="badge badge-primary">Tunggu</span>
                                                    @elseif ($data->status == 'Perbaikan')
                                                        <span class="badge badge-warning">Perbaikan</span>
                                                    @elseif ($data->status == 'Selesai')
                                                        <span class="badge badge-success">Selesai</span>
                                                    @endif
                                                </td>
                                                @if ($isPanitia)
                                                    <td>
                                                        <a href="" class="btn btn-info mx-2" data-toggle="modal"
                                                            data-target="#ubahlaporan{{ $data->id }}"
                                                            data-toggle="tooltip" data-placement="top" title="Ubah"> <i
                                                                class="fas fa-pen-alt"></i>
                                                        </a>
                                                        <form action="/laporan/destroy/{{ $data->id }}"
                                                            class="d-inline" method="POST"
                                                            onclick="return confirm('Hapus Data ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger mx-2" data-toggle="tooltip"
                                                                data-placement="top" title="Hapus"> <i
                                                                    class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- ============================== Modal Tugas = Tambah Data ============================== --}}
    <div class="modal fade" id="tambahtugas" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel"> <b>Tambah Data Tugas {{ $program->nama }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('tugas/store', $program->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
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
                            <label for="users_id">Pelaksana</label>
                            <select name="users_id" class="form-control" data-placeholder="Pelaksana">
                                @foreach ($pelaksana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('users_id')
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

                        <input type="hidden" name="status" class="form-control" placeholder="Nama" autocomplete="off"
                            value="Tunggu">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary toastrDefaultSuccess" data-toggle="tooltip"
                            data-placement="bottom" title="Simpan"> <i class="fas fa-database"></i> </i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    {{-- ============================== Modal Tugas = Tambah Data ============================== --}}

    {{-- ============================== Modal Tugas = Ubah Data ============================== --}}
    @foreach ($tugas as $data)
        <div class="modal fade" id="ubahtugas{{ $data->id }}" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel"> <b>Ubah Data Tugas {{ $program->nama }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('tugas/update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama"
                                    autocomplete="off" value="{{ $data->nama }}">
                            </div>
                            @error('nama')
                                <div class="alert alert-danger">
                                    Data Wajib Di Isi
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="summernote2" class="form-control" placeholder="Deskripsi">{{ $data->deskripsi }}</textarea>
                            </div>
                            @error('deskripsi')
                                <div class="alert alert-danger">
                                    Data Wajib Di Isi
                                </div>
                            @enderror

                            @if ($isKetua)
                                <div class="form-group">
                                    <label for="users_id">Pelaksana</label>
                                    <select name="users_id" class="form-control" data-placeholder="Pelaksana">
                                        @foreach ($pelaksana as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('users_id')
                                    <div class="alert alert-danger">
                                        Data Wajib Di Isi
                                    </div>
                                @enderror
                            @endif

                            @if ($isKetua)
                                <div class="form-group">
                                    <label for="status">Status Tugas</label>
                                    <select name="status" class="form-control">
                                        <option value="Tunggu" {{ $data->status == 'Tunggu' ? 'selected' : '' }}>Tunggu
                                        </option>
                                        <option value="Perbaikan" {{ $data->status == 'Perbaikan' ? 'selected' : '' }}>
                                            Perbaikan</option>
                                        <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="alert alert-danger">
                                        Data Wajib Di Isi
                                    </div>
                                @enderror
                            @endif
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary toastrDefaultSuccess" data-toggle="tooltip"
                                data-placement="bottom" title="Simpan"> <i class="fas fa-database"></i> </i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach
    {{-- ============================== Modal Tugas = Ubah Data ============================== --}}

    {{-- ============================== Modal Laporan = Tambah Data ============================== --}}
    <div class="modal fade" id="tambahlaporan" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel"> <b>Tambah Data Laporan {{ $program->nama }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('laporan/store', $program->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        {{-- Select Jika Sudah Input Data Maka Disabled --}}
                        {{-- <div class="form-group">
                            <label for="tugas_id">Tugas</label>
                            <select name="tugas_id" class="form-control">
                                <option value="" disabled selected>Tugas</option>
                                @foreach ($tugas as $data)
                                    <option value="{{ $data->id }}"
                                        {{ optional($data->laporan)->isNotEmpty() ? 'disabled' : '' }}>
                                        {{ $data->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

                        {{-- Select Jika Sudah Input Data Maka Hilang --}}
                        <div class="form-group">
                            <label for="tugas_id">Tugas</label>
                            <select name="tugas_id" class="form-control">
                                <option value="" disabled selected>Tugas</option>
                                @foreach ($tugas as $data)
                                    @php
                                        // Memeriksa apakah ada laporan terkait dengan tugas ini
                                        $hasLaporan = $data->laporan()->exists();
                                    @endphp
                                    @if (!$hasLaporan)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('tugas_id')
                            <div class="alert alert-danger">
                                Data Wajib Di Isi
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="summernote3" class="form-control" placeholder="Deskripsi"></textarea>
                        </div>
                        @error('deskripsi')
                            <div class="alert alert-danger">
                                Data Wajib Di Isi
                            </div>
                        @enderror

                        <div class="row">
                            <div class="col">
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
                            </div>
                            <div class="col">
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
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="file-input"
                                        onchange="uploadfile()">
                                    <label class="custom-file-label" for="file-input" id="file-label">File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Unggah</span>
                                </div>
                            </div>
                        </div>
                        @error('file')
                            <div class="alert alert-danger">
                                Data Wajib Di Isi
                            </div>
                        @enderror

                        <input type="hidden" name="status" class="form-control" placeholder="Nama" autocomplete="off"
                            value="Tunggu">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary toastrDefaultSuccess" data-toggle="tooltip"
                            data-placement="bottom" title="Simpan"> <i class="fas fa-database"></i> </i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    {{-- ============================== Modal Tugas = Tambah Data ============================== --}}

    {{-- ============================== Modal Laporan = Ubah Data ============================== --}}
    @foreach ($laporan as $laporan)
        <div class="modal fade" id="ubahlaporan{{ $laporan->id }}" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel"> <b>Ubah Data Laporan {{ $program->nama }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('laporan/update', $laporan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tugas_id">Tugas</label>
                                <select name="tugas_id" class="form-control">
                                    <option value="{{ $laporan->tugas->id }}" selected>{{ $laporan->tugas->nama }}
                                    </option>
                                </select>
                            </div>
                            @error('tugas_id')
                                <div class="alert alert-danger">
                                    Data Wajib Di Isi
                                </div>
                            @enderror

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="summernote4" class="form-control" placeholder="Deskripsi">{{ $laporan->deskripsi }}</textarea>
                            </div>
                            @error('deskripsi')
                                <div class="alert alert-danger">
                                    Data Wajib Di Isi
                                </div>
                            @enderror

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tgl_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" class="form-control"
                                            placeholder="Tanggal Mulai" autocomplete="off"
                                            value="{{ $laporan->tgl_mulai }}">
                                    </div>
                                    @error('tgl_mulai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tgl_selesai">Tanggal Selesai</label>
                                        <input type="date" name="tgl_selesai" class="form-control"
                                            placeholder="Tanggal Selesai" autocomplete="off"
                                            value="{{ $laporan->tgl_selesai }}">
                                    </div>
                                    @error('tgl_selesai')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                    id="file-input-{{ $laporan->id }}"
                                                    onchange="updatefile('{{ $laporan->id }}')">
                                                <label class="custom-file-label" for="file-input-{{ $laporan->id }}"
                                                    id="file-label-{{ $laporan->id }}">
                                                    {{ $laporan->file ? $laporan->file : 'Pilih file' }}
                                                </label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Unggah</span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('file')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="status">Status Laporan</label>
                                        <select name="status" class="form-control">
                                            <option value="Tunggu" {{ $laporan->status == 'Tunggu' ? 'selected' : '' }}>
                                                Tunggu</option>
                                            <option value="Perbaikan"
                                                {{ $laporan->status == 'Perbaikan' ? 'selected' : '' }}>Perbaikan
                                            </option>
                                            <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                    </div>
                                    @error('status')
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
        </div>
    @endforeach
    {{-- ============================== Modal Laporan = Ubah Data ============================== --}}
@endsection
