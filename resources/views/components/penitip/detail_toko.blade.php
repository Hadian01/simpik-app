{{-- =========================
    DATA DUMMY TOKO
========================== --}}
@php
$toko = [
    'id' => 1,
    'nama_toko' => 'Toko Kue Maju',
    'pemilik' => 'Hadian Nelvi',
    'alamat' => 'Marina, Kota Batam',
    'no_hp' => '082145687458',
    'email' => 'hadianelvi82@gmai.com',
    'start_operasional' => '2020-09-15',
    'jam_operasional' => 'Every Day, 05.00 - 12.00',
    'deskripsi' => 'Toko dian ini toko pertama saya di masa pandemi untuk membangkitkan perekonomian',
    'banner' => null,
];

$produk_toko = [
    ['id' => 1, 'nama' => 'Kue Lapis', 'gambar' => null],
    ['id' => 2, 'nama' => 'Brownies', 'gambar' => null],
    ['id' => 3, 'nama' => 'Roti Tawar', 'gambar' => null],
    ['id' => 4, 'nama' => 'Donat', 'gambar' => null],
    ['id' => 5, 'nama' => 'Kue Bolu', 'gambar' => null],
    ['id' => 6, 'nama' => 'Kue Cubit', 'gambar' => null],
];

/**
 * STATUS PENGAJUAN
 * not_joined | pending | approved | rejected
 */
$status_pengajuan = 'not_joined'; // ganti nanti dari DB
@endphp

{{-- =========================
    HEADER + ACTION BUTTON
========================== --}}
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $toko['nama_toko'] }}</h2>

        {{-- ACTION BUTTON DINAMIS --}}
        @if($status_pengajuan === 'not_joined')
            <button id="btnJoinPenitip"
                class="btn"
                style="background:#9B8CFF;color:white"
                data-toggle="modal"
                data-target="#modalJoin">
                ➕ Join Sebagai Penitip
            </button>

            <button id="btnStatusPengajuan"
                class="btn btn-warning"
                data-toggle="modal"
                data-target="#modalStatusPengajuan"
                style="display:none">
                ⏳ Menunggu Approval
            </button>

        @elseif($status_pengajuan === 'pending')
            <button
                class="btn btn-warning"
                data-toggle="modal"
                data-target="#modalStatusPengajuan">
                ⏳ Menunggu Approval
            </button>

        @elseif($status_pengajuan === 'approved')
            <span class="badge badge-success px-3 py-2">
                ✔️ Anda sudah menjadi penitip
            </span>

        @elseif($status_pengajuan === 'rejected')
            <button
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#modalStatusPengajuan">
                ❌ Pengajuan Ditolak
            </button>
        @endif
    </div>

{{-- CARD: Detail Toko --}}
<div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <h5 class="mb-3">Detail {{ $nama_toko ?? 'Toko' }}</h5>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Pemilik:</strong><br>{{ $pemilik ?? '-' }}</p>
            <p><strong>Email:</strong><br>{{ $email ?? '-' }}</p>
            <p><strong>No. HP:</strong><br>{{ $no_hp ?? '-' }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Alamat:</strong><br>{{ $alamat ?? '-' }}</p>
            <p><strong>Jam Operasional:</strong><br>{{ $jam_operasional ?? '-' }}</p>
            <p><strong>Tgl. Berdiri:</strong><br>{{ $start_operasional ?? '-' }}</p>
        </div>
    </div>

    <div class="mb-3">
        <p><strong>Deskripsi:</strong></p>
        <p style="text-align: justify;">{{ $deskripsi ?? '-' }}</p>
    </div>
</div>


