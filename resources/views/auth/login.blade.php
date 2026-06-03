@extends('layouts.app')

@section('title', 'Login - SIFUZI Balita')

@push('page-style')
<style>
    /* CUSTOM CSS FOR PAGE */
</style>
@endpush

@section('header')
<nav></nav>
@endsection

{{-- MAIN CONTENT SECTION --}}
@section('content')

    <section class="auth-section">
        <div class="container mt-5">
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
                                <label class="form-label" for="email">Email</label>
                                {{-- <input type="email" class="form-control" placeholder="Masukkan email"> --}}
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username"
                                    placeholder="Masukkan email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                {{-- <input type="password" class="form-control" placeholder="Masukkan password"> --}}
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="current-password" placeholder="Masukkan password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2">
                                Login
                            </button>

                            {{-- ! HIDDEN ! --}}
                            <button type="reset" class="hidden btn btn-success w-100 py-2">
                                RESET
                            </button>
                            {{-- ! HIDDEN ! --}}

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

{{-- CDNs --}}
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{-- JQUERY --}}
@endpush

{{-- CDNs Style --}}
@push('page-style')
<link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
@endpush

{{-- FORM UTILITY SCRIPT --}}
{{-- Error Before Send Script --}}
@push('script')
    <script>
        $(document).ready(function () {
            const form = $("main form")
            $("button[type='submit']").click(function (e) {
                let isValid = true
                e.preventDefault()

                const inputs = form.find("input")
                const selects = form.find("select")

                inputs.each(function () {
                    if (this.validity.valueMissing) {
                        isValid = false
                        this.classList.add('is-invalid')
                        const requiredErrSPAN = $('<span>', {
                            class: "error",
                            text: "Required"
                        })

                        if ($(this).parent().hasClass("input-group")) {
                            $(this).parent().addClass("outline-red")
                            if ($(this).parent().next(".error").length === 0) {
                                $(this).parent().after(requiredErrSPAN)
                            }
                        } else {
                            if (!$(this).next().hasClass("error")) {
                                $(this).after(requiredErrSPAN)
                            }
                        }
                    }
                })

                selects.each(function () {
                    if (this.validity.valueMissing) {
                        isValid = false
                        this.classList.remove('form-select')
                        this.classList.add('is-invalid')
                        this.classList.add('form-select-invalid')

                        if (!$(this).next().hasClass("error")) {
                            const requiredErrSPAN = $('<span>', {
                                class: "error",
                                text: "Required"
                            })
                            $(this).after(requiredErrSPAN)
                        }
                    }
                })

                if (isValid) {
                    $("main form input, main form select").prop('readonly', true)
                    $("main form button[type='submit'], main form button[type='reset']").prop('disabled', true)

                    $(this).removeClass('btn-success')
                    $(this).addClass('btn-secondary')
                    $(this).html(`
                        <span class="spinner-border spinner-border-sm me-2"></span>
                        Loading...
                    `)

                    form.submit()
                }
            })
        })
    </script>
@endpush
{{-- Star when field changed --}}
@push('script')
    <script>
        // Bintang Bintang 
        const resetInputStar = () => {
            const labels = document.querySelectorAll('label');
            labels.forEach((label) => {
                const star = label.querySelector('span.text-danger');
                if (star) {
                    star.remove();
                }
            })
        }

        const inputGroups = document.querySelectorAll("main form .input-group")
        const inputs = document.querySelectorAll('main form input');
        const selects = document.querySelectorAll('main form select');
        const resetBtn = document.querySelector('button[type="reset"]')
        resetBtn.addEventListener('click', (e) => {
            resetInputStar()
            inputs.forEach((input) => {
                input.classList.remove('is-invalid')
            })
            selects.forEach((select) => {
                select.classList.remove('is-invalid')
                select.classList.remove('form-select-invalid')
                select.classList.add('form-select')
            })
            inputGroups.forEach((inputGroup) => {
                inputGroup.classList.remove('outline-red')
            })
            document.querySelectorAll('.error').forEach((e) => e.remove())
        })

        inputs.forEach((input) => {
            input.addEventListener('input', function () {
                console.log('a')
                let label = document.querySelector('label[for="' + input.id + '"]');

                if (label && !label.querySelector('span')) {
                    label.innerHTML += ' <span class="text-muted">*</span>';
                }
            });
        });

        selects.forEach((input) => {
            input.addEventListener('input', function () {
                let label = document.querySelector('label[for="' + input.id + '"]');

                if (label && !label.querySelector('span')) {
                    label.innerHTML += ' <span class="text-muted">*</span>';
                }
            });
        });

    </script>
@endpush

{{-- FORM STYLE CLASSES --}}
@push('page-style')
    <style>
        .error {
            color: red;
        }
        .outline-red {
            outline: red 1px solid
        }
        .form-select-invalid {
            padding: 0.4375rem 0.75rem;
            border: 0;
            outline: 1px solid #ff0000;
            color: #ff3b3b;
            display: block;
            width: 100%;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border-radius: var(--bs-border-radius);
            --bs-form-select-bg-img: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e);
        }
    </style>
@endpush

{{-- SCRIPT PAGE --}}
@push('script')
<script>
    
</script>
@endpush