@extends('layout.master')

@section('judul')
    Dashboard
@endsection

@push('script')
    {{-- Grafik Program Masing-Masing Tampilan Status --}}
    <script>
        const labels = @json($labels);
        const dataSukses = @json($dataSukses);
        const dataBatal = @json($dataBatal);
        const dataTunggu = @json($dataTunggu);

        const ctx = document.getElementById('programChart').getContext('2d');
        const programChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Program Sukses',
                        data: dataSukses,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Program Batal',
                        data: dataBatal,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Program Tunggu',
                        data: dataTunggu,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100, // Maksimal 100% untuk persentase
                        ticks: {
                            callback: function(value) {
                                return value + "%"; // Tambahkan simbol %
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
    {{-- Grafik Program Masing-Masing Tampilan Status --}}
@endpush

@section('isi')
    {{-- ======================================== --}}
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-sm-6">
                        <h5 class="m-0 float-sm-left"></h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- CARD DASHBOARD 1 --}}
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalAnggota }}</h3>
                                <p>Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">Anggota <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalLogistik }}</h3>
                                <p>Logistik</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Logistik <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $dataProgram }}</h3>
                                <p>Program</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">Program <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $dataPengurus }}</h3>
                                <p>Pengurus</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                {{-- CARD DASHBOARD 1 --}}

                {{-- CARD DASHBOARD 2 --}}
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Surat Masuk</span>
                                <span class="info-box-number">
                                    {{ $totalSuratMasuk }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-alt"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Surat Keluar</span>
                                <span class="info-box-number">{{ $totalSuratKeluar }}</span>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Surat Keterangan</span>
                                <span class="info-box-number">{{ $totalSuratKeterangan }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Dokumen</span>
                                <span class="info-box-number">6</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- CARD DASHBOARD 2 --}}

                {{-- CARD DASHBOARD 3 --}}
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-server"></i></span>
                            <div class="info-box-content">
                                <div class="row">
                                    <div class="col">
                                        <span class="info-box-text">Jumlah Tugas</span>
                                        <span class="info-box-number">
                                            {{ $jumlahTugas }}
                                        </span>
                                    </div>

                                    <div class="col">
                                        <span class="info-box-text">Jumlah Tugas Selesai</span>
                                        <span class="info-box-number">
                                            {{ $jumlahTugasSelesai }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-server"></i></i></span>
                            <div class="info-box-content">

                                <div class="row">
                                    <div class="col">
                                        <span class="info-box-text">Jumlah Laporan</span>
                                        <span class="info-box-number">
                                            {{ $jumlahLaporan }}</span>
                                    </div>

                                    <div class="col">
                                        <span class="info-box-text">Jumlah Laporan Selesai</span>
                                        <span class="info-box-number">
                                            {{ $jumlahLaporanSelesai }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                {{-- CARD DASHBOARD 3 --}}

                {{-- CARD DASHBOARD 4 --}}
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Pemasukan</span>
                                <span class="info-box-number">
                                    Rp. {{ number_format($jumlahPemasukan, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                    class="fas fa-money-check"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Pengeluaran</span>
                                <span class="info-box-number">
                                    Rp. {{ number_format($jumlahPengeluaran, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- CARD DASHBOARD 4 --}}

                <div class="row">
                    {{-- Kiri --}}
                    <section class="col-lg-6 connectedSortable">

                        {{-- Pengumuman --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn mr-1"></i>
                                    Pengumuman
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    @foreach ($dataPengumuman as $pengumuman)
                                        <div class="timeline">
                                            <div class="time-label">
                                                <span
                                                    class="bg-success">{{ $pengumuman->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i
                                                            class="fas fa-clock mr-1"></i>{{ $pengumuman->created_at->diffForHumans() }}</span>
                                                    <h3 class="timeline-header"><a
                                                            href="#">{{ $pengumuman->judul }}</a> </h3>
                                                    <div class="timeline-body" style="text-align: justify;">
                                                        {!! $pengumuman->isi !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Grafik Program New --}}
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Program
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#chartProgramTunggu"
                                                data-toggle="tab">Tunggu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#chartProgramSukses" data-toggle="tab">Sukses</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#chartProgramBatal" data-toggle="tab">Batal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">

                                    <div class="chart tab-pane active" id="chartProgramTunggu"
                                        style="position: relative; width: 100%; margin: auto;">
                                        <canvas id="chartTunggu"></canvas>
                                    </div>

                                    <div class="chart tab-pane" id="chartProgramSukses"
                                        style="position: relative; width: 100%; margin: auto;">
                                        <canvas id="chartSukses"></canvas>
                                    </div>

                                    <div class="chart tab-pane" id="chartProgramBatal"
                                        style="position: relative; width: 100%; margin: auto;">
                                        <canvas id="chartBatal"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </section>
                    {{-- Kiri --}}

                    {{-- Kanan --}}
                    <section class="col-lg-6 connectedSortable">

                        {{-- Grafik Program --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-briefcase mr-1"></i>
                                    Program
                                </h3>
                                <div class="card-tools">
                                    {{-- <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#chartProgramTunggu"
                                                data-toggle="tab">Tunggu</a>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <div class="chart tab-pane active" id="chartProgramTunggu"
                                        style="position: relative; width: 100%; margin: auto;">
                                        <canvas id="programChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Visitors --}}
                        {{-- <div class="card bg-gradient-primary">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    Visitors
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                        <i class="far fa-calendar-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="card-body">
                                <div id="world-map" style="height: 250px; width: 100%;"></div>
                            </div>

                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>

                                    <div class="col-4 text-center">
                                        <div id="sparkline-2"></div>
                                        <div class="text-white">Online</div>
                                    </div>

                                    <div class="col-4 text-center">
                                        <div id="sparkline-3"></div>
                                        <div class="text-white">Sales</div>
                                    </div>

                                </div>

                            </div>
                        </div> --}}

                        {{-- Calender --}}
                        {{-- <div class="card bg-gradient-success">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>

                                <div class="card-tools">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body pt-0">

                                <div id="calendar" style="width: 100%"></div>
                            </div>

                        </div> --}}

                    </section>
                    {{-- Kanan --}}
                </div>

        </section>

    </div>


    </div>
    </section>

    </div>
    {{-- ======================================== --}}
@endsection
