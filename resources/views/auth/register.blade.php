@extends('layouts.app')

@section('title', 'Register - SIFUZI Balita')

@section('header')
<nav></nav>
@endsection

@section('content')

<section class="auth-section">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-6 col-lg-5">
                <div class="auth-card card p-4 shadow-sm border-0 bg-white" style="border-radius: 16px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus-fill text-success" style="font-size: 4rem;"></i>
                        <h3 class="fw-bold mt-2">Buat Akun</h3>
                        <p class="text-muted">
                            Daftar untuk menggunakan sistem SIFUZI Balita.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor HP -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="no_hp">Nomor HP / WhatsApp</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}" required autocomplete="tel">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="alamat">Alamat Tinggal</label>
                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap tinggal" rows="2" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi password" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2.5 fw-bold rounded-3">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-success fw-semibold text-decoration-none">Login di sini</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection