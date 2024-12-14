<!DOCTYPE html>
<html>

<head>
    <!-- Memuat CSS Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <!-- Memuat JavaScript Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    {{-- CSS --}}
    <style>
        #body {
            margin-top: 20px;
            margin-right: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            text-align: center;
        }

        #head {
            text-align: center;
        }

        #kop {
            width: 100%;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        #double {
            border-top: 5px double #333;
            margin: 10px auto;
        }

        #content {
            text-align: center;
        }

        #footer {
            margin-top: 20px;
            text-align: center;
            position: bottom;
        }

        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: DodgerBlue;
            color: white;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            color: rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            pointer-events: none;
        }

        /* Mengulang watermark di setiap halaman cetak */
        @media print {
            .watermark {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 50px;
                color: rgba(0, 0, 0, 0.1);
                white-space: nowrap;
                pointer-events: none;
                z-index: -1;
            }

            /* Watermark akan muncul berulang di setiap halaman */
            body {
                page-break-before: always;
            }
        }
    </style>

</head>

<body id="body">

    {{-- Watermark --}}
    <div class="watermark">
        {{ $watermarknama }}
        <br>
        {{ $watermarkwaktu }}
    </div>

    {{-- Kop Surat --}}
    <div id="head">
        <table id="kop">
            <tr>
                <th>
                    <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" width="100px;">
                </th>
                <th>
                    <div>
                        <h1> <b>DETAIL DATA PROGRAM <br> MAPALA STACIA UMJ </b> </h1>
                        <font size="3">Universitas Muhammadiyah Jakarta</font> <br>
                        <font size="2">Jl. K.H. Ahmad Dahlan, Cireundeu, Ciputat Timur, Kota
                            Tangerang Selatan, Banten 15419</font>
                    </div>
                </th>
            </tr>
        </table>
    </div>

    {{-- Garis --}}
    <hr id="double">

    {{-- Konten --}}
    <div id="content">

        {{ $program->nama }}

        <table id="table">
            <colgroup>
                <col width="3%">
                <col width="41%">
                <col width="41%">
                <col width="15%">
            </colgroup>
            <tr>
                <th>No</th>
                <th>Tugas</th>
                <th>Laporan</th>
                <th>Status</th>
            </tr>
            <?php $nomor = 1; ?>

            @if ($tugas->isEmpty())
                <tr>
                    <td>
                        <p>Tidak Ada Data Pekerjaan</p>
                    </td>
                </tr>
            @else
                @foreach ($tugas as $data)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td style="text-align: left;">
                            {{ $data->nama }}
                            <br>
                            <small>
                                Deskripsi : {{ strip_tags($data->deskripsi) }}
                                <br>
                                Pelaksana : {{ $data->users->nama }}
                            </small>
                        </td>
                        <td style="text-align: left;">
                            @php
                                // Cari laporan yang terkait dengan tugas ini
                                $laporanItem = $laporan->where('tugas_id', $data->id)->first();

                                // Hapus tag <p> atau tag HTML lainnya dari deskripsi laporan
                                $deskripsiLaporan = $laporanItem
                                    ? str_replace(['<p>', '</p>'], '', $laporanItem->deskripsi)
                                    : '-';

                                // Ambil tanggal mulai jika ada, atau beri tanda '-'
                                $tanggalMulai = $laporanItem
                                    ? \Carbon\Carbon::parse($laporanItem->tgl_mulai)
                                        ->locale('id')
                                        ->isoFormat('dddd D MMMM YYYY')
                                    : '-';

                                // Ambil tanggal mulai jika ada, atau beri tanda '-'
                                $tanggalSelesai = $laporanItem
                                    ? \Carbon\Carbon::parse($laporanItem->tgl_selesai)
                                        ->locale('id')
                                        ->isoFormat('dddd D MMMM YYYY')
                                    : '-';

                                // Ambil pelaksana berdasarkan users_id
                                $pelaksana = $laporanItem && $laporanItem->users ? $laporanItem->users->nama : '-';
                            @endphp

                            <span>{{ $deskripsiLaporan }}</span>
                            <br>
                            <small>
                                Waktu : {{ $tanggalMulai }} - {{ $tanggalSelesai }}
                                <br>
                                Pelaksana : {{ $pelaksana }}
                            </small>
                        </td>
                        <td>
                            {{ $data->status }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>








    </div>

    <div id="footer">
        Mahasiswa Pecinta Alam STACIA Universitas Muhammadiyah Jakarta
    </div>

    {{-- Print --}}
    <script type="text/javascript">
        window.print();
    </script>
    {{-- Print --}}
</body>

</html>
