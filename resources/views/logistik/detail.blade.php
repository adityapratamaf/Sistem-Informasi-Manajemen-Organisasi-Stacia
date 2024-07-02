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
                        {{-- <h5 class="m-0 float-sm-left"> # </h5> --}}
                        <a onclick="return printArea('area')" class="m-0 float-sm-left btn btn-danger btn-sm"
                            data-toggle="tooltip" data-placement="top" title="Print"> <i class="fas fa-print"></i> </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Logistik</a></li>
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
                        <h3 class="card-title"> <b>Detail Data Logistik</b> </h3>
                    </div>

                    <div class="card-body">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <img src="{{ asset('logistik-foto/' . $logistik->foto) }}" class="card product-image"
                                        style="max-height: 400px; max-width: 550px;">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h2 class="my-3"> <b>{{ $logistik->nama }}</b> </h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <p>Nomor</p>
                                            <p>Merek</p>
                                            <p>Tahun Pembelian</p>
                                            <p>Status</p>
                                            <p>Pemakaian</p>
                                        </div>
                                        <div class="col">
                                            <p>: {{ $logistik->nomor }}</p>
                                            <p>: {{ $logistik->merek }}</p>
                                            <p>: {{ $logistik->tahun_pembelian }}</p>
                                            <p>: @if ($logistik->status == 1)
                                                    <span class="badge badge-success">LAYAK</span>
                                                @else
                                                    <span class="badge badge-danger">TIDAK LAYAK</span>
                                                @endif
                                            </p>
                                            <p>
                                                : @if ($logistik->pemakaian == 1)
                                                    <span class="badge badge-success">TERSEDIA</span>
                                                @else
                                                    <span class="badge badge-warning">TIDAK TERSEDIA</span>
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
                                            aria-selected="true">Keterangan
                                        </a>
                                        <a class="nav-item nav-link" id="memuat-tab" data-toggle="tab" href="#memuat"
                                            role="tab" aria-controls="memuat" aria-selected="false">Riwayat
                                        </a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="keterangan" role="tabpanel"
                                        aria-labelledby="keterangan-tab">
                                        <div class="summernote">{!! $logistik->keterangan !!}</div>
                                    </div>

                                    <div class="tab-pane fade" id="memuat" role="tabpanel" aria-labelledby="memuat-tab">
                                        Pembuatan Data : {{ $logistik->created_at }}
                                        <br>
                                        Pembaharuan Data : {{ $logistik->updated_at }}
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
