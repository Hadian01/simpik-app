@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Dashboard</h1>
    <p>Ini halaman dashboard</p>

    <button id="btnAlert" class="btn btn-primary">
        Klik Saya
    </button>
@endsection

@push('js')
<script>
    $('#btnAlert').click(function () {
        alert('Halo dari jQuery!');
    });
</script>
@endpush
