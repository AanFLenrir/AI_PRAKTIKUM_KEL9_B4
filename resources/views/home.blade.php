@extends('layouts.app')

@section('title', 'Home - SIFUZI Balita')

@section('content')

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-5">

            <div class="col-lg-6">
                <span class="hero-badge">
                    <i class="bi bi-activity"></i> Sistem Analisis Status Gizi Balita
                </span>

                <h1 class="hero-title">
                    Analisis Status Gizi Balita dengan Metode Fuzzy Mamdani
                </h1>

                <p class="hero-text mt-3">
                    SIFUZI Balita membantu petugas dalam menentukan status gizi balita
                    berdasarkan umur, berat badan, tinggi badan, dan status imunisasi
                    secara lebih terstruktur dan informatif.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                    <a href="/login" class="btn btn-success btn-lg px-4 w-100 w-sm-auto text-center">
                        Mulai Analisis
                    </a>
                    <a href="/about" class="btn btn-outline-success btn-lg px-4 w-100 w-sm-auto text-center">
                        Pelajari Sistem
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-card">
                    <div class="text-center mb-4">
                        <i class="bi bi-clipboard2-pulse text-success" style="font-size: 5rem;"></i>
                        <h4 class="fw-bold mt-3">Monitoring Gizi Balita</h4>
                        <p class="text-muted">
                            Sistem membantu membaca data pemeriksaan dan menghasilkan status gizi.
                        </p>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-card p-3 text-center">
                                <h3 class="text-success fw-bold">120+</h3>
                                <p class="mb-0">Data Balita</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card p-3 text-center">
                                <h3 class="text-success fw-bold">85+</h3>
                                <p class="mb-0">Analisis</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card p-3 text-center">
                                <h3 class="text-success fw-bold">5</h3>
                                <p class="mb-0">Status Gizi</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card p-3 text-center">
                                <h3 class="text-success fw-bold">24</h3>
                                <p class="mb-0">Rules Fuzzy</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Fitur Utama Sistem</h2>
        <p class="text-muted">
            Beberapa fitur yang mendukung proses analisis status gizi balita.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="feature-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5 class="fw-bold">Data Balita</h5>
                <p class="text-muted">
                    Mengelola data identitas balita dan informasi orang tua.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-capsule"></i>
                </div>
                <h5 class="fw-bold">Imunisasi</h5>
                <p class="text-muted">
                    Mencatat status imunisasi sebagai salah satu faktor analisis.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-cpu-fill"></i>
                </div>
                <h5 class="fw-bold">Fuzzy Mamdani</h5>
                <p class="text-muted">
                    Mengolah data pemeriksaan menggunakan rule fuzzy.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-bar-chart-fill"></i>
                </div>
                <h5 class="fw-bold">Hasil Diagnosa</h5>
                <p class="text-muted">
                    Menampilkan hasil status gizi akhir secara jelas.
                </p>
            </div>
        </div>

    </div>
</section>

<section class="container pb-5">
    <div class="row align-items-center g-4">
        <div class="col-md-6">
            <div class="info-card p-4">
                <h3 class="fw-bold">Mengapa Menggunakan Sistem Ini?</h3>
                <p class="text-muted">
                    Sistem ini dirancang agar proses pemeriksaan status gizi menjadi
                    lebih mudah, rapi, dan terdokumentasi.
                </p>

                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Data balita tersimpan rapi</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Proses analisis lebih cepat</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Menggunakan metode Fuzzy Mamdani</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Hasil diagnosa mudah dipahami</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card p-4 bg-success text-white">
                <h3 class="fw-bold">Status Gizi yang Dihasilkan</h3>
                <p>
                    Sistem dapat menghasilkan beberapa kategori status gizi balita.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-success p-2">Gizi Buruk</span>
                    <span class="badge bg-light text-success p-2">Gizi Kurang</span>
                    <span class="badge bg-light text-success p-2">Normal</span>
                    <span class="badge bg-light text-success p-2">Gizi Lebih</span>
                    <span class="badge bg-light text-success p-2">Obesitas</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection