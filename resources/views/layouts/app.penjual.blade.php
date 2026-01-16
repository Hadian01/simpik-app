<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMPIK Penjual - @yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body class="bg-light">

    @include('components.navbar')
    @include('components.sidebar_penjual')

    <main class="container-fluid mt-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SIDEBAR SCRIPT --}}
    <script>
        $(document).ready(function() {
            $('#btnSidebar').click(function() {
                $('#sidebar').addClass('active');
                $('#sidebarOverlay').css('display', 'block');
            });

            $('#sidebarOverlay').click(function() {
                $('#sidebar').removeClass('active');
                $(this).css('display', 'none');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
