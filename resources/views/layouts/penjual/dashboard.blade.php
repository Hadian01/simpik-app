@extends('layouts.app', ['userType' => 'penitip'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Sistem Informasi Penitipan Kue</h2>
        <button class="btn btn-outline-secondary" style="border-radius: 8px;">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card" style="background: #E3DFFF; border: 2px solid #9B8CFF; border-radius: 16px;">
                <div class="card-body text-center py-4">
                    <h6 class="mb-2" style="font-weight: 600; color: #374151; font-size: 0.9rem;">Total Produk</h6>
                    <h2 class="mb-0" style="font-weight: 700; color: #1f2937; font-size: 2.5rem;">70</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card" style="background: #E3DFFF; border: 2px solid #9B8CFF; border-radius: 16px;">
                <div class="card-body text-center py-4">
                    <h6 class="mb-2" style="font-weight: 600; color: #374151; font-size: 0.9rem;">Total Terjual</h6>
                    <h2 class="mb-0" style="font-weight: 700; color: #1f2937; font-size: 2.5rem;">300</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card" style="background: #E3DFFF; border: 2px solid #9B8CFF; border-radius: 16px;">
                <div class="card-body text-center py-4">
                    <h6 class="mb-2" style="font-weight: 600; color: #374151; font-size: 0.9rem;">Total Pendapatan</h6>
                    <h2 class="mb-0" style="font-weight: 700; color: #1f2937; font-size: 1.8rem;">Rp. 1.500,00</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card" style="background: #E3DFFF; border: 2px solid #9B8CFF; border-radius: 16px;">
                <div class="card-body text-center py-4">
                    <h6 class="mb-2" style="font-weight: 600; color: #374151; font-size: 0.9rem;">Total Omset</h6>
                    <h2 class="mb-0" style="font-weight: 700; color: #1f2937; font-size: 1.8rem;">Rp. 10.000.000</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-3" style="border-bottom: 2px solid #e5e7eb;">
        <li class="nav-item">
            <a class="nav-link active" href="#" style="color: #9B8CFF; border-bottom: 3px solid #9B8CFF; font-weight: 600;">Monthly</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" style="color: #6b7280;">Yearly</a>
        </li>
    </ul>

    {{-- Chart Section --}}
    {{-- Bar Chart - Full Width --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 12px;">
                <div class="card-body" style="padding: 30px;">
                    <canvas id="barChart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Donut Chart and Product List - Side by Side --}}
    <div class="row">
        {{-- Donut Chart --}}
        <div class="col-lg-6 mb-4">
            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 12px; min-height: 450px;">
                <div class="card-body" style="padding: 30px;">
                    <h6 class="mb-4" style="font-weight: 600; font-size: 1rem;">Jenis Kue</h6>

                    <div class="row align-items-center">
                        {{-- Chart --}}
                        <div class="col-7">
                            <div class="d-flex justify-content-center align-items-center" style="height: 280px;">
                                <canvas id="donutChart" style="max-width: 280px; max-height: 280px;"></canvas>
                            </div>
                        </div>

                        {{-- Legend --}}
                        <div class="col-5">
                            <div style="padding-left: 10px;">
                                <p class="mb-3" style="font-size: 0.9rem; font-weight: 500; color: #374151;">Keterangan :</p>
                                <div class="mb-3 d-flex align-items-center">
                                    <span style="width: 16px; height: 16px; background: #ef4444; border-radius: 3px; display: inline-block; margin-right: 10px;"></span>
                                    <small style="color: #6b7280; font-size: 0.9rem;">Keterangan</small>
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <span style="width: 16px; height: 16px; background: #d8b4fe; border-radius: 3px; display: inline-block; margin-right: 10px;"></span>
                                    <small style="color: #6b7280; font-size: 0.9rem;">Keterangan</small>
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <span style="width: 16px; height: 16px; background: #ec4899; border-radius: 3px; display: inline-block; margin-right: 10px;"></span>
                                    <small style="color: #6b7280; font-size: 0.9rem;">Keterangan</small>
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <span style="width: 16px; height: 16px; background: #eab308; border-radius: 3px; display: inline-block; margin-right: 10px;"></span>
                                    <small style="color: #6b7280; font-size: 0.9rem;">Keterangan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Margin List --}}
        <div class="col-lg-6 mb-4">
            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 12px; min-height: 450px;">
                <div class="card-body" style="padding: 25px;">
                    <h6 class="mb-3" style="font-weight: 600; font-size: 1rem;">Produk Margin Tertinggi</h6>

                    {{-- Item 1 --}}
                    <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #9ca3af;"></i>
                                <div class="text-center mt-1">
                                    <small style="font-size: 0.75rem; color: #6b7280;">Dian</small>
                                </div>
                            </div>
                            <div class="flex-grow-1" style="font-size: 0.85rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Nama Produk</span>
                                    <span style="color: #374151; font-weight: 500;">: Nasi Jemol Kua rica</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Terjual</span>
                                    <span style="color: #374151; font-weight: 500;">: 250</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Omset</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 2.000.000</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span style="color: #9ca3af;">Pemasukan</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 300.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="mb-3 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #9ca3af;"></i>
                                <div class="text-center mt-1">
                                    <small style="font-size: 0.75rem; color: #6b7280;">Dian</small>
                                </div>
                            </div>
                            <div class="flex-grow-1" style="font-size: 0.85rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Nama Produk</span>
                                    <span style="color: #374151; font-weight: 500;">: Nasi Jemol Kua rica</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Terjual</span>
                                    <span style="color: #374151; font-weight: 500;">: 250</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Omset</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 2.000.000</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span style="color: #9ca3af;">Pemasukan</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 300.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #9ca3af;"></i>
                                <div class="text-center mt-1">
                                    <small style="font-size: 0.75rem; color: #6b7280;">Dian</small>
                                </div>
                            </div>
                            <div class="flex-grow-1" style="font-size: 0.85rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Nama Produk</span>
                                    <span style="color: #374151; font-weight: 500;">: Nasi Jemol Kua rica</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Terjual</span>
                                    <span style="color: #374151; font-weight: 500;">: 250</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #9ca3af;">Total Omset</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 2.000.000</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span style="color: #9ca3af;">Pemasukan</span>
                                    <span style="color: #374151; font-weight: 500;">: Rp. 300.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
$(document).ready(function() {

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Dian', 'Eka', 'Ardia', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella', 'Bella'],
            datasets: [{
                data: [100, 150, 75, 125, 90, 180, 110, 140, 95, 200, 130, 160, 105, 145, 115, 135, 120, 155, 125, 140, 130, 150, 140, 165],
                backgroundColor: '#C7D2FE',
                borderRadius: 4,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 200,
                    ticks: {
                        stepSize: 50,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: '#f3f4f6'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Donut Chart
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    const donutChart = new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [35, 25, 15, 25],
                backgroundColor: ['#ef4444', '#d8b4fe', '#ec4899', '#eab308'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '65%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

});
</script>
@endpush
