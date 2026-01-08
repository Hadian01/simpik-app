{{-- KOMPONEN BANNER TOKO --}}
<div class="mb-4" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; height: 250px; background: #f0f0f0;">
    @if($banner)
        <img src="{{ asset($banner) }}" alt="{{ $nama_toko }}" style="width: 100%; height: 100%; object-fit: cover;">
    @else
        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <i class="bi bi-image" style="font-size: 64px; color: #999;"></i>
            <p class="mt-2 text-muted">Banner {{ $nama_toko }}</p>
        </div>
    @endif
</div>
