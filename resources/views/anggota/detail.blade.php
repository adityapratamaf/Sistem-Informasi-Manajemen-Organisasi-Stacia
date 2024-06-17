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
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a onclick="return printArea('area')" class="m-0 float-sm-left btn btn-danger btn-sm"
                            data-toggle="tooltip" data-placement="top" title="Print"> <i class="fas fa-print"></i> </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Anggota</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content" id="area">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Detail Data Anggota</b> </h3>
                    </div>

                    <div class="card-body">
                        <div class="card card-solid">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-6 px-3">
                                        <img src="{{ asset('anggota-foto/' . $anggota->foto) }}" class="card product-image"
                                            height="400" width="550">
                                    </div>

                                    <div class="col-12 col-sm-6 px-3">
                                        <h2 class="my-3"> <b>{{ $anggota->user->nama }}</b> </h2>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <p>Nomor Registrasi Anggota</p>
                                                <p>Status Anggota</p>
                                                <p>Tempat Tanggal Lahir</p>
                                                <p>Email</p>
                                                <p>Telepon</p>
                                                <p>Alamat</p>
                                                <p>Username</p>
                                                <p>Jenis Akun</p>
                                                <p>Status Akun</p>
                                            </div>
                                            <div class="col">
                                                <p>: {{ $anggota->nra }}</p>
                                                <p>:
                                                    @if ($anggota->jenis_anggota == 1)
                                                        Anggota Biasa
                                                    @elseif ($anggota->jenis_anggota == 2)
                                                        Anggota Istimewa
                                                    @elseif ($anggota->jenis_anggota == 3)
                                                        Anggota Luar Biasa
                                                    @elseif ($anggota->jenis_anggota == 4)
                                                        Anggota Kehormatan
                                                    @endif
                                                </p>
                                                <p>: {{ $anggota->tempat_lahir }}, {{ $anggota->tanggal_lahir }} </p>
                                                <p>: {{ $anggota->user->email }}</p>
                                                <p>: {{ $anggota->telepon }}</p>
                                                <p>: {{ $anggota->alamat }}</p>
                                                <p>: {{ $anggota->user->username }}</p>
                                                <p>:
                                                    @if ($anggota->user->role == 1)
                                                        Administrator
                                                    @else
                                                        User
                                                    @endif
                                                </p>
                                                <p>:
                                                    @if ($anggota->user->status == 1)
                                                        Aktif
                                                    @else
                                                        Tidak Aktif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <nav class="w-100">
                                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="keterangan-tab" data-toggle="tab"
                                                href="#keterangan" role="tab" aria-controls="keterangan"
                                                aria-selected="true">Pengalaman
                                            </a>
                                            <a class="nav-item nav-link" id="memuat-tab" data-toggle="tab" href="#memuat"
                                                role="tab" aria-controls="memuat" aria-selected="false">Riwayat
                                            </a>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="keterangan" role="tabpanel"
                                            aria-labelledby="keterangan-tab">
                                            <div class="summernote">{!! $anggota->pengalaman !!}</div>
                                        </div>

                                        <div class="tab-pane fade" id="memuat" role="tabpanel"
                                            aria-labelledby="memuat-tab">
                                            Pembuatan Data : {{ $anggota->created_at }}
                                            <br>
                                            Pembaharuan Data : {{ $anggota->updated_at }}
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
