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
                        <div class="card card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots
                                            Review</h3>
                                        <div class="col-12">
                                            <img src="{{ asset('logistik-foto/' . $logistik->foto) }}" class="product-image"
                                                alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img
                                                    src="{{ asset('logistik-foto/' . $logistik->foto) }}"
                                                    alt="Product Image">
                                            </div>
                                            <div class="product-image-thumb"><img
                                                    src="{{ asset('logistik-foto/' . $logistik->foto) }}"
                                                    alt="Product Image">
                                            </div>
                                            <div class="product-image-thumb"><img
                                                    src="{{ asset('logistik-foto/' . $logistik->foto) }}"
                                                    alt="Product Image">
                                            </div>
                                            <div class="product-image-thumb"><img
                                                    src="{{ asset('logistik-foto/' . $logistik->foto) }}"
                                                    alt="Product Image">
                                            </div>
                                            <div class="product-image-thumb"><img
                                                    src="{{ asset('logistik-foto/' . $logistik->foto) }}"
                                                    alt="Product Image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h2 class="my-3"> <b>{{ $logistik->nama }}</b> </h2>
                                        <p>{{ $logistik->nomor }}</p>
                                        <hr>
                                        <h4>Merek</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-default text-center active">
                                                <input type="radio" name="color_option" id="color_option_a1"
                                                    autocomplete="off" checked>
                                                {{ $logistik->merek }}
                                            </label>
                                        </div>
                                        <h4 class="mt-3">Tahun Pembelian</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-default text-center">
                                                <input type="radio" name="color_option" id="color_option_b1"
                                                    autocomplete="off">
                                                {{ $logistik->tahun_pembelian }}
                                            </label>
                                        </div>
                                        <h4 class="mt-3">Status Logistik</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-default text-center">
                                                <input type="radio" name="color_option" id="color_option_b1"
                                                    autocomplete="off">
                                                @if ($logistik->status == 1)
                                                    <span class="badge badge-success">LAYAK</span>
                                                @else
                                                    <span class="badge badge-warning">TIDAK LAYAK</span>
                                                @endif
                                            </label>
                                        </div>
                                        <h4 class="mt-3">Pemakaian</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-default text-center">
                                                <input type="radio" name="color_option" id="color_option_b1"
                                                    autocomplete="off">
                                                @if ($logistik->pemakaian == 1)
                                                    <span class="badge badge-success">TERSEDIA</span>
                                                @else
                                                    <span class="badge badge-warning">TIDAK TERSEDIA</span>
                                                @endif
                                            </label>
                                        </div>
                                        <div class="alert alert-secondary py-2 px-3 mt-4">
                                            <h4 class="mt-0">
                                                <small>Nilai : </small>
                                            </h4>
                                            <h2 class="mb-0">
                                                Rp. 800.000
                                            </h2>
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
                                            <a class="nav-item nav-link" id="memuat-tab" data-toggle="tab"
                                                href="#memuat" role="tab" aria-controls="memuat"
                                                aria-selected="false">Riwayat
                                            </a>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="keterangan" role="tabpanel"
                                            aria-labelledby="keterangan-tab">
                                            <div class="summernote">{!! $logistik->keterangan !!}</div>
                                        </div>

                                        <div class="tab-pane fade" id="memuat" role="tabpanel"
                                            aria-labelledby="memuat-tab">
                                            Pembuatan Data : {{ $logistik->created_at }}
                                            <br>
                                            Pembaharuan Data : {{ $logistik->updated_at }}
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
