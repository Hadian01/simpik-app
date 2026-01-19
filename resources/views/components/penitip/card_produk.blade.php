<div class="col-md-4 mb-4">
    <div class="card position-relative">

        {{-- Toggle --}}
        <div class="position-absolute" style="top:10px; right:10px; z-index:2;">
            <label class="switch mb-0">
                <input type="checkbox"
                       class="toggle-produk"
                       data-id="{{ $id }}"
                       {{ $is_active ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        {{-- Card Link --}}
        <a href="{{ route('penitip.detail_produk', $id) }}" class="text-decoration-none text-dark">
            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                <strong>Produk</strong>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between small">
                    <div>
                        <strong>Nama</strong><br>
                        <strong>Harga</strong>
                    </div>
                    <div class="text-right">
                        {{ $nama }}<br>
                        Rp {{ number_format($harga,0,',','.') }}
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

