{{-- OVERLAY --}}
<div id="sidebarOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; display: none;"></div>

{{-- SIDEBAR PENJUAL --}}
<div id="sidebar" style="position: fixed; top: 0; left: -280px; width: 280px; height: 100vh; background-color: #E3DFFF; z-index: 1050; transition: left 0.3s ease; overflow-y: auto;">
    <h5 class="p-4 mb-3 border-bottom">Menu Penjual</h5>
    <ul class="list-unstyled px-4">
        <li class="mb-3">
            <a href="{{ route('penjual.dashboard') }}" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('penjual.penitip') }}" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">
                <i class="bi bi-people"></i> Penitip
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('penjual.penitip_approved') }}" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">
                <i class="bi bi-people-fill"></i> Penitip Approved
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('penjual.register_toko') }}" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">
                <i class="bi bi-clock-history"></i> Register Toko
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('penjual.stok_harian') }}" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">
                <i class="bi bi-box-seam"></i> Stok Harian
            </a>
        </li>
    </ul>
</div>

<style>
    #sidebar.active {
        left: 0 !important;
    }
    .sidebar-link:hover {
        background: rgba(0,0,0,0.1) !important;
        border-radius: 8px;
    }
</style>
