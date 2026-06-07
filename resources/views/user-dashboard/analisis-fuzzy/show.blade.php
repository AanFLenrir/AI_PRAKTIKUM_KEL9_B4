@extends('layouts.app-user')

@section('title', 'Detail Analisis Gizi - SIFUZI Balita')

@push('page-style')
<style>
    .detail-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        display: block;
        margin-bottom: 2px;
    }
    .info-value {
        font-weight: 600;
        color: #212529;
    }
    .zscore-badge {
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        display: inline-block;
    }
    .z-normal {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    .z-warning {
        background-color: #fffde7;
        color: #f57f17;
    }
    .z-danger {
        background-color: #ffebee;
        color: #c62828;
    }
    .z-info {
        background-color: #e3f2fd;
        color: #0d47a1;
    }
    .z-muted {
        background-color: #f5f5f5;
        color: #616161;
    }
    .rule-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .rule-card {
        border-left: 4px solid var(--color-primary);
        background-color: #fcfdfc;
    }
</style>
@endpush

@section('content')
<section class="container py-4">

    {{-- KEMBALI BUTTON --}}
    <div class="mb-3">
        <a href="{{ route('analisis-fuzzy.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
            <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    {{-- HERO SECTION --}}
    <div class="mb-4">
        <span class="hero-badge">DETAIL ANALISIS GIZI</span>
        <h1 class="fw-bold mt-2">Hasil Pemeriksaan Balita</h1>
        <p class="text-muted">Rincian status gizi balita berdasarkan perhitungan Z-Score dan logika fuzzy Mamdani.</p>
    </div>

    <div class="row g-4">
        {{-- LEFT COLUMN: Profil Balita & Pengukuran Fisik --}}
        <div class="col-lg-5 col-md-12">
            <!-- Profil Balita Card -->
            <div class="card detail-card p-4 mb-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-baby me-2"></i>Identitas Balita</h5>
                <hr class="mt-0 mb-3 text-muted">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="info-label">Nama Balita</span>
                        <span class="info-value fs-5 text-dark">{{ $pemeriksaan->balita->nama_balita }}</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Jenis Kelamin</span>
                        @if($pemeriksaan->balita->jenis_kelamin === 'L')
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill"><i class="fa-solid fa-mars me-1"></i>Laki-laki</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>
                        @endif
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($pemeriksaan->balita->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Umur pada Pemeriksaan</span>
                        <span class="badge bg-success px-3 py-2 rounded-pill">{{ number_format($pemeriksaan->umur_bulan, 1) }} Bulan</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Tanggal Pemeriksaan</span>
                        <span class="info-value text-muted">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_periksa)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="col-12">
                        <span class="info-label">Tenaga Kesehatan Pemeriksa</span>
                        <span class="info-value text-dark"><i class="fa-solid fa-user-doctor me-1 text-success"></i> {{ $pemeriksaan->petugas->name ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Pengukuran Fisik Card -->
            <div class="card detail-card p-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-weight-scale me-2"></i>Pengukuran Fisik</h5>
                <hr class="mt-0 mb-3 text-muted">
                <div class="row g-3">
                    <div class="col-md-4 col-4 text-center border-end">
                        <span class="info-label">Berat Badan</span>
                        <span class="info-value fs-4 text-success">{{ number_format($pemeriksaan->berat_badan, 2) }}</span> <span class="small text-muted">kg</span>
                    </div>
                    <div class="col-md-4 col-4 text-center border-end">
                        <span class="info-label">Tinggi Badan</span>
                        <span class="info-value fs-4 text-success">{{ number_format($pemeriksaan->tinggi_badan, 2) }}</span> <span class="small text-muted">cm</span>
                    </div>
                    <div class="col-md-4 col-4 text-center">
                        <span class="info-label">Nilai IMT</span>
                        <span class="info-value fs-4 text-dark">{{ $pemeriksaan->imt ? number_format($pemeriksaan->imt, 2) : '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Imunisasi yang Diterima Card -->
            <div class="card detail-card p-4 mt-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-syringe me-2"></i>Imunisasi yang Diterima</h5>
                <hr class="mt-0 mb-3 text-muted">
                @if($pemeriksaan->imunisasi->isEmpty())
                    <div class="alert alert-secondary py-3 text-center mb-0 small">
                        Tidak ada riwayat imunisasi yang tercatat pada pemeriksaan ini.
                    </div>
                @else
                    <div class="overflow-y-auto" style="max-height: 280px; padding-right: 6px;">
                        <div class="row g-2">
                            @foreach($pemeriksaan->imunisasi as $imun)
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class="p-2.5 border rounded-3 bg-light d-flex align-items-start gap-2.5" style="font-size: 0.85rem;" data-bs-toggle="tooltip" title="{{ $imun->keterangan_imunisasi }}">
                                        <i class="fa-solid fa-circle-check text-success mt-0.5" style="font-size: 1rem;"></i>
                                        <div>
                                            <strong class="d-block text-dark">{{ $imun->nama_imunisasi }}</strong>
                                            <span class="small text-muted" style="font-size: 0.75rem;">Rekomendasi: {{ $imun->umur_bulan }} Bulan</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT COLUMN: Z-Score & Fuzzy Analysis --}}
        <div class="col-lg-7 col-md-12">
            <!-- Klasifikasi Z-Score Card -->
            <div class="card detail-card p-4 mb-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-calculator me-2"></i>Status Antropometri (Z-Score WHO/Kemenkes)</h5>
                <hr class="mt-0 mb-3 text-muted">

                @php
                    // Helper function to color code Z-Score categories
                    if (!function_exists('getZScoreBadgeClass')) {
                        function getZScoreBadgeClass($category) {
                            if (empty($category) || $category === 'Data SD tidak tersedia') {
                                return 'z-muted';
                            }
                            $cat = strtolower($category);
                            if (str_contains($cat, 'normal') || str_contains($cat, 'tinggi')) {
                                return 'z-normal';
                            }
                            if (str_contains($cat, 'sangat kurang') || str_contains($cat, 'sangat pendek') || str_contains($cat, 'buruk')) {
                                return 'z-danger';
                            }
                            if (str_contains($cat, 'kurang') || str_contains($cat, 'pendek') || str_contains($cat, 'berisiko') || str_contains($cat, 'lebih') || str_contains($cat, 'obesitas')) {
                                return 'z-warning';
                            }
                            return 'z-info';
                        }
                    }
                @endphp

                <div class="row g-3">
                    <div class="col-md-6 col-12">
                        <span class="info-label">Berat Badan menurut Umur (BB/U)</span>
                        <span class="zscore-badge {{ getZScoreBadgeClass($pemeriksaan->kategori_bbu) }} w-100 text-center">
                            {{ $pemeriksaan->kategori_bbu ?? 'Data SD tidak tersedia' }}
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Panjang/Tinggi Badan menurut Umur (PB/U)</span>
                        <span class="zscore-badge {{ getZScoreBadgeClass($pemeriksaan->kategori_pbu) }} w-100 text-center">
                            {{ $pemeriksaan->kategori_pbu ?? 'Data SD tidak tersedia' }}
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Berat Badan menurut Panjang/Tinggi (BB/PB)</span>
                        <span class="zscore-badge {{ getZScoreBadgeClass($pemeriksaan->kategori_bbpb) }} w-100 text-center">
                            {{ $pemeriksaan->kategori_bbpb ?? 'Data SD tidak tersedia' }}
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Indeks Massa Tubuh menurut Umur (IMT/U)</span>
                        <span class="zscore-badge {{ getZScoreBadgeClass($pemeriksaan->kategori_imtu) }} w-100 text-center">
                            {{ $pemeriksaan->kategori_imtu ?? 'Data SD tidak tersedia' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Hasil Fuzzy Mamdani Card -->
            <div class="card detail-card p-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-gears me-2"></i>Hasil Evaluasi Logika Fuzzy (Mamdani)</h5>
                <hr class="mt-0 mb-3 text-muted">

                @php
                    $statusName = $pemeriksaan->statusGizi->nama_status ?? 'Tidak Diketahui';
                    $statusClass = 'z-normal';
                    if ($statusName === 'Gizi Buruk') $statusClass = 'z-danger';
                    elseif ($statusName === 'Gizi Kurang') $statusClass = 'z-warning';
                    elseif ($statusName === 'Gizi Lebih' || $statusName === 'Obesitas') $statusClass = 'z-warning';
                @endphp

                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-12">
                        <span class="info-label">Status Gizi Akhir (Fuzzy)</span>
                        <span class="zscore-badge {{ $statusClass }} fs-6 fw-bold w-100 text-center py-2.5">
                            {{ $statusName }}
                        </span>
                    </div>
                    <div class="col-md-6 col-12 text-center text-md-start border-start-md ps-md-4">
                        <span class="info-label">Nilai Defuzzifikasi (Skor Gizi)</span>
                        <span class="d-block fs-3 fw-bold text-dark">{{ number_format($pemeriksaan->nilai_fuzzy, 4) }}</span>
                    </div>
                </div>

                <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-list-check me-2 text-success"></i>Aturan Fuzzy (Rule) yang Aktif</h6>
                @if($pemeriksaan->detailHasilFuzzy->isEmpty())
                    <div class="alert alert-secondary py-3 text-center mb-0">
                        Tidak ada aturan fuzzy aktif yang tercatat untuk pemeriksaan ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle rule-table mb-0 small">
                            <thead>
                                <tr>
                                    <th>Kode/Aturan Aktif</th>
                                    <th style="width: 100px;" class="text-center">α-Predikat</th>
                                    <th style="width: 100px;" class="text-center">Defuzzy</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemeriksaan->detailHasilFuzzy as $rule)
                                    <tr>
                                        <td>
                                            <div class="p-2 rule-card rounded-1">
                                                <code>{{ $rule->rule_aktif }}</code>
                                            </div>
                                        </td>
                                        <td class="text-center fw-semibold text-dark">{{ number_format($rule->alpha_predikat, 4) }}</td>
                                        <td class="text-center fw-semibold text-dark">{{ number_format($rule->nilai_defuzzy, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

</section>
@endsection
