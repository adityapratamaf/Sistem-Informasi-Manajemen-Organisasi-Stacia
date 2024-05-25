@extends('layout.master')

@section('judul')
    Anggota
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
                            <li class="breadcrumb-item"><a href="#">Anggota</a></li>
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
                        <h3 class="card-title"> <b>Tambah Data Anggota</b> </h3>
                    </div>

                    <form action="/anggota" method="POST" enctype="multipart/form-data">
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
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control"
                                            placeholder="Tempat Lahir" autocomplete="off" value="{{ old('tempat_lahir') }}">
                                    </div>
                                    @error('tempat_lahir')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="jenis_anggota">Jenis Anggota</label>
                                        <select name="jenis_anggota" class="form-control">
                                            <option value="" disabled selected>Jenis Anggota</option>
                                            <option value="1">Anggota Biasa</option>
                                            <option value="2">Anggota Istimewa</option>
                                            <option value="3">Anggota Luar Biasa</option>
                                            <option value="4">Anggota Kehormatan</option>
                                        </select>
                                    </div>
                                    @error('jenis_anggota')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username"
                                            autocomplete="off" value="{{ old('username') }}">
                                    </div>
                                    @error('username')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            autocomplete="off" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                            autocomplete="off" value="{{ old('alamat') }}">
                                    </div>
                                    @error('alamat')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="pengalaman">Pengalaman</label>
                                        <textarea name="pengalaman" id="summernote" class="form-control" placeholder="Pengalaman"></textarea>
                                    </div>
                                    @error('pengalaman')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomor">Nomor Registrasi Anggota</label>
                                        <input type="text" name="nra" class="form-control"
                                            placeholder="Nomor Registrasi Anggota" autocomplete="off"
                                            value="{{ old('nra') }}">
                                    </div>
                                    @error('nra')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control"
                                            placeholder="Tanggal Lahir" autocomplete="off"
                                            value="{{ old('tanggal_lahir') }}">
                                    </div>
                                    @error('tanggal_lahir')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="role">Jenis Akun</label>
                                        <select name="role" class="form-control">
                                            <option value=""disabled selected>Jenis Akun</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Sekertaris</option>
                                            <option value="3">Bendahara</option>
                                            <option value="4">Logistik</option>
                                            <option value="5">User</option>
                                        </select>
                                    </div>
                                    @error('role')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" autocomplete="off" value="{{ old('password') }}"
                                            disabled>
                                    </div>
                                    {{-- @error('password')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror --}}

                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="number" name="telepon" class="form-control" placeholder="Telepon"
                                            autocomplete="off" value="{{ old('telepon') }}">
                                    </div>
                                    @error('telepon')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="status">Status Akun</label>
                                        <select name="status" class="form-control">
                                            <option value=""disabled selected>Status Akun</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input"
                                                    onchange="previewImage();" id="image-source">
                                                <label class="custom-file-label">Foto</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Unggah</span>
                                            </div>
                                        </div>
                                        <div class="product-image-thumb mt-2">
                                            <img src="{{ asset('anggota-foto/no-image.png') }}" id="image-preview"
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
                            <button type="submit" class="btn btn-primary btn-sm toastrDefaultSuccess"
                                data-toggle="tooltip" data-placement="bottom" title="Simpan"> <i
                                    class="fas fa-database"></i> </i>
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection
