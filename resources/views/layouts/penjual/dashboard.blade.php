@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Sistem Informasi Penitipan Kue</h2>
        <button class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;" style="border-radius:8px" data-toggle="modal" data-target="#modalFilterDashboard">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    {{-- STAT CARDS (Ini kode untuk card informasi pada dashboard di halaman penjual)--}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Produk</h6>
                    <h2 class="stat-value">{{ $totalProduk ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Terjual</h6>
                    <h2 class="stat-value">{{ $totalTerjual ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Pendapatan</h6>
                    <h2 class="stat-value" style="font-size:1.8rem;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Omset</h6>
                    <h2 class="stat-value" style="font-size:1.8rem;">Rp {{ number_format($totalOmset ?? 0, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#monthly" role="tab">
                Monthly
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#yearly" role="tab">
                Yearly
            </a>
        </li>
    </ul>

    {{-- TAB CONTENT --}}
    <div class="tab-content mb-4">

        {{-- MONTHLY --}}
        <div class="tab-pane fade show active" id="monthly" role="tabpanel">
            <div class="card">
                <div class="card-body p-4">
                    <canvas id="barChartMonthly" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- YEARLY --}}
        <div class="tab-pane fade" id="yearly" role="tabpanel">
            <div class="card">
                <div class="card-body p-4">
                    <canvas id="barChartYearly" height="120"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- DONUT & PRODUK MARGIN --}}
    <div class="row">
        {{-- DONUT --}}
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h6 class="mb-4">Jenis Kue</h6>

                    @php
                        $totalJenisKue = array_sum($jenisKueCounts);
                    @endphp

                    @if($totalJenisKue > 0)
                    <div class="row align-items-center">
                        <div class="col-7 text-center">
                            <canvas id="donutChart" width="250" height="250"></canvas>
                        </div>
                        <div class="col-5 small">
                            <p class="fw-semibold">Keterangan :</p>
                            @php
                                $colors = ['#ef4444', '#d8b4fe', '#ec4899', '#eab308', '#3b82f6', '#10b981'];
                                $colorIndex = 0;
                            @endphp
                            @foreach($jenisKueCounts as $jenis => $count)
                                <div class="d-flex align-items-center mb-2">
                                    <span class="legend" style="background: {{ $colors[$colorIndex % count($colors)] }}; width:14px; height:14px; border-radius:3px; margin-right:8px;"></span>
                                    {{ ucwords($jenis) }} ({{ $count }})
                                </div>
                                @php $colorIndex++; @endphp
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="bi bi-pie-chart" style="font-size: 48px; color: #d1d5db;"></i>
                        <p class="text-muted mt-3 mb-0">Belum ada data produk</p>
                        <small class="text-muted">Data akan muncul setelah ada produk yang di-approve</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- PRODUK MARGIN --}}
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h6 class="mb-4">Produk Margin Tertinggi</h6>

                    @forelse($topProducts as $product)
                    <div class="margin-item">
                        <div class="d-flex align-items-start gap-4">

                            {{-- ICON + NAMA --}}
                            <div class="text-center margin-avatar">
                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                <small class="text-muted d-block mt-1">{{ $product->produk->penitip->name ?? 'N/A' }}</small>
                            </div>

                            {{-- DETAIL --}}
                            <div class="margin-detail">
                                <div class="detail-row">
                                    <span class="label">Nama Produk</span>
                                    <span class="value">{{ $product->produk->produk_name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Total Terjual</span>
                                    <span class="value">{{ number_format($product->total_terjual ?? 0) }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Total Omset</span>
                                    <span class="value">Rp {{ number_format($product->total_omset ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Pemasukan</span>
                                    <span class="value fw-semibold">Rp {{ number_format($product->total_pendapatan ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted">Belum ada data produk</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

    {{-- Modal Filter Dashboard --}}
    <div class="modal fade" id="modalFilterDashboard" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" action="{{ route('penjual.dashboard') }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Dashboard</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan">
                                <option value="">Semua Bulan</option>
                                <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun">
                                <option value="">Tahun Ini</option>
                                <option value="2026" {{ request('tahun') == '2026' ? 'selected' : '' }}>2026</option>
                                <option value="2025" {{ request('tahun') == '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2024" {{ request('tahun') == '2024' ? 'selected' : '' }}>2024</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('penjual.dashboard') }}" class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;">Reset</a>
                        <button type="submit" class="btn btn-sm" style="background:#9B8CFF;color:white;">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
// Data dari Controller
const monthlyLabels = {!! json_encode($monthlyData->pluck('penitip_name')) !!};
const monthlyValues = {!! json_encode($monthlyData->pluck('total_terjual')) !!};

const yearlyLabels = {!! json_encode($yearlyData->pluck('month')) !!};
const yearlyValues = {!! json_encode($yearlyData->pluck('terjual')) !!};

// Cek apakah semua data kosong
const hasMonthlyData = monthlyValues.some(val => val > 0);
const hasYearlyData = yearlyValues.some(val => val > 0);

// Chart Monthly (Per Penitip Bulan Ini)
new Chart(document.getElementById('barChartMonthly'), {
    type: 'bar',
    data: {
        labels: hasMonthlyData ? monthlyLabels : [],
        datasets: [{
            data: hasMonthlyData ? monthlyValues : [],
            backgroundColor:'#C7D2FE',
            borderRadius:6
        }]
    },
    options:{
        plugins:{
            legend:{display:false},
            tooltip: { enabled: hasMonthlyData }
        },
        scales:{y:{beginAtZero:true}}
    }
});

// Chart Yearly (Per Bulan Tahun Ini)
new Chart(document.getElementById('barChartYearly'), {
    type: 'bar',
    data: {
        labels: hasYearlyData ? yearlyLabels : [],
        datasets: [{
            data: hasYearlyData ? yearlyValues : [],
            backgroundColor:'#A5B4FC',
            borderRadius:6
        }]
    },
    options:{
        plugins:{
            legend:{display:false},
            tooltip: { enabled: hasYearlyData }
        },
        scales:{y:{beginAtZero:true}}
    }
});

@if($totalJenisKue > 0)
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: {!! json_encode(array_values($jenisKueCounts)) !!},
            backgroundColor: ['#ef4444', '#d8b4fe', '#ec4899', '#eab308', '#3b82f6', '#10b981']
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        cutout:'65%'
    }
});
@endif
</script>
@endpush

{{-- CSS --}}
<style>
.stat-card{
    background:#E3DFFF;
    border:2px solid #9B8CFF;
    border-radius:16px;
    min-height:130px
}
.stat-title{font-size:.85rem;font-weight:600;color:#374151}
.stat-value{font-weight:700;color:#1f2937;font-size:2.2rem}

.margin-item{border-bottom:1px solid #e5e7eb;padding-bottom:16px;margin-bottom:16px}
.margin-label{width:130px;color:#9ca3af}

.legend{width:14px;height:14px;border-radius:3px;margin-right:8px}
.legend.red{background:#ef4444}
.legend.purple{background:#d8b4fe}
.legend.pink{background:#ec4899}
.legend.yellow{background:#eab308}

/* Container item */
.margin-item{
    padding: 20px 0;
    border-bottom: 1px solid #e5e7eb;
}

/* Avatar kiri */
.margin-avatar{
    width: 80px;
}

/* Detail kanan */
.margin-detail{
    padding-left: 10px;
}

/* Baris label & value */
.detail-row{
    display: flex;
    gap: 24px;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

/* Label kiri */
.detail-row .label{
    width: 130px;
    color: #9ca3af;
}

/* Value kanan */
.detail-row .value{
    color: #111827;
}
</style>
