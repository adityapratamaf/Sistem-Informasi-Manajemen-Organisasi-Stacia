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
                        <h1> <b>DAFTAR DATA PROGRAM <br> MAPALA STACIA UMJ </b> </h1>
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
            </colgroup>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Status</th>
            </tr>
            <?php $nomor = 1; ?>
            @foreach ($program as $data)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->tgl_mulai }} - {{ $data->tgl_selesai }} </td>
                    <td>
                        @if ($data->jenis == '1')
                            Wajib
                        @elseif ($data->jenis == '2')
                            Pilihan
                        @elseif ($data->jenis == '3')
                            Insidentil
                        @endif
                    </td>
                    <td>{{ $data->status }}</td>
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
