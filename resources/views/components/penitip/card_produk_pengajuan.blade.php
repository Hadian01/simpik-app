<div class="col-md-4 mb-4">
    <div class="card h-100 position-relative" style="border:1px solid #ddd;">

        {{-- STATUS BADGE --}}
        @if($status === 'pending')
            <span class="badge badge-warning"
                  style="position:absolute;top:10px;right:10px;z-index:2;">
                In Progress
            </span>
        @elseif($status === 'rejected')
            <span class="badge badge-danger"
                  style="position:absolute;top:10px;right:10px;z-index:2;">
                Rejected
            </span>
        @endif

        {{-- LINK DETAIL (WRAP AREA UTAMA) --}}
        <a href="{{ route('penitip.detail_produk_v2', $id) }}"
           class="stretched-link"
           style="text-decoration:none;color:inherit;">

            {{-- GAMBAR --}}
            <div class="d-flex align-items-center justify-content-center"
                 style="height:180px;background:#f5f5f5;">
                <span class="text-muted">Produk</span>
            </div>

            {{-- BODY --}}
            <div class="card-body">
                <p class="mb-1"><strong>Nama</strong></p>
                <p>{{ $nama }}</p>

                <p class="mb-1"><strong>Harga</strong></p>
                <p>Rp {{ number_format($harga,0,',','.') }}</p>
            </div>
        </a>

        {{-- ACTION --}}
        <div class="card-footer bg-white">
            @if($status === 'rejected')
                <button class="btn btn-outline-danger btn-sm w-100">
                    Ajukan Ulang
                </button>
            @else
                <button class="btn btn-secondary btn-sm w-100" disabled>
                    Menunggu Approval
                </button>
            @endif
        </div>

    </div>
</div>
