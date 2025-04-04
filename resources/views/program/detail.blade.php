@extends('layout.master')

@section('judul')
    Program
@endsection

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
                        <h3 class="card-title"> <b>Detail Data Program</b> </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <iframe src="{{ asset('proposal-file/' . $program->proposal) }}" height="400"
                                                width="660" class="card d-block w-100">
                                            </iframe>
                                        </div>
                                        <div class="carousel-item">
                                            <iframe src="{{ asset('lpj-file/' . $program->lpj) }}" height="400"
                                                width="660" class="card d-block w-100">
                                            </iframe>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-target="#carouselExampleControls" data-slide="prev">
                                        <span aria-hidden="true"><i class="fa fa-chevron-left fa-2x"
                                                style="color: black;"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-target="#carouselExampleControls" data-slide="next">
                                        <span aria-hidden="true"><i class="fa fa-chevron-right fa-2x"
                                                style="color: black;"></i></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <h2 class="my-3"> <b>{{ $program->nama }}</b> </h2>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p>Jenis</p>
                                        <p>Status</p>
                                        <p>Tanggal Pelaksanaan</p>
                                        <p>Tahun Periode</p>
                                    </div>
                                    <div class="col">
                                        <p>:
                                            @if ($program->jenis == '1')
                                                Wajib
                                            @elseif ($program->jenis == '2')
                                                Pilihan
                                            @elseif ($program->jenis == '3')
                                                Insidentil
                                            @endif
                                        </p>
                                        <p>: {{ $program->status }}</p>
                                        <p>: {{ $program->tgl_mulai }} - {{ $program->tgl_selesai }}</p>
                                        <p>: {{ $program->pengurus->tahun_periode }}</p>
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
                                    <a class="nav-item nav-link" id="panitia-tab" data-toggle="tab" href="#panitia"
                                        role="tab" aria-controls="panitia" aria-selected="false">Panitia
                                    </a>
                                    <a class="nav-item nav-link" id="memuat-tab" data-toggle="tab" href="#memuat"
                                        role="tab" aria-controls="memuat" aria-selected="false">Riwayat
                                    </a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="keterangan" role="tabpanel"
                                    aria-labelledby="keterangan-tab">
                                    <div class="summernote">{!! $program->deskripsi !!}</div>
                                </div>

                                <div class="tab-pane fade" id="panitia" role="tabpanel" aria-labelledby="panitia-tab">
                                    @if ($program->panitia->isEmpty())
                                        <p>Tidak Ada Panitia Terdaftar</p>
                                    @else
                                        <ul>
                                            @foreach ($program->panitia as $panitia)
                                                <li>{{ $panitia->nama }} : {{ $panitia->pivot->role }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="memuat" role="tabpanel" aria-labelledby="memuat-tab">
                                    Pembuatan Data : {{ $program->created_at }}
                                    <br>
                                    Pembaharuan Data : {{ $program->updated_at }}
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
