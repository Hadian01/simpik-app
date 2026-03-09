@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Penitip</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

    {{-- Tabel Penitip --}}
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tablePenitipApproved">
                <thead style="background: #CFC7FF;">
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>JOIN DATE</th>
                        <th style="width: 80px; text-align: center;">DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penitip_approved as $index => $penitip)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penitip->penitip->name }}</td>
                        <td>{{ $penitip->penitip->user?->email ?? '-' }}</td>
                        <td>{{ $penitip->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            <a href="{{ route('penjual.detail_pengajuan_penitip', ['penjual_id' => $penitip->penjual_id]) }}" class="btn btn-sm btn-link p-0">
                                <i class="bi bi-eye" style="font-size: 18px; color: #666;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer" style="background: white; border-top: 1px solid #ddd;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing 1 to {{ count($penitip_approved) }} of 20 entries</small>

                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item"><a class="page-link" href="#" style="background: #9B8CFF; color: white; border: none;">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

@endsection

{{-- Script Search --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Live Search
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();

        $('#tablePenitipApproved tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
@endpush
