@extends('layouts.app')

@section('title', 'Register - SIFUZI Balita')

@section('content')

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-5">
                <div class="auth-card card p-4">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus-fill text-success" style="font-size: 4rem;"></i>
                        <h3 class="fw-bold mt-3">Buat Akun</h3>
                        <p class="text-muted">
                            Daftar untuk menggunakan sistem SIFUZI Balita.
                        </p>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan password">
                        </div>

                        <input type="hidden" value="petugas">

                        <button type="button" class="btn btn-success w-100 py-2">
                            Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            Sudah punya akun?
                            <a href="/login" class="text-success fw-semibold">Login di sini</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection