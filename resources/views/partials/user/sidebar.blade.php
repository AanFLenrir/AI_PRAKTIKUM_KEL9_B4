<div class="sidebar-container">
    <!-- Header Section -->
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom" style="height: var(--nav-height);">
        <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="/">
            <i class="fa-solid fa-heart-pulse me-2"></i>
            <span class="brand-text">SIFUZI Balita</span>
        </a>
        <button type="button" class="btn-nav-toggle sidebar-toggle-btn" id="sidebarToggleSidebar" aria-label="Toggle Sidebar">
            <i class="fa-solid fa-bars-staggered d-none d-lg-inline-block"></i>
            <i class="fa-solid fa-xmark d-inline-block d-lg-none"></i>
        </button>
    </div>

    <!-- Main Navigation Section -->
    <div class="p-3 flex-grow-1 overflow-y-auto">
        <ul class="list-unstyled mb-0">
            <li>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>
            </li>
            @canany(['view-any-balita', 'view-own-balita'])
            <li>
                <a href="{{ route('balita.index') }}" class="sidebar-link {{ request()->routeIs('balita.*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Data Balita">
                    <i class="fa-solid fa-child-reaching"></i>
                    <span>Data Balita</span>
                </a>
            </li>
            @endcanany
            <li>
                <a href="{{ route('analisis-fuzzy.index') }}" class="sidebar-link {{ request()->routeIs('analisis-fuzzy.*') ? 'active' : '' }} d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="right" title="Analisis Gizi">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Analisis Gizi</span>
                    </div>
                    <button class="btn-add-sidebar ms-auto" aria-label="Tambah Analisis" onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('analisis-fuzzy.create', ['new' => 1]) }}';">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </a>
            </li>
            <li>
                <a href="{{ route('statistik') }}" class="sidebar-link {{ request()->routeIs('statistik') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Statistik">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Statistik</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer Section -->
    <div class="p-3 border-top mt-auto">
        <ul class="list-unstyled mb-0">
            <li>
                <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Bantuan">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>Bantuan</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Dokumentasi">
                    <i class="fa-solid fa-book"></i>
                    <span>Dokumentasi</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Pengaturan">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
