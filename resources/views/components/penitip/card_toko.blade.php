{{-- KOMPONEN CARD TOKO --}}
<div class="col-md-3 mb-4">
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">

        {{-- Gambar Toko --}}
        <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
            @if($gambar)
                <img src="{{ asset($gambar) }}" alt="{{ $nama }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <strong style="color: #999;">Gambar</strong>
            @endif
        </div>

        {{-- Info Toko --}}
        <div class="card-body">
            <table class="w-100 small">
                <tr>
                    <td style="width: 40%;">Nama Toko</td>
                    <td>{{ $nama }}</td>
                </tr>
                <tr>
                    <td>Alamat Toko</td>
                    <td>{{ $alamat }}</td>
                </tr>
                <tr>
                    <td>Jam Operasional</td>
                    <td>{{ $jam_operasional }}</td>
                </tr>
            </table>

            {{-- Button (Approved = Open, Pending = Kunjungi Toko) --}}
            @if($is_approved)
                <a href="{{ route('penitip.toko_saya', ['id' => $id]) }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                    Open
                </a>
            @else
                <a href="{{ route('penitip.detail_toko', ['id' => $id]) }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                    Kunjungi Toko
                </a>
            @endif
        </div>
    </div>
</div>
