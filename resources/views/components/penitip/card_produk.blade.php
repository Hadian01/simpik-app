<div class="col-md-4 mb-4" data-type="{{ $produk_type ?? '' }}" data-active="{{ $is_active ? '1' : '0' }}">
    <div class="card position-relative">

        {{-- TOGGLE (OPSIONAL) --}}
        @if(($showToggle ?? true) === true)
            <div class="position-absolute" style="top:10px; right:10px; z-index:2;">
                <label class="switch mb-0">
                    <input type="checkbox"
                        class="toggle-produk"
                        data-id="{{ $id }}"
                        {{ $is_active ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
        @endif

        {{-- CARD LINK --}}
        <a href="{{ route('penitip.detail_produk', $id) }}" class="stretched-link"></a>

        {{-- GAMBAR --}}
        <div style="height:200px; overflow:hidden;">
            @if($gambar && $gambar !== 'default.jpg' && file_exists(public_path('storage/'.$gambar)))
                <img src="{{ asset('storage/'.$gambar) }}"
                    class="w-100 h-100"
                    style="object-fit:cover;"
                    alt="{{ $nama }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center h-100">
                    <i class="bi bi-image" style="font-size:48px;color:#ccc;"></i>
                </div>
            @endif
        </div>

        {{-- BODY --}}
        <div class="card-body">
            <div class="d-flex justify-content-between small">
                <div>
                    <strong>Nama</strong><br>
                    <strong>Harga</strong>
                </div>
                <div class="text-right">
                    {{ $nama }}<br>
                    Rp {{ number_format($harga_jual,0,',','.') }}
                </div>
            </div>
        </div>

    </div>
</div>
