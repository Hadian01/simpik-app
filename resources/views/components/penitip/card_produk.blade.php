<div class="col-md-4 mb-4">
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
        <div class="bg-light d-flex align-items-center justify-content-center"
             style="height:200px;">
            <strong>Produk</strong>
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
