@extends('layouts.app-user')

@section('title', 'Analisis Gizi - SIFUZI Balita')

@push('page-style')
<style>
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }
    .custom-table th {
        background-color: var(--color-primary);
        color: #ffffff;
        font-weight: 600;
        border: none;
    }
    .custom-table td {
        vertical-align: middle;
    }
    .gender-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    .gender-l {
        background-color: #e3f2fd;
        color: #0d6efd;
    }
    .gender-p {
        background-color: #fce4ec;
        color: #e91e63;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        display: inline-block;
    }
    .status-gizi-buruk {
        background-color: #f8d7da;
        color: #842029;
    }
    .status-gizi-kurang {
        background-color: #fff3cd;
        color: #664d03;
    }
    .status-normal {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .status-gizi-lebih {
        background-color: #cff4fc;
        color: #087990;
    }
    .status-obesitas {
        background-color: #e2e3e5;
        color: #41464b;
    }
    .mobile-card {
        border: 1px solid #e9ecef;
        border-radius: 16px;
        transition: 0.2s;
    }
    .mobile-card:hover {
        border-color: var(--color-primary);
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.08);
    }
</style>
@endpush

@section('content')
<section class="container py-4">

    {{-- BREADCRUMB / HERO BADGE --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <span class="hero-badge">ANALISIS GIZI</span>
            <h1 class="fw-bold mt-2 mb-0">Riwayat Pemeriksaan & Analisis Gizi</h1>
            <p class="text-muted mb-0">Lihat hasil analisis fuzzy gizi balita serta klasifikasi antropometri Z-Score secara lengkap.</p>
        </div>
        <a href="{{ route('analisis-fuzzy.create', ['new' => 1]) }}" class="btn btn-success px-4 py-2.5 rounded-3">
            <i class="fa-solid fa-calculator me-2"></i>Lakukan Analisis
        </a>
    </div>

    <!-- Search Box -->
    <div class="card info-card shadow-sm p-4 mb-4">
        <form action="{{ route('analisis-fuzzy.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-9 col-sm-8">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama balita..." value="{{ $search ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 d-grid">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1"><i class="fa-solid fa-filter me-2"></i>Cari</button>
                    @if(!empty($search))
                        <a href="{{ route('analisis-fuzzy.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Data Table / Cards -->
    <div class="card info-card shadow-sm p-4">
        @if($pemeriksaans->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-chart-line text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted mb-0">Belum ada riwayat analisis gizi yang terdaftar.</p>
            </div>
        @else
            <!-- Desktop Table View -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle custom-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Balita</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Periksa</th>
                            <th>Umur (Bulan)</th>
                            <th>Status Gizi (Fuzzy)</th>
                            <th>Nilai Fuzzy</th>
                            <th style="width: 120px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemeriksaans as $index => $p)
                            @php
                                $statusName = $p->statusGizi->nama_status ?? 'Tidak Diketahui';
                                $statusClass = 'status-normal';
                                if ($statusName === 'Gizi Buruk') $statusClass = 'status-gizi-buruk';
                                elseif ($statusName === 'Gizi Kurang') $statusClass = 'status-gizi-kurang';
                                elseif ($statusName === 'Gizi Lebih') $statusClass = 'status-gizi-lebih';
                                elseif ($statusName === 'Obesitas') $statusClass = 'status-obesitas';
                            @endphp
                            <tr>
                                <td>{{ $pemeriksaans->firstItem() + $index }}</td>
                                <td class="fw-semibold text-dark">{{ $p->balita->nama_balita }}</td>
                                <td>
                                    @if($p->balita->jenis_kelamin === 'L')
                                        <span class="gender-badge gender-l"><i class="fa-solid fa-mars me-1"></i>Laki-laki</span>
                                    @else
                                        <span class="gender-badge gender-p"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_periksa)->translatedFormat('d F Y') }}</td>
                                <td><span class="badge bg-success py-2 px-3 rounded-pill">{{ number_format($p->umur_bulan, 1) }} Bulan</span></td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">{{ $statusName }}</span>
                                </td>
                                <td class="fw-bold">{{ number_format($p->nilai_fuzzy, 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('analisis-fuzzy.show', $p->id_pemeriksaan) }}" class="btn btn-success btn-sm px-3 py-2">
                                        <i class="fa-regular fa-eye me-2"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="d-block d-md-none">
                @foreach($pemeriksaans as $index => $p)
                    @php
                        $statusName = $p->statusGizi->nama_status ?? 'Tidak Diketahui';
                        $statusClass = 'status-normal';
                        if ($statusName === 'Gizi Buruk') $statusClass = 'status-gizi-buruk';
                        elseif ($statusName === 'Gizi Kurang') $statusClass = 'status-gizi-kurang';
                        elseif ($statusName === 'Gizi Lebih') $statusClass = 'status-gizi-lebih';
                        elseif ($statusName === 'Obesitas') $statusClass = 'status-obesitas';
                    @endphp
                    <div class="mobile-card p-3 mb-3 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold text-dark mb-0">{{ $p->balita->nama_balita }}</h6>
                            <span class="badge bg-success rounded-pill px-2.5 py-1.5">{{ number_format($p->umur_bulan, 1) }} Bulan</span>
                        </div>
                        <div class="mb-2">
                            @if($p->balita->jenis_kelamin === 'L')
                                <span class="gender-badge gender-l d-inline-block"><i class="fa-solid fa-mars me-1"></i>Laki-laki</span>
                            @else
                                <span class="gender-badge gender-p d-inline-block"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>
                            @endif
                        </div>
                        <div class="small text-muted mb-2">
                            <i class="fa-regular fa-calendar me-2 text-success"></i>{{ \Carbon\Carbon::parse($p->tanggal_periksa)->translatedFormat('d F Y') }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="status-badge {{ $statusClass }}">{{ $statusName }}</span>
                            <span class="small text-muted">Nilai: <strong class="text-dark">{{ number_format($p->nilai_fuzzy, 2) }}</strong></span>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('analisis-fuzzy.show', $p->id_pemeriksaan) }}" class="btn btn-success py-2 rounded-3 btn-sm fw-semibold">
                                <i class="fa-regular fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $pemeriksaans->appends(['search' => $search ?? ''])->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</section>
@endsection
