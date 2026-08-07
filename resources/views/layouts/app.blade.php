<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') &mdash; BANK SAMPAH DESA PULOSARI</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('assets/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStoragefonts = true;
            }
        });
    </script>

    @stack('style')

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.trendy.min.css') }}">

    <!-- CSS Override Slide Mobile Sidebar -->
    <style>
        @media (max-width: 991.98px) {
            html.nav_open .sidebar {
                transform: translate3d(0, 0, 0) !important;
                left: 0 !important;
                z-index: 1050 !important;
                visibility: visible !important;
            }

            html.nav_open .sidebar .sidebar-wrapper {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }

            html.nav_open .main-panel::before {
                content: '';
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }
        }
    </style>
</head>

<body class="trendy-layout">
    <div class="wrapper">
        @include('components.sidebar')
        <div class="main-panel">
            @include('components.header')
            @include('sweetalert::alert')

            <div class="container">
                <div class="page-inner">
                    @yield('main')
                </div>
            </div>
            @include('components.footer')
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.trendy.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toggle Sidebar Script -->
    <script>
        $(document).ready(function() {
            // Event Klik Tombol Hamburger Mobile
            $(document).off('click', '#btnMobileMenu').on('click', '#btnMobileMenu', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('html').toggleClass('nav_open');
            });

            // Tutup Sidebar jika area luar (overlay) diklik
            $(document).on('click', '.main-panel', function() {
                if ($('html').hasClass('nav_open')) {
                    $('html').removeClass('nav_open');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
