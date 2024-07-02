@extends('layout.master')

@section('judul')
    Surat Keluar
@endsection

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        {{-- <a onclick="return printArea('area')" class="m-0 float-sm-left btn btn-danger btn-sm"
                            data-toggle="tooltip" data-placement="top" title="Print"> <i class="fas fa-print"></i> </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dokumen</a></li>
                            <li class="breadcrumb-item"><a href="#">Surat Keluar</a></li>
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
                        <h3 class="card-title"> <b>Detail Data Surat Keluar</b> </h3>
                    </div>

                    <div class="card-body">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <iframe src="{{ asset('suratkeluar-file/' . $suratkeluar->file) }}" height="400"
                                        width="550" class="card"></iframe>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h2 class="my-3"> <b>{{ $suratkeluar->tujuan }}</b> </h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <p>Nomor</p>
                                            <p>Tanggal</p>
                                            <p>Perihal</p>
                                        </div>
                                        <div class="col">
                                            <p>: {{ $suratkeluar->nomor }}</p>
                                            <p>: {{ $suratkeluar->tanggal }}</p>
                                            <p>: {{ $suratkeluar->perihal }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="keterangan-tab" data-toggle="tab"
                                            href="#keterangan" role="tab" aria-controls="keterangan"
                                            aria-selected="true">Isi
                                        </a>
                                        <a class="nav-item nav-link" id="memuat-tab" data-toggle="tab" href="#memuat"
                                            role="tab" aria-controls="memuat" aria-selected="false">Riwayat
                                        </a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="keterangan" role="tabpanel"
                                        aria-labelledby="keterangan-tab">
                                        <div class="summernote">{!! $suratkeluar->isi !!}</div>
                                    </div>

                                    <div class="tab-pane fade" id="memuat" role="tabpanel" aria-labelledby="memuat-tab">
                                        Pembuatan Data : {{ $suratkeluar->created_at }}
                                        <br>
                                        Pembaharuan Data : {{ $suratkeluar->updated_at }}
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
