<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPIK</title>

    {{-- ================= CSS ================= --}}
    {{-- Bootstrap 4 --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    >

    {{-- Tailwind (boleh coexist untuk utility) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ================= JS ================= --}}
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-light">

<div x-data="{ sidebarOpen: false }">

    {{-- ================= NAVBAR ================= --}}
    <nav
        class="w-full px-4 py-2 d-flex align-items-center justify-content-between border"
        style="background-color:#CFC7FF; color:#000000;"
    >
        {{-- kiri --}}
        <div class="d-flex align-items-center gap-3">
            <button
                class="btn btn-link p-0"
                @click="sidebarOpen = true"
            >
                <i data-lucide="menu"></i>
            </button>
            <strong>SIMPIK</strong>
        </div>

        {{-- kanan --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Bootstrap dropdown --}}
            <div class="dropdown">
                <button
                    class="btn btn-link p-0"
                    data-toggle="dropdown"
                >
                    <i data-lucide="bell"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <h6 class="dropdown-header">Notifications</h6>
                    <span class="dropdown-item-text">No notifications yet</span>
                </div>
            </div>

            <img
                src="{{ asset('profile.jpg') }}"
                alt="profile"
                class="rounded-circle border"
                width="32"
                height="32"
            />
            <span class="small font-weight-medium">Hadian Nelvi</span>
        </div>
    </nav>

    {{-- ================= SIDEBAR ================= --}}
    <div
        x-show="sidebarOpen"
        class="position-fixed w-100 h-100"
        style="background:rgba(0,0,0,.4); z-index:1050"
        @click="sidebarOpen = false"
    >
        <div
            class="bg-white h-100 shadow"
            style="width:260px; background-color:#E3DFFF"
            @click.stop
        >
            <h5 class="p-4 mb-3">Menu</h5>
            <ul class="list-unstyled px-4">
                <li class="mb-2">
                    <a href="/" class="text-dark font-weight-medium">Dashboarddddgitgi</a>
                </li>
                <li class="mb-2">
                    <a href="/report" class="text-dark font-weight-medium">Report</a>
                </li>
                <li class="mb-2">
                    <a href="/settings" class="text-dark font-weight-medium">Produk</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- ================= CONTENT ================= --}}
    <main class="container-fluid mt-4">
        @yield('content')
    </main>

</div>

<script>
    lucide.createIcons();
</script>

@stack('js')


</body>
</html>
git commit -m "first commit"
