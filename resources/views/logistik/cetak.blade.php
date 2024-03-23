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
    </style>

</head>

<body id="body">

    <div id="head">
        <table id="kop">
            <tr>
                <th>
                    <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" width="100px;">
                </th>
                <th>
                    <div>
                        <h1> <b>DAFTAR DATA LOGISTIK <br> MAPALA STACIA UMJ </b> </h1>
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
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Merek</th>
                <th>Tahun Pembelian</th>
                <th>Status</th>
                <th>Pemakaian</th>
                <th>Keterangan</th>
                <th>Foto</th>
            </tr>
            <?php $nomor = 1; ?>
            @foreach ($logistik as $data)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $data->nomor }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->merek }}</td>
                    <td>{{ $data->tahun_pembelian }}</td>
                    <td>
                        @if ($data->status == 1)
                            Layak
                        @else
                            Tidak Layak
                        @endif
                    </td>
                    <td>
                        @if ($data->pemakaian == 1)
                            Tersedia
                        @else
                            Tidak Tersedia
                        @endif
                    </td>
                    <td>
                        <div class="summernote">{!! $data->keterangan !!}</div>
                    </td>
                    <td>
                        <img src="{{ asset('logistik-foto/' . $data->foto) }}" width="100px;">
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div id="footer">
        Mahasiswa Pecinta Alam STACIA Universitas Muhammadiyah Jakarta
    </div>

</body>

</html>
