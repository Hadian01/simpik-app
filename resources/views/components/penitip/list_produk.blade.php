{{-- KOMPONEN CARD PRODUK KECIL --}}
<div class="col-4 mb-3">
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">

        {{-- Gambar Produk --}}
        <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
            @if($gambar)
                <img src="{{ asset($gambar) }}" alt="{{ $nama }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
            @endif
        </div>

        {{-- Nama Produk --}}
        <div class="p-2 text-center">
            <small class="font-weight-bold">{{ $nama }}</small>
        </div>
    </div>
</div>
