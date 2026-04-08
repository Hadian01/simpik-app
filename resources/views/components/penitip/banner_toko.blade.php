{{-- KOMPONEN BANNER TOKO --}}
<div class="mb-4" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; height: 250px; background: #f0f0f0;">
    @if(!empty($banner))
        @php
            // Normalize banner path
            if (strpos($banner, 'http') === 0) {
                // Full URL
                $bannerPath = $banner;
            } elseif (strpos($banner, 'storage/') === 0) {
                // Already has storage/ prefix
                $bannerPath = asset($banner);
            } elseif (strpos($banner, 'banners/') === 0) {
                // Has banners/ prefix, add storage/
                $bannerPath = asset('storage/' . $banner);
            } else {
                // No prefix, add full path
                $bannerPath = asset('storage/banners/' . $banner);
            }
        @endphp
        <img src="{{ $bannerPath }}" alt="{{ $nama_toko }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentElement.innerHTML='<div style=\'width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;\'><i class=\'bi bi-image\' style=\'font-size: 64px; color: #999;\'></i><p class=\'mt-2 text-muted\'>Banner {{ $nama_toko }}</p></div>';">
    @else
        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <i class="bi bi-image" style="font-size: 64px; color: #999;"></i>
            <p class="mt-2 text-muted">Banner {{ $nama_toko }}</p>
        </div>
    @endif
</div>
