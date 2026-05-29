@extends('layouts.app')

@section('title', 'Login - SIFUZI Balita')

@section('content')

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-5">
                <div class="auth-card card p-4">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle text-success" style="font-size: 4rem;"></i>
                        <h3 class="fw-bold mt-3">Login Pengguna</h3>
                        <p class="text-muted">
                            Masuk untuk mengakses sistem analisis gizi balita.
                        </p>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan password">
                        </div>

                        <button type="button" class="btn btn-success w-100 py-2">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            Belum punya akun?
                            <a href="/register" class="text-success fw-semibold">Daftar sekarang</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection