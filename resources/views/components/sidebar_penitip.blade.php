{{-- OVERLAY --}}
<div id="sidebarOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; display: none;"></div>

{{-- SIDEBAR --}}
<div id="sidebar" style="position: fixed; top: 0; left: -280px; width: 280px; height: 100vh; background-color: #E3DFFF; z-index: 1050; transition: left 0.3s ease; overflow-y: auto;">
    <h5 class="p-4 mb-3 border-bottom">Menu Penitip</h5>
    <ul class="list-unstyled px-4">
        <li class="mb-3">
            <a href="#" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">Daftar Toko</a>
        </li>
        <li class="mb-3">
            <a href="#" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">Produk Saya</a>
        </li>
        <li class="mb-3">
            <a href="#" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">Ajukan Stok</a>
        </li>
        <li class="mb-3">
            <a href="#" class="sidebar-link" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-weight: 500;">Riwayat Penjualan</a>
        </li>
    </ul>
</div>

<style>
    #sidebar.active {
        left: 0 !important;
    }
    .sidebar-link:hover {
        background: rgba(0,0,0,0.1) !important;
    }
</style>
