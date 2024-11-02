<!DOCTYPE html>
<html>

<head>
    <!-- Memuat CSS Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <!-- Memuat JavaScript Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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

        @media print {
            @page {
                size: landscape;
            }
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
    </style>

</head>

<body id="body">

    <div class="watermark">
        {{ $watermarknama }}
        <br>
        {{ $watermarkwaktu }}
    </div>

    <div id="head">
        <table id="kop">
            <tr>
                <th>
                    <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" width="100px;">
                </th>
                <th>
                    <div>
                        <h1> <b>DAFTAR DATA ANGGOTA <br> MAPALA STACIA UMJ </b> </h1>
                        <font size="3">Universitas Muhammadiyah Jakarta</font> <br>
                        <font size="2">Jl. K.H. Ahmad Dahlan, Cireundeu, Ciputat Timur, Kota
                            Tangerang Selatan, Banten 15419</font>
                    </div>
                </th>
            </tr>
        </table>
    </div>

    <hr id="double">

    <div id="content">
        <table id="table">
            <colgroup>
                <col width="3%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
            </colgroup>
            <tr>
                <th>No</th>
                <th>NRA</th>
                <th>Nama</th>
                <th>Status Anggota</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Email</th>
                <th>Telepon</th>
            </tr>
            <?php $nomor = 1; ?>
            @foreach ($anggota as $data)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $data->nra }}</td>
                    <td>{{ $data->user->nama }}</td>
                    <td>
                        @if ($data->user->role == 1)
                            Anggota Biasa
                        @elseif ($data->jenis_anggota == 2)
                            Anggota Istimewa
                        @elseif ($data->jenis_anggota == 3)
                            Anggota Luar Biasa
                        @elseif ($data->jenis_anggota == 4)
                            Anggota Kehormatan
                        @endif
                    </td>
                    <td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                    <td>{{ $data->user->email }}</td>
                    <td>{{ $data->telepon }}</td>
                </tr>
            @endforeach
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
