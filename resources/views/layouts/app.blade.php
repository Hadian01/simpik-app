<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'SIMPIK')</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- DATATABLE CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

@stack('styles')

</head>
<body class="bg-light">

@php
$user = Auth::guard('usermanual')->user();
$role = $user->user_type ?? 'penitip';
@endphp

@include('components.navbar')

@if($role === 'penjual')
@include('components.sidebar_penjual')
@else
@include('components.sidebar_penitip')
@endif

<main class="container-fluid mt-4">
@yield('content')
</main>


<!-- JQUERY HARUS PERTAMA -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DATATABLE -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet"
href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('js/sidebar.js') }}"></script>

<!-- NOTIFICATION SYSTEM -->
<script src="{{ asset('js/notifications.js') }}"></script>

@stack('scripts')

</body>
</html>
