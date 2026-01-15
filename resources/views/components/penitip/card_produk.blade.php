{{-- KOMPONEN CARD PRODUK DENGAN TOGGLE --}}
<div class="col-md-4 mb-4">
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative;">

        {{-- Toggle Active/Inactive --}}
      <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
    <label class="switch mb-0">
        <input type="checkbox"
               class="toggle-produk"
               data-id="{{ $id }}"
               {{ $is_active ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</div>


        {{-- Link ke Detail Produk --}}
        <a href="{{ route('penitip.detail_produk', ['id' => $id]) }}" style="text-decoration: none; color: inherit;">

            {{-- Gambar Produk --}}
            <div style="width: 100%; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                @if($gambar)
                    <img src="{{ asset($gambar) }}" alt="{{ $nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <strong style="color: #999; font-size: 18px;">Produk</strong>
                @endif
            </div>

            {{-- Info Produk --}}
            <div class="card-body">
                <div class="row small">
                    <div class="col-6">
                        <strong>Nama Produk</strong><br>
                        <strong>Harga</strong>
                    </div>
                    <div class="col-6 text-right">
                        {{ $nama }}<br>
                        Rp {{ number_format($harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
