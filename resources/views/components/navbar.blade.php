<nav class="w-full px-4 py-2 d-flex align-items-center justify-content-between border"
     style="background-color:#CFC7FF;">

    {{-- KIRI --}}
    <div class="d-flex align-items-center gap-3">
        <button id="btnSidebar" type="button" class="btn btn-link p-0 text-dark" style="line-height:1">
            <i class="bi bi-list" style="font-size:22px;"></i>
        </button>
        <strong>SIMPIK</strong>
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

        {{-- Profile --}}
        <img src="{{ asset('profile.jpg') }}" class="rounded-circle border" width="32" height="32" alt="Profile">
        <span class="small font-weight-medium">Hadian Nelvi</span>
    </div>
</nav>
