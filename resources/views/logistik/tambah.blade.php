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
                        {{-- <h5 class="m-0 float-sm-left">#</h5> --}}
                        {{-- <a href="/logistik" class="m-0 float-sm-left btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="top" title="Kembali"> <i class="fas fa-step-backward"></i> </a> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Logistik</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- CARD DASHBOARD --}}
                {{-- <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div> --}}
                {{-- CARD DASHBOARD --}}

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Tambah Data Logistik</b> </h3>
                    </div>

                    <form action="/logistik" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama">
                                    </div>
                                    @error('nama')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="merek">Merek</label>
                                        <input type="text" name="merek" class="form-control" placeholder="Merek">
                                    </div>
                                    @error('merek')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Status</option>
                                            <option value="1">Layak</option>
                                            <option value="0">Tidak Layak</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="merek">Keterangan</label>
                                        <textarea name="keterangan" id="summernote" class="form-control" placeholder="Keterangan"></textarea>
                                    </div>
                                    @error('merek')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="nomor">Nomor</label>
                                        <input type="text" name="nomor" class="form-control" placeholder="Nomor">
                                    </div>
                                    @error('nomor')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="tahun_pembelian">Tahun Pembelian</label>
                                        <input type="number" name="tahun_pembelian" class="form-control"
                                            placeholder="Tahun Pembelian">
                                    </div>
                                    @error('tahun_pembelian')
                                        <div class="alert alert-danger">
                                            Data Wajib Di Isi
                                        </div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="pemakaian">Pemakaian</label>
                                        <select name="pemakaian" class="form-control">
                                            <option value="">Pemakaian</option>
                                            <option value="1">Tersedia</option>
                                            <option value="0">Tidak Tersedia</option>
                                        </select>
                                    </div>
                                    @error('pemakaian')
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
                                                <label class="custom-file-label">Pilih Foto</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <div class="img-thumbnail mt-2">
                                            <img id="image-preview" alt="Foto" style="width: 80px; height: 93px;" />
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
                            <button type="submit" class="btn btn-primary btn-sm toastrDefaultSuccess" data-toggle="tooltip"
                                data-placement="bottom" title="Simpan"> <i class="fas fa-save fa-lg"></i> </i>
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </section>

    </div>
    {{-- ======================================== --}}
@endsection
