@extends('layout.master')

@section('judul')
    Profil
@endsection

@push('script')
    <!-- Ubah Password -->
    <script>
        // Ambil Elemen Checkbox & Input
        const checkbox = document.getElementById('on');
        const input = document.getElementById('ubah');

        // Tambahkan Event Listener Di Checkbox
        checkbox.addEventListener('change', function() {
            // Jika Checkbox Di Centang, Aktifkan Tombol
            if (this.checked) {
                input.disabled = false;
            } else {
                // Jika Checkbox Tidak Di Centang, Nonaktifkan Input Form
                input.disabled = true;
            }
        });
    </script>

    <!-- Rahasia Password -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lockIcon = document.querySelector('.fas.fa-lock');
            const passwordInput = document.querySelector('input[type="password"]');

            lockIcon.addEventListener('click', function() {
                // Periksa Apakah Input Saat Ini Dalam Bentuk Password
                if (passwordInput.type === "password") {
                    // Jika Iya, Bbah Ke Teks 
                    passwordInput.type = "text";
                    lockIcon.classList.remove('fa-lock');
                    lockIcon.classList.add('fa-unlock');
                } else {
                    // Jika Tidak, Kembalikan Ke Bentuk Password
                    passwordInput.type = "password";
                    lockIcon.classList.remove('fa-unlock');
                    lockIcon.classList.add('fa-lock');
                }
            });
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
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Profil</a></li>
                            <li class="breadcrumb-item active">Daftar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('anggota-foto/' . $anggota->foto) }}" alt="Profil">
                                </div>
                                <h3 class="profile-username text-center">{{ $anggota->user->nama }}</h3>
                                <p class="text-muted text-center">{{ $anggota->nra }}</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Status Anggota</b> <a class="float-right">
                                            @if ($anggota->jenis_anggota == 1)
                                                Anggota Biasa
                                            @elseif ($anggota->jenis_anggota == 2)
                                                Anggota Istimewa
                                            @elseif ($anggota->jenis_anggota == 3)
                                                Anggota Luar Biasa
                                            @elseif ($anggota->jenis_anggota == 4)
                                                Anggota Kehormatan
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tempat Lahir</b> <a class="float-right">{{ $anggota->tempat_lahir }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Lahir</b> <a class="float-right">{{ $anggota->tanggal_lahir }}</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profil</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i>Username</strong>
                                <p class="text-muted">{{ $anggota->user->username }}</p>
                                <hr>
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted">{{ $anggota->user->email }}</p>
                                <hr>
                                <strong><i class="fas fa-phone-alt mr-1"></i> Telepon</strong>
                                <p class="text-muted">{{ $anggota->telepon }}</p>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                <p class="text-muted">{{ $anggota->alamat }}</p>
                                <hr>
                                <strong><i class="fas fa-calendar mr-1"></i> Terdaftar</strong>
                                <p class="text-muted">{{ $anggota->created_at }}</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Pengalaman</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab">Pengaturan</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">

                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('anggota-foto/' . $anggota->foto) }}" alt="user image">
                                                <span class="username">
                                                    <a href="#">{{ $anggota->user->nama }}</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">{{ $anggota->nra }}</span>
                                            </div>

                                            <div class="summernote">
                                                <p>
                                                    {!! $anggota->pengalaman !!}
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="settings">

                                        <form action="/profil/{{ $anggota->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Email" autocomplete="off"
                                                            value="{{ $anggota->user->email }}">
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger">
                                                            Data Wajib Di Isi
                                                        </div>
                                                    @enderror

                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control"
                                                            placeholder="Alamat" autocomplete="off"
                                                            value="{{ $anggota->alamat }}">
                                                    </div>
                                                    @error('alamat')
                                                        <div class="alert alert-danger">
                                                            Data Wajib Di Isi
                                                        </div>
                                                    @enderror

                                                    <div class="form-group">
                                                        <label for="pengalaman">Pengalaman</label>
                                                        <textarea name="pengalaman" id="summernote" class="form-control" placeholder="Pengalaman">{{ $anggota->pengalaman }}</textarea>
                                                    </div>
                                                    @error('pengalaman')
                                                        <div class="alert alert-danger">
                                                            Data Wajib Di Isi
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="checkbox" id="on">
                                                        {{-- <input type="password" id="ubah" name="password"
                                                            class="form-control" placeholder="Password"
                                                            autocomplete="off" value="" disabled> --}}

                                                        <div class="input-group mb-3">
                                                            <input type="password" id="ubah" name="password"
                                                                class="form-control" placeholder="Password"
                                                                autocomplete="off" value="" disabled>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-lock"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="telepon">Telepon</label>
                                                        <input type="number" name="telepon" class="form-control"
                                                            placeholder="Telepon" autocomplete="off"
                                                            value="{{ $anggota->telepon }}">
                                                    </div>
                                                    @error('telepon')
                                                        <div class="alert alert-danger">
                                                            Data Wajib Di Isi
                                                        </div>
                                                    @enderror

                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="foto"
                                                                    class="custom-file-input" onchange="previewImage();"
                                                                    id="image-source">
                                                                <label class="custom-file-label">Foto</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Unggah</span>
                                                            </div>
                                                        </div>
                                                        <div class="product-image-thumb mt-2">
                                                            <img src="{{ asset('anggota-foto/' . $anggota->foto) }}"
                                                                id="image-preview" alt="Pratinjau Foto" />
                                                        </div>
                                                    </div>
                                                    @error('foto')
                                                        <div class="alert alert-danger">
                                                            Data Wajib Di Isi
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                data-placement="bottom" title="Simpan"> <i class="fas fa-database"></i>
                                                </i>
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection
