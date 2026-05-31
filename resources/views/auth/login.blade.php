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

                        <form method="POST" action="{{ route('login') }}">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                {{-- <input type="email" class="form-control" placeholder="Masukkan email"> --}}
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username"
                                    placeholder="Masukkan email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                {{-- <input type="password" class="form-control" placeholder="Masukkan password"> --}}
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="current-password" placeholder="Masukkan password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2">
                                Login
                            </button>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="remember">
                                    <span
                                        class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                            </div>
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