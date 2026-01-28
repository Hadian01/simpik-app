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
    <div class="dropdown">
        <button type="button" class="btn btn-link p-0 text-dark" data-toggle="dropdown">
            <i class="bi bi-bell" style="font-size:18px;"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <span class="dropdown-item-text">Tidak ada notifikasi</span>
        </div>
    </div>

    {{-- PROFILE DROPDOWN --}}
    <div class="dropdown">
        <button class="btn btn-link p-0 d-flex align-items-center gap-2 text-dark"
                type="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">

            <img src="{{ asset('profile.jpg') }}"
                 class="rounded-circle border"
                 width="32"
                 height="32"
                 alt="Profile">

            <span class="small font-weight-medium">Hadian Nelvi</span>
            <i class="bi bi-chevron-down small"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-right">

            @if($role === 'penjual')
                <a class="dropdown-item" href="{{ route('penjual.register_toko') }}">
                    <i class="bi bi-shop me-2"></i> Data Toko
                </a>
            @else
                <a class="dropdown-item" href="{{ route('penitip.data_diri') }}">
                    <i class="bi bi-person me-2"></i> Data Diri
                </a>
            @endif


            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#">
                <i class="bi bi-key me-2"></i> Ubah Password
            </a>

            <a class="dropdown-item text-danger" href="#">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
    </div>

</div>

</nav>
