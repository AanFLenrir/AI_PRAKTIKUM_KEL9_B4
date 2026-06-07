<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard SIFUZI Balita')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- FOR NOW JUST USE THIS --}}
    <script src="https://kit.fontawesome.com/f714303560.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('page-style')

    {{-- To Hot Reload --}}
    {{-- @vite([]) --}}
</head>

<body class="dashboard-body sidebar-expanded font-sans antialiased">
    
    <!-- Top Header -->
    @include('partials.user.navigation')

    <!-- Left Sidebar -->
    @include('partials.user.sidebar')

    <!-- Overlay backdrop for mobile drawer -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="py-4 px-3">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Controller Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleSidebar = document.getElementById('sidebarToggleSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Responsive Sidebar Actions
            function toggleSidebar() {
                if (window.innerWidth >= 992) {
                    // Desktop: Toggle between Expanded and Collapsed
                    body.classList.toggle('sidebar-expanded');
                    body.classList.toggle('sidebar-collapsed');
                } else {
                    // Mobile: Toggle open state drawer
                    body.classList.toggle('sidebar-open');
                }
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarToggleSidebar) {
                sidebarToggleSidebar.addEventListener('click', toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    body.classList.remove('sidebar-open');
                });
            }

            // Initialize bootstrap tooltips for collapsed sidebar mode
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover'
                });
            });
        });
    </script>
    @stack('script')
</body>

</html>