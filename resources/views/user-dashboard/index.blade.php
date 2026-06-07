@extends('layouts.app-user')

@section('title', 'Dashboard - SIFUZI Balita')

@push('page-style')
<style>
    .dashboard-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(25, 135, 84, 0.08);
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        min-height: 3.75rem;
        display: flex;
        align-items: center;
    }
</style>
@endpush

@section('content')
<section class="container py-4">

    {{-- HERO / HEADER SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <span class="hero-badge">DASHBOARD</span>
            <h1 class="fw-bold mt-2 mb-0">Selamat Datang di SIFUZI Balita</h1>
            <p class="text-muted mb-0">Monitoring status gizi balita menggunakan logika fuzzy Mamdani.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('analisis-fuzzy.create', ['new' => 1]) }}" class="btn btn-primary px-4 py-2.5 rounded-3 d-flex align-items-center gap-2 text-white text-decoration-none">
                <i class="fa-solid fa-calculator"></i> Lakukan Analisis
            </a>
            <button id="btn_refresh" class="btn btn-success px-4 py-2.5 rounded-3 d-flex align-items-center gap-2 text-white">
                <i class="fa-solid fa-arrows-rotate" id="refresh_icon"></i> Refresh Data
            </button>
        </div>
    </div>

    {{-- 1. USER PROFILE SUMMARY CARD --}}
    <div class="card dashboard-card p-4 mb-4 bg-white">
        <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-user-gear me-2"></i>Profil Pengguna</h5>
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="bg-success-subtle text-success d-flex align-items-center justify-content-center rounded-circle" style="width: 65px; height: 65px; font-size: 1.8rem; background-color: #d1e7dd;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <div class="col">
                <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-muted mb-0 mb-sm-1">{{ Auth::user()->email }}</p>
                @php
                    $roleName = Auth::user()->getRoleNames()->first();
                    $displayRole = match($roleName) {
                        'admin' => 'Administrator',
                        'tenaga-kesehatan' => 'Tenaga Kesehatan',
                        'orang-tua' => 'Orang Tua / Wali',
                        default => ucfirst($roleName)
                    };
                @endphp
                <span class="badge bg-success px-3 py-1.5 rounded-pill" style="font-size: 0.75rem;">{{ $displayRole }}</span>
            </div>
        </div>
    </div>

    {{-- 2. STATISTICS SECTION --}}
    <div class="row g-4" id="stats_container">
        {{-- Total Balita Card --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card dashboard-card p-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small d-block">TOTAL BALITA</span>
                        <div id="stat_balita" class="stat-number text-dark mt-2">
                            <span class="spinner-border spinner-border text-success" role="status"></span>
                        </div>
                    </div>
                    <div class="bg-primary-subtle text-primary p-3 rounded-3" style="background-color: #e3f2fd;">
                        <i class="fa-solid fa-baby fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pemeriksaan Card --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card dashboard-card p-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted fw-semibold small d-block">TOTAL PEMERIKSAAN</span>
                        <div id="stat_pemeriksaan" class="stat-number text-dark mt-2">
                            <span class="spinner-border spinner-border text-success" role="status"></span>
                        </div>
                    </div>
                    <div class="bg-success-subtle text-success p-3 rounded-3" style="background-color: #e8f5e9;">
                        <i class="fa-solid fa-clipboard-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Orang Tua Card (Tenaga Kesehatan Only) --}}
        @if(Auth::user()->can('view-any-balita'))
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card dashboard-card p-4 bg-white h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted fw-semibold small d-block">TOTAL ORANG TUA / WALI</span>
                            <div id="stat_ortu" class="stat-number text-dark mt-2">
                                <span class="spinner-border spinner-border text-success" role="status"></span>
                            </div>
                        </div>
                        <div class="bg-warning-subtle text-warning p-3 rounded-3" style="background-color: #fffde7;">
                            <i class="fa-solid fa-users fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- 3. CHART SECTION --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card dashboard-card p-4 bg-white">
                <h5 class="fw-bold text-success mb-4"><i class="fa-solid fa-chart-pie me-2"></i>Distribusi Status Gizi Balita (Pemeriksaan Terbaru)</h5>
                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="nutritionalStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Register the Chart.js DataLabels plugin
    Chart.register(ChartDataLabels);

    $(document).ready(function() {
        // Global chart instance
        window.nutritionalChart = null;

        // Function to load stats from endpoint
        function loadStats() {
            // Show loading spinners
            $('#stat_balita').html('<span class="spinner-border spinner-border-sm text-success" role="status"></span>');
            $('#stat_pemeriksaan').html('<span class="spinner-border spinner-border-sm text-success" role="status"></span>');
            if ($('#stat_ortu').length) {
                $('#stat_ortu').html('<span class="spinner-border spinner-border-sm text-success" role="status"></span>');
            }

            // Animate refresh icon rotation
            $('#refresh_icon').addClass('fa-spin');
            $('#btn_refresh').prop('disabled', true);

            $.ajax({
                url: "{{ route('dashboard.stats') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data)

                    // Update stats counters
                    $('#stat_balita').text(data.total_balita);
                    $('#stat_pemeriksaan').text(data.total_pemeriksaan);
                    if ($('#stat_ortu').length && data.total_ortu !== undefined) {
                        $('#stat_ortu').text(data.total_ortu);
                    }

                    // Render or update Chart.js
                    const distribution = data.status_distribution;
                    if (distribution) {
                        const labels = Object.keys(distribution);
                        const values = Object.values(distribution);

                        const canvasCtx = document.getElementById('nutritionalStatusChart').getContext('2d');

                        if (window.nutritionalChart) {
                            window.nutritionalChart.destroy();
                        }

                        window.nutritionalChart = new Chart(canvasCtx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: [
                                        '#dc3545', // Gizi Buruk (Red)
                                        '#ffc107', // Gizi Kurang (Yellow)
                                        '#198754', // Normal (Green)
                                        '#0dcaf0', // Gizi Lebih (Cyan)
                                        '#6c757d'  // Obesitas (Grey)
                                    ],
                                    borderWidth: 2,
                                    borderColor: '#ffffff'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: window.innerWidth < 768 ? 'bottom' : 'right',
                                        labels: {
                                            boxWidth: 15,
                                            usePointStyle: true,
                                            padding: 15,
                                            font: {
                                                weight: '600'
                                            }
                                        }
                                    },
                                    datalabels: {
                                        color: '#ffffff',
                                        font: {
                                            weight: 'bold',
                                            size: 14
                                        },
                                        formatter: function(value) {
                                            return value > 0 ? value : '';
                                        }
                                    }
                                },
                                cutout: '65%'
                            }
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Gagal memuat data statistik", xhr);
                    $('#stat_balita').text('Err');
                    $('#stat_pemeriksaan').text('Err');
                    if ($('#stat_ortu').length) {
                        $('#stat_ortu').text('Err');
                    }
                },
                complete: function() {
                    $('#refresh_icon').removeClass('fa-spin');
                    $('#btn_refresh').prop('disabled', false);
                }
            });
        }

        // Trigger loadStats on page load
        loadStats();

        // Bind Refresh Button click
        $('#btn_refresh').click(function(e) {
            e.preventDefault();
            loadStats();
        });
    });
</script>
@endpush
