@extends('layouts.app-user')

@section('title', 'Profil Saya - SIFUZI Balita')

@section('content')
<section class="container py-4">
    {{-- BREADCRUMB / HERO BADGE --}}
    <div class="mb-4">
        <span class="hero-badge">PROFIL SAYA</span>
        <h1 class="fw-bold mt-2">Detail Informasi Pengguna</h1>
        <p class="text-muted">Informasi data diri Anda yang terdaftar pada sistem (hanya-baca).</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white">
                <div class="d-flex align-items-center gap-4 mb-4 flex-wrap flex-sm-nowrap">
                    <div class="bg-success-subtle text-success d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; font-size: 2.5rem; background-color: #d1e7dd;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        @php
                            $roleName = $user->getRoleNames()->first();
                            $displayRole = match($roleName) {
                                'admin' => 'Administrator',
                                'tenaga-kesehatan' => 'Tenaga Kesehatan',
                                'orang-tua' => 'Orang Tua / Wali',
                                default => ucfirst($roleName)
                            };
                        @endphp
                        <span class="badge bg-success px-3 py-2 rounded-pill">{{ $displayRole }}</span>
                    </div>
                </div>

                <hr class="text-muted mb-4">

                <form onsubmit="event.preventDefault();">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold text-muted">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold text-muted">Alamat Email</label>
                            <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                        </div>

                        @if($user->hasRole('orang-tua') && $user->orangTua)
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold text-muted">Nomor HP / WhatsApp</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->orangTua->no_hp ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold text-muted">Alamat Rumah</label>
                                <textarea class="form-control bg-light" rows="2" readonly>{{ $user->orangTua->alamat ?? '-' }}</textarea>
                            </div>
                        @endif

                        @if($user->hasRole('tenaga-kesehatan'))
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold text-muted">Status Kepegawaian</label>
                                <input type="text" class="form-control bg-light" value="Tenaga Kesehatan Aktif" readonly>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold text-muted">Institusi / Posyandu</label>
                                <input type="text" class="form-control bg-light" value="SIFUZI Balita Posyandu Pusat" readonly>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-3 mt-4 pt-2">
                        <button type="submit" class="btn btn-success px-4 py-2.5 fw-semibold text-white" onclick="alert('Fungsi edit dinonaktifkan. Profil bersifat Read-Only.')">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 py-2.5 fw-semibold">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection