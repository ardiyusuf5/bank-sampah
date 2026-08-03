<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','SIPULUNG')</title>

    <link rel="icon" href="{{ asset('assets/web/img/logo.png') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS Website --}}
    <link href="{{ asset('assets/web/css/styles.css') }}" rel="stylesheet">

    @stack('style')
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Isi halaman --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>