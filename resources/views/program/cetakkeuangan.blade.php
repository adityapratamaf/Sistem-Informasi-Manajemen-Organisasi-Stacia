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
            margin-top: 10px;
            text-align: center;
            position: bottom;
        }

        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
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

        /* Mengulang Watermark Setiap Halaman */
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
                        <h1> <b>LAPORAN KEUANGAN PROGRAM <br> MAPALA STACIA UMJ </b> </h1>
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

        <table>
            <tr>
                <th>Nama Program</th>
                <td>: {{ $program->nama }}</td>
            </tr>
        </table>

        <table id="table">
            <thead>
                <colgroup>
                    <col width="15%">
                    <col width="40%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $row)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($row['tanggal'])->translatedFormat('d F Y') }}</td>
                        <td style="text-align: left;">{{ $row['keterangan'] }}</td>
                        <td style="text-align: left;">{{ 'Rp ' . number_format($row['debet'], 2, ',', '.') }}</td>
                        <td style="text-align: left;">{{ 'Rp ' . number_format($row['kredit'], 2, ',', '.') }}</td>
                        <td style="text-align: left;">{{ 'Rp ' . number_format($row['saldo'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <th style="text-align: left;">{{ 'Rp ' . number_format($totalPemasukan, 2, ',', '.') }}</th>
                    <th style="text-align: left;">{{ 'Rp ' . number_format($totalPengeluaran, 2, ',', '.') }}</th>
                    <th style="text-align: left;">{{ 'Rp ' . number_format($saldo, 2, ',', '.') }}</th>
                </tr>
            </tfoot>
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
