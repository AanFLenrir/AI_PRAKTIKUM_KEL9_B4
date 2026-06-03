<nav class="navbar navbar-expand-lg bg-white border-bottom fixed-top navbar-custom px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        
        <!-- LEFT SECTION -->
        <div class="d-flex align-items-center gap-2">
            <!-- Mobile Toggle Hamburger -->
            <button id="sidebarToggle" class="btn-nav-toggle d-lg-none" aria-label="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <!-- Mobile Brand Logo -->
            <a class="navbar-brand fw-bold text-success d-flex align-items-center ms-1 d-lg-none" href="/">
                <i class="fa-solid fa-heart-pulse me-2"></i>
                <span>SIFUZI Balita</span>
            </a>
            <!-- Desktop Responsive Spacer Box -->
            <div class="navbar-spacer d-none d-lg-block"></div>
        </div>

        <!-- CENTER SECTION -->
        <div class="d-none d-lg-block flex-fill">
            <div class="nav-search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari data, balita, analisis gizi...">
            </div>
        </div>

        <!-- RIGHT SECTION -->
        <div class="d-flex align-items-center gap-3">
            <!-- Notifications -->
            <div class="dropdown">
                <button class="btn-nav-utility position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-top: 6px; margin-left: -6px;">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li class="dropdown-header">Notifikasi Terbaru</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Pemeriksaan Balita Terjadwal</a></li>
                    <li><a class="dropdown-item" href="#">Laporan Gizi Selesai Diunduh</a></li>
                </ul>
            </div>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="btn btn-link text-decoration-none p-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-user-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="text-start d-none d-md-block">
                        <div class="fw-semibold text-dark leading-none" style="font-size: 0.85rem;">Petugas Gizi</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Administrator</div>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-user me-2"></i>Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Pengaturan Akun</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-circle-question me-2"></i>Bantuan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('logout')}}" 
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="dropdown-item text-danger"
                            >
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>{{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</nav>