<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="/">
            <i class="bi bi-heart-pulse-fill"></i> SIFUZI Balita
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2 pt-3 pt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-success fw-semibold' : '' }}" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active text-success fw-semibold' : '' }}"
                        href="/about">
                        Tentang
                    </a>
                </li>

                @role('orang-tua|tenaga-kesehatan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is(route('balita.index')) ? 'active text-success fw-semibold' : '' }}"
                        href="{{ route('balita.index') }}">
                        Data Balita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is(route('analisis-fuzzy.create')) ? 'active text-success fw-semibold' : '' }}"
                        href="{{ route('analisis-fuzzy.create') }}">
                        Analisis Sekarang
                    </a>
                </li>
                @endrole

                @role('tenaga-kesehatan')
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-success fw-semibold' : '' }}"
                        href="/">
                        Ini Nakes
                    </a>
                </li> --}}
                @endrole

                @if (auth()->user())
                    <li class="nav-item w-100 w-lg-auto">
                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <a href="#" 
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="btn btn-outline-success w-100 w-lg-auto px-4"
                            >
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                @else
                    <li class="nav-item w-100 w-lg-auto">
                        <a class="btn btn-outline-success w-100 w-lg-auto px-4" href="/login">
                            Login
                        </a>
                    </li>
                @endif

                @if (auth()->user())
                    <li class="nav-item w-100 w-lg-auto">
                        <a class="btn btn-success w-100 w-lg-auto px-4" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item w-100 w-lg-auto">
                        <a class="btn btn-success w-100 w-lg-auto px-4" href="/register">
                            Register
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>