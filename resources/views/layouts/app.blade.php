<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPIK</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-light">

    @include('components.navbar')
    @include('components.sidebar_penitip')

    <main class="container-fluid mt-4">
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // Buka sidebar
        $('#btnSidebar').click(function() {
            $('#sidebar').addClass('active');
            $('#sidebarOverlay').css('display', 'block');
        });

        // Tutup sidebar
        $('#sidebarOverlay').click(function() {
            $('#sidebar').removeClass('active');
            $(this).css('display', 'none');
        });
    });
</script>
</body>
</html>
