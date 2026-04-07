@php
    $user = Auth::guard('usermanual')->user();
    $role = $user->user_type ?? 'guest';
    $profileName = '';
    $profilePhoto = 'https://ui-avatars.com/api/?name=User&background=9B8CFF&color=fff&size=128';
    
    if ($user) {
        if ($role === 'penjual') {
            $penjual = $user->penjual;
            // Pakai nama_pemilik, kalau kosong atau "-" pakai email
            $profileName = $penjual->nama_pemilik ?? $user->email;
            if ($profileName === '-' || empty($profileName)) {
                $profileName = $user->email;
            }
            // Generate avatar dengan nama
            $avatarName = urlencode($profileName);
            $profilePhoto = "https://ui-avatars.com/api/?name={$avatarName}&background=9B8CFF&color=fff&size=128";
        } else if ($role === 'penitip') {
            $penitip = $user->penitip;
            $profileName = $penitip->name ?? $user->email;
            // Generate avatar dengan nama
            $avatarName = urlencode($profileName);
            $profilePhoto = "https://ui-avatars.com/api/?name={$avatarName}&background=9B8CFF&color=fff&size=128";
            
            // Jika ada foto profile custom, gunakan itu
            if ($penitip && $penitip->foto_profile && $penitip->foto_profile !== 'default.jpg' && file_exists(public_path('storage/' . $penitip->foto_profile))) {
                $profilePhoto = asset('storage/' . $penitip->foto_profile);
            }
        }
    }
@endphp

<nav class="w-full px-4 py-2 d-flex align-items-center justify-content-between border"
     style="background-color:#CFC7FF;">

    {{-- KIRI --}}
    <div class="d-flex align-items-center gap-4">
        <button id="btnSidebar" type="button" class="btn btn-link p-0 text-dark" style="line-height:1">
            <i class="bi bi-list" style="font-size:22px;"></i>
        </button>
        <strong class="ms-3">SIMPIK</strong>
    </div>

    {{-- KANAN --}}
<div class="d-flex align-items-center gap-3">

    {{-- Notifikasi --}}
    <div class="dropdown position-relative">
        <button type="button" id="notificationBtn" class="btn btn-link p-0 text-dark position-relative" data-toggle="dropdown">
            <i class="bi bi-bell" style="font-size:18px;"></i>
            <span id="notifBadge" class="badge badge-danger position-absolute" 
                  style="display:none; top:-8px; right:-8px; font-size:10px; padding:2px 5px; border-radius:10px;">
                0
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" style="min-width:320px; max-height:400px; overflow-y:auto;">
            <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 font-weight-bold">Notifikasi</h6>
                <button id="markAllReadBtn" class="btn btn-sm btn-link p-0 text-primary" style="font-size:12px;">
                    Tandai semua dibaca
                </button>
            </div>
            <div id="notificationList">
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-bell-slash" style="font-size:32px;"></i>
                    <p class="small mb-0 mt-2">Tidak ada notifikasi</p>
                </div>
            </div>
        </div>
    </div>

    {{-- PROFILE DROPDOWN --}}
    @if($user)
    <div class="dropdown">
        <button class="btn btn-link p-0 d-flex align-items-center gap-2 text-dark"
                type="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">

            <img src="{{ $profilePhoto }}"
                 class="rounded-circle border"
                 width="32"
                 height="32"
                 alt="Profile"
                 onerror="this.src='{{ asset('profile.jpg') }}'">

            <span class="small font-weight-medium">{{ $profileName }}</span>
            <i class="bi bi-chevron-down small"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-right">
            
            <div class="dropdown-item-text">
                <small class="text-muted">{{ $user->email }}</small>
            </div>
            
            <div class="dropdown-divider"></div>

            @if($role === 'penjual')
                <a class="dropdown-item" href="{{ route('penjual.edit_toko') }}">
                    <i class="bi bi-shop me-2"></i> Data Toko
                </a>
            @else
                <a class="dropdown-item" href="{{ route('penitip.data_diri') }}">
                    <i class="bi bi-person me-2"></i> Data Diri
                </a>
            @endif


            <div class="dropdown-divider"></div>

            @if($role === 'penjual')
                <a class="dropdown-item" href="{{ route('penjual.edit_password') }}">
                    <i class="bi bi-key me-2"></i> Ubah Password
                </a>
            @else
                <a class="dropdown-item" href="{{ route('penitip.edit_password') }}">
                    <i class="bi bi-key me-2"></i> Ubah Password
                </a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-danger" style="cursor:pointer;">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
    @endif

</div>

</nav>
