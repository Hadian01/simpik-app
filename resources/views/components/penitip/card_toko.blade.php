<div class="col-md-3 mb-4">
    <div class="card position-relative" style="border:1px solid #ddd;border-radius:8px;">

        {{-- ================= STATUS BADGE ================= --}}
        <div style="position:absolute; top:10px; right:10px; z-index:10;">
            @php
                $status = strtolower($status ?? 'not_joined');
            @endphp

            @switch($status)
                @case('approved')
                    <span class="badge badge-success px-3 py-1">Approved</span>
                    @break

                @case('pending')
                    <span class="badge badge-warning px-3 py-1">Pending</span>
                    @break

                @case('rejected')
                    <span class="badge badge-danger px-3 py-1">Rejected</span>
                    @break

                @default
                    <span class="badge badge-info px-3 py-1">Available</span>
            @endswitch
        </div>

        {{-- ================= GAMBAR ================= --}}
        <div style="width:100%; height:180px; background:#f0f0f0;
                    display:flex; align-items:center; justify-content:center;
                    border-bottom:1px solid #ddd;">
            <strong style="color:#999;">Gambar</strong>
        </div>

        {{-- ================= INFO ================= --}}
        <div class="card-body">
            <table class="w-100 small">
                <tr>
                    <td width="40%">Nama Toko</td>
                    <td>{{ $nama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $alamat }}</td>
                </tr>
                <tr>
                    <td>Jam Operasional</td>
                    <td>{{ $jam_operasional }}</td>
                </tr>
            </table>

            {{-- ================= BUTTON UNGU SEMUA ================= --}}
            @php
                $route = route('penitip.detail_toko', ['penjual_id' => $id]);
                $text = 'Kunjungi Toko';

                if($status === 'approved'){
                    $route = route('penitip.toko_saya', ['id' => $id]);
                    $text = 'Open';
                }

                if($status === 'pending'){
                    $text = 'Lihat Status';
                }

                if($status === 'rejected'){
                    $text = 'Ajukan Ulang';
                }
            @endphp

            <a href="{{ $route }}"
               class="btn btn-block mt-3"
               style="background:#9B8CFF;color:white;">
                {{ $text }}
            </a>

        </div>
    </div>
</div>
