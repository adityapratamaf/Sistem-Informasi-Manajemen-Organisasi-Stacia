<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('template/dist/img/AdminLTELogo.png') }}">
    <title>PAGE 404</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .content {
            text-align: center;
        }

        .error-page {
            max-width: 600px;
        }

        .headline {
            font-size: 6rem;
            font-weight: bold;
        }

        .text-warning {
            color: #f39c12;
        }

        .error-content h3 {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning">
                <bold>404</bold>
            </h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Halaman Tidak Ditemukan !</h3>

                <p>
                    kami tidak dapat menemukan halaman yang dicari.
                    Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
                </p>

            </div>
        </div>
    </section>


    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <!-- Button Close -->
    <script src="{{ asset('template/path/to/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
