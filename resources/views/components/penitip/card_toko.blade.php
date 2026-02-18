{{-- KOMPONEN CARD TOKO --}}
<div class="col-md-3 mb-4">
    <div class="card position-relative" style="border:1px solid #ddd;border-radius:8px;">

        {{-- STATUS BADGE --}}
        <div style="position:absolute; top:10px; right:10px; z-index:10;">
            @switch($status)
                @case('approved')
                    <span class="badge badge-success px-3 py-1">Approved</span>
                    @break

                @case('pending')
                    <span class="badge badge-warning px-3 py-1">In Progress</span>
                    @break

                @case('rejected')
                    <span class="badge badge-danger px-3 py-1">Rejected</span>
                    @break

                @case('not_joined')
                    <span class="badge badge-info px-3 py-1">Available</span>
                    @break
            @endswitch
        </div>

        {{-- Gambar Toko --}}
        <div style="width:100%; height:180px; background:#f0f0f0;
                    display:flex; align-items:center; justify-content:center;
                    border-bottom:1px solid #ddd;">
            @if($gambar)
                <img src="{{ asset($gambar) }}" alt="{{ $nama }}"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <strong style="color:#999;">Gambar</strong>
            @endif
        </div>

        {{-- Info Toko --}}
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

            {{-- ACTION BUTTON --}}
        @switch($status)

            @case('approved')
                <a href="{{ route('penitip.toko_saya', ['id' => $id]) }}"
                class="btn btn-sm btn-block mt-3"
                style="background:#9B8CFF;color:white;">
                    Open
                </a>
                @break

            @default
                   {{-- not_joined | pending | rejected --}}
    <a href="{{ route('penitip.detail_toko', [
        'penjual_id' => $id,
        'status' => $status
    ]) }}"
       class="btn btn-sm btn-block mt-3"
       style="background:#9B8CFF;color:white;">
        Kunjungi Toko
    </a>
        @endswitch

        </div>
    </div>
</div>
