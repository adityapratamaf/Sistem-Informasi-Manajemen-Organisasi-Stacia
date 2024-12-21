<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/template/dist/img/AdminLTELogo.png') }}">
    <title>@yield('judul')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet"
        href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">

    {{-- Summernote --}}
    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">

    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- Print Area --}}
    <script type="text/javascript">
        function printArea(area) {
            var printPage = document.getElementById(area).innerHTML;
            var oriPage = document.body.innerHTML;
            document.body.innerHTML = printPage;
            window.print();
            document.body.innerHTML = oriPage;
        }
    </script>

    <!-- FullCalendar -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fullcalendar/dist/index.global.css') }}">


    {{-- <script nonce="828b2fe7-5fe9-4506-9d71-c42a859d8829">
        try {
            (function(w, d) {
                ! function(o, p, q, r) {
                    o[q] = o[q] || {};
                    o[q].executed = [];
                    o.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    o.zaraz.q = [];
                    o.zaraz._f = function(s) {
                        return async function() {
                            var t = Array.prototype.slice.call(arguments);
                            o.zaraz.q.push({
                                m: s,
                                a: t
                            })
                        }
                    };
                    for (const u of ["track", "set", "debug"]) o.zaraz[u] = o.zaraz._f(u);
                    o.zaraz.init = () => {
                        var v = p.getElementsByTagName(r)[0],
                            w = p.createElement(r),
                            x = p.getElementsByTagName("title")[0];
                        x && (o[q].t = p.getElementsByTagName("title")[0].text);
                        o[q].x = Math.random();
                        o[q].w = o.screen.width;
                        o[q].h = o.screen.height;
                        o[q].j = o.innerHeight;
                        o[q].e = o.innerWidth;
                        o[q].l = o.location.href;
                        o[q].r = p.referrer;
                        o[q].k = o.screen.colorDepth;
                        o[q].n = p.characterSet;
                        o[q].o = (new Date).getTimezoneOffset();
                        if (o.dataLayer)
                            for (const B of Object.entries(Object.entries(dataLayer).reduce(((C, D) => ({
                                    ...C[1],
                                    ...D[1]
                                })), {}))) zaraz.set(B[0], B[1], {
                                scope: "page"
                            });
                        o[q].q = [];
                        for (; o.zaraz.q.length;) {
                            const E = o.zaraz.q.shift();
                            o[q].q.push(E)
                        }
                        w.defer = !0;
                        for (const F of [localStorage, sessionStorage]) Object.keys(F || {}).filter((H => H
                            .startsWith("_zaraz_"))).forEach((G => {
                            try {
                                o[q]["z_" + G.slice(7)] = JSON.parse(F.getItem(G))
                            } catch {
                                o[q]["z_" + G.slice(7)] = F.getItem(G)
                            }
                        }));
                        w.referrerPolicy = "origin";
                        w.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(o[q])));
                        v.parentNode.insertBefore(w, v)
                    };
                    ["complete", "interactive"].includes(p.readyState) ? zaraz.init() : o.addEventListener(
                        "DOMContentLoaded", zaraz.init)
                }(w, d, "zarazData", "script");
            })(window, document)
        } catch (err) {
            console.error('Failed to run Cloudflare Zaraz: ', err)
            fetch('/cdn-cgi/zaraz/t', {
                credentials: 'include',
                keepalive: true,
                method: 'GET',
            })
        };
    </script> --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

        {{-- LOADER --}}
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="100" width="auto">
        </div>
        {{-- LOADER --}}

        {{-- NAVBAR --}}
        @include('layout.navbar')
        {{-- NAVBAR --}}

        {{-- SIDEBAR --}}
        @include('layout.sidebar')
        {{-- SIDEBAR --}}

        {{-- KONTEN --}}
        @yield('isi')
        {{-- KONTEN --}}

        {{-- FOOTER --}}
        @include('layout.footer')
        {{-- FOOTER --}}

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    {{-- JQuery --}}
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}

    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>

    <script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>

    <script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    {{-- <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script> --}}

    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- Summernote --}}
    <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>

    {{-- Toastr --}}
    <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script src="{{ asset('template/dist/js/adminlte.js?v=3.2.0') }}"></script>

    {{-- <script src="{{ asset('template/dist/js/demo.js') }}"></script> --}}

    {{-- Select2 --}}
    <script src="{{ asset('template/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>

    {{-- Toast Bootstrap  --}}
    <script>
        $(function() {
            $(".toast").toast({
                delay: 15000
            });
            $(".toast").toast("show");
        });
    </script>

    {{-- HTML --}}
    {{-- @if (\Session::has('success'))
            <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0; min-height: 500px;">
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">{{ \Session::get('success') }}</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        @endif --}}
    {{-- HTML --}}
    {{-- Toast Bootstrap  --}}

    {{-- Toastr  --}}
    <script>
        @if (Session::has('pesan'))
            toastr.option = {
                "progressBar": true,
            }
            toastr.{{ Session::get('alert') }}("{{ Session::get('pesan') }}");
        @endif
    </script>
    {{-- Toastr  --}}

    {{-- Summernote --}}
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    {{-- Summernote --}}

    {{-- Preview Image --}}
    {{-- <script>
        function previewImage() {
            document.getElementById("image-preview").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").src = oFREvent.target.result;
            };
        };
    </script> --}}

    <script>
        function previewImage(sourceId, previewId) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(sourceId).files[0]);

            oFReader.onload = function(oFREvent) {
                var previewElement = document.getElementById(previewId);
                previewElement.style.display = "block";
                previewElement.src = oFREvent.target.result;
            };
        }
    </script>
    {{-- Preview Image --}}

    <!-- DataTables -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": true,
                "searching": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!-- DataTables -->

    <!-- FullCalendar -->
    <script src="{{ asset('template/plugins/fullcalendar/dist/index.global.js') }}"></script>

    @stack('script')

</body>

</html>
