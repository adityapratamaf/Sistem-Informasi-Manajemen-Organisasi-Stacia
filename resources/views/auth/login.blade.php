<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('template/dist/img/AdminLTELogo.png') }}">
    <title>MAPALA STACIA UMJ</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">

            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" class="brand-image-small"
                    style="height: 45px; margin-right: 20px;">
                <a href="" class="h1" style="margin: 0;"><b>STACIA </b>UMJ</a>
            </div>

            <div class="card-body">

                @error('username')
                    <div class="alert alert-danger" style="text-align: center;">
                        Data Wajib Di Isi
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror

                @error('password')
                    <div class="alert alert-danger" style="text-align: center;">
                        Data Wajib Di Isi
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror

                @if (session('danger'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{ session('danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning" style="text-align: center;">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="/store" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username"
                            autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password"
                            autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="kd">
                                <label for="kd" id="rahasiaData">
                                    Kerahasiaan Data
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="login" disabled> <i
                                    class="nav-icon fas fa-sign-in-alt"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Kerahasiaan Data</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Saya Bertindak Atas Nama Kepentingan Mapala Stacia UMJ Dalam Setiap Penggunaan Data Maupun Informasi
                    & Melindungi Data Dari Akses Pihak Yang Tidak Bertanggung Jawab.
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

    <!-- Button Close -->
    <script src="{{ asset('template/path/to/bootstrap.bundle.min.js') }}"></script>

    <!-- Pengaturan Checkbox & Button -->
    <script>
        // Ambil Elemen Checkbox & Button
        const checkbox = document.getElementById('kd');
        const button = document.getElementById('login');

        // Tambahkan Event Listener Di Checkbox
        checkbox.addEventListener('change', function() {
            // Jika Checkbox Di Centang, Aktifkan Tombol
            if (this.checked) {
                button.disabled = false;
            } else {
                // Jika Checkbox Tidak Di Centang, Nonaktifkan Tombol
                button.disabled = true;
            }
        });
    </script>

    <!-- Rahasia Password -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lockIcon = document.querySelector('.fas.fa-lock');
            const passwordInput = document.querySelector('input[type="password"]');

            lockIcon.addEventListener('click', function() {
                // Periksa Apakah Input Saat Ini Dalam Bentuk Password
                if (passwordInput.type === "password") {
                    // Jika Iya, Bbah Ke Teks 
                    passwordInput.type = "text";
                    lockIcon.classList.remove('fa-lock');
                    lockIcon.classList.add('fa-unlock');
                } else {
                    // Jika Tidak, Kembalikan Ke Bentuk Password
                    passwordInput.type = "password";
                    lockIcon.classList.remove('fa-unlock');
                    lockIcon.classList.add('fa-lock');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#loginmodal').modal('show');
        });
    </script>

</body>

</html>
