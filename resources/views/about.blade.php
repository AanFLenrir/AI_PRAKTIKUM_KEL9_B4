@extends('layouts.app')

@section('title', 'Tentang Aplikasi - SIFUZI Balita')

@section('content')

<section class="container py-5">

    <div class="text-center mb-5">
        <span class="hero-badge">Tentang Aplikasi</span>
        <h1 class="fw-bold">SIFUZI Balita</h1>
        <p class="text-muted">
            Sistem Fuzzy Mamdani untuk membantu analisis status gizi balita.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="info-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-info-circle-fill"></i>
                </div>

                <h4 class="fw-bold">Deskripsi Sistem</h4>
                <p>
                    SIFUZI Balita merupakan aplikasi berbasis web yang digunakan
                    untuk membantu proses analisis status gizi balita berdasarkan
                    data pemeriksaan seperti umur, berat badan, tinggi badan,
                    dan status imunisasi.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card p-4 h-100">
                <div class="icon-box">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>

                <h4 class="fw-bold">Metode Mamdani</h4>
                <p>
                    Metode Fuzzy Mamdani digunakan untuk mengolah input pemeriksaan
                    menjadi hasil status gizi melalui tahapan fuzzifikasi,
                    penerapan rules, inferensi, dan defuzzifikasi.
                </p>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-3">

        <div class="col-md-6">
            <div class="info-card p-4 h-100">
                <h4 class="fw-bold">Tujuan Aplikasi</h4>

                <ul>
                    <li>Membantu petugas mengelola data balita.</li>
                    <li>Membantu menentukan status gizi balita.</li>
                    <li>Menyediakan hasil diagnosa yang mudah dibaca.</li>
                    <li>Mendukung pengambilan keputusan berbasis data.</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card p-4 h-100">
                <h4 class="fw-bold">Anggota Kelompok</h4>

                <ul>
                    <li>Nama Anggota 1</li>
                    <li>Nama Anggota 2</li>
                    <li>Nama Anggota 3</li>
                    <li>Nama Anggota 4</li>
                </ul>
            </div>
        </div>

    </div>

</section>

@endsection