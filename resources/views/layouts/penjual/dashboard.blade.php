@extends('layouts.app', ['userType' => 'penjual'])

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Sistem Informasi Penitipan Kue</h2>
        <button class="btn btn-outline-secondary" style="border-radius:8px">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    {{-- STAT CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Produk</h6>
                    <h2 class="stat-value">70</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Terjual</h6>
                    <h2 class="stat-value">300</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Pendapatan</h6>
                    <h2 class="stat-value" style="font-size:1.8rem;">Rp 1.500,00</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body text-center">
                    <h6 class="stat-title">Total Omset</h6>
                    <h2 class="stat-value" style="font-size:1.8rem;">Rp 10.000.000</h2>
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
                    <div class="row align-items-center">
                        <div class="col-7 text-center">
                            <canvas id="donutChart" width="250" height="250"></canvas>
                        </div>
                        <div class="col-5 small">
                            <p class="fw-semibold">Keterangan :</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="legend red"></span> Kue Basah
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="legend purple"></span> Kue Kering
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="legend pink"></span> Donat
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="legend yellow"></span> Lainnya
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUK MARGIN --}}
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h6 class="mb-4">Produk Margin Tertinggi</h6>

                    @for($i = 0; $i < 3; $i++)
                    <div class="margin-item">
                        <div class="d-flex align-items-start gap-4">

                            {{-- ICON + NAMA --}}
                            <div class="text-center margin-avatar">
                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                <small class="text-muted d-block mt-1">Dian</small>
                            </div>

                            {{-- DETAIL --}}
                            <div class="margin-detail">
                                <div class="detail-row">
                                    <span class="label">Nama Produk</span>
                                    <span class="value">Nasi Jemol Kua Rica</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Total Terjual</span>
                                    <span class="value">250</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Total Omset</span>
                                    <span class="value">Rp 2.000.000</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Pemasukan</span>
                                    <span class="value fw-semibold">Rp 300.000</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endfor

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
new Chart(document.getElementById('barChartMonthly'), {
    type: 'bar',
    data: {
        labels: ['Dian','Eka','Ardia','Bella','Cici','Dodo'],
        datasets: [{
            data: [100,150,75,125,90,180],
            backgroundColor:'#C7D2FE',
            borderRadius:6
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        scales:{y:{beginAtZero:true}}
    }
});

new Chart(document.getElementById('barChartYearly'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        datasets: [{
            data: [600,750,500,800,700,900],
            backgroundColor:'#A5B4FC',
            borderRadius:6
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        scales:{y:{beginAtZero:true}}
    }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data:[35,25,15,25],
            backgroundColor:['#ef4444','#d8b4fe','#ec4899','#eab308']
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        cutout:'65%'
    }
});
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
