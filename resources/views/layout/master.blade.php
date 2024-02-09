<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">

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

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- LOADER --}}
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
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

    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script src="{{ asset('template/dist/js/adminlte.js?v=3.2.0') }}"></script>

    <script src="{{ asset('template/dist/js/demo.js') }}"></script>

    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>
</body>

</html>
