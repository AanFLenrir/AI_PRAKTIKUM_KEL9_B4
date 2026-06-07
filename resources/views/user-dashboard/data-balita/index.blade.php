@extends('layouts.app-user')

@section('title', 'Kelola Data Balita - SIFUZI Balita')

@push('page-style')
<style>
    .parent-info-card {
        border-left: 5px solid var(--color-primary);
    }
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }
    .custom-table th {
        background-color: var(--color-primary);
        color: #ffffff;
        font-weight: 600;
        border: none;
    }
    .custom-table td {
        vertical-align: middle;
    }
    .gender-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    .gender-l {
        background-color: #e3f2fd;
        color: #0d6efd;
    }
    .gender-p {
        background-color: #fce4ec;
        color: #e91e63;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: 0.2s;
    }
    .btn-action-edit {
        background-color: #fff3cd;
        color: #856404;
    }
    .btn-action-edit:hover {
        background-color: #ffe8a1;
    }
    .btn-action-analisis {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .btn-action-analisis:hover {
        background-color: #c1e2d3;
    }
    .btn-action-delete {
        background-color: #f8d7da;
        color: #721c24;
    }
    .btn-action-delete:hover {
        background-color: #f5c2c7;
    }
    .search-btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .mobile-card {
        border: 1px solid #e9ecef;
        border-radius: 16px;
        transition: 0.2s;
    }
    .mobile-card:hover {
        border-color: var(--color-primary);
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.08);
    }
</style>
@endpush

@section('content')
<section class="container py-4">

    {{-- BREADCRUMB / HERO BADGE --}}
    <div class="mb-4">
        <span class="hero-badge">DATA BALITA</span>
        @if(isset($parent))
            <h1 class="fw-bold mt-2">Kelola Balita</h1>
            <p class="text-muted">Kelola data balita milik orang tua: <strong>{{ $parent->user->name }}</strong></p>
        @else
            <h1 class="fw-bold mt-2">Daftar Orang Tua / Wali</h1>
            <p class="text-muted">Cari orang tua untuk melihat dan mengelola data balita mereka.</p>
        @endif
    </div>

    @if(isset($parent))
        {{-- VIEW: MANAGE TODDLERS FOR SPECIFIC PARENT --}}
        
        <!-- Parent Details Card -->
        <div class="card info-card parent-info-card shadow-sm p-4 mb-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-user-tag me-2"></i>Profil Orang Tua</h5>
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <span class="text-muted d-block small">Nama Lengkap</span>
                            <span class="fw-semibold text-dark">{{ $parent->user->name }}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="text-muted d-block small">Email</span>
                            <span class="fw-semibold text-dark text-break">{{ $parent->user->email }}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="text-muted d-block small">Nomor HP / WhatsApp</span>
                            <span class="fw-semibold text-dark">{{ $parent->no_hp ?? '-' }}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="text-muted d-block small">Alamat</span>
                            <span class="fw-semibold text-dark">{{ $parent->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                @can('view-any-balita')
                <div class="w-100 w-sm-auto text-sm-end mt-2 mt-sm-0">
                    <a href="{{ route('balita.index') }}" class="btn btn-outline-secondary px-4 w-100 w-sm-auto">
                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                @endcan
            </div>
        </div>

        <!-- Toddlers List Card -->
        <div class="card info-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-children me-2 text-success"></i>Daftar Anak / Balita</h5>
                @can('create-balita')
                    <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#tambahBalitaModal">
                        <i class="fa-solid fa-plus me-2"></i>Tambah Balita
                    </button>
                @endcan
            </div>

            @if($parent->balita->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-baby-carriage text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="text-muted mb-0">Belum ada data balita terdaftar untuk orang tua ini.</p>
                </div>
            @else
                <!-- Desktop Table View (md screen and up) -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover align-middle custom-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Balita</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Umur (Bulan)</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parent->balita as $index => $b)
                                @php
                                    $birthDate = \Carbon\Carbon::parse($b->tanggal_lahir);
                                    $ageInMonths = number_format($birthDate->diffInDays(\Carbon\Carbon::now()) / 30.44, 1);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold text-dark">{{ $b->nama_balita }}</td>
                                    <td>
                                        @if($b->jenis_kelamin === 'L')
                                            <span class="gender-badge gender-l"><i class="fa-solid fa-mars me-1"></i>Laki-laki</span>
                                        @else
                                            <span class="gender-badge gender-p"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>
                                        @endif
                                    </td>
                                    <td>{{ $birthDate->translatedFormat('d F Y') }}</td>
                                    <td><span class="badge bg-success py-2 px-3 rounded-pill">{{ $ageInMonths }} Bulan</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('analisis-fuzzy.create', ['balita_id' => $b->id_balita]) }}" class="btn-action btn-action-analisis" title="Analisis Gizi">
                                                <i class="fa-solid fa-calculator"></i>
                                            </a>
                                            @canany(['update-any-balita', 'update-own-balita'])
                                                <button class="btn-action btn-action-edit" data-bs-toggle="modal" data-bs-target="#editBalitaModal{{ $b->id_balita }}" title="Edit Balita">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            @endcanany
                                            @can('delete-balita')
                                                <button class="btn-action btn-action-delete btn-delete" data-id="{{ $b->id_balita }}" title="Hapus Balita">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $b->id_balita }}" action="{{ route('balita.destroy', $b->id_balita) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                @if(auth()->user()->hasRole('tenaga-kesehatan'))
                                                    <span class="text-muted small" data-bs-toggle="tooltip" title="Hanya Admin yang dapat menghapus data balita.">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </span>
                                                @endif
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (less than md screen) -->
                <div class="d-block d-md-none">
                    @foreach($parent->balita as $index => $b)
                        @php
                            $birthDate = \Carbon\Carbon::parse($b->tanggal_lahir);
                            $ageInMonths = number_format($birthDate->diffInDays(\Carbon\Carbon::now()) / 30.44, 1);
                        @endphp
                        <div class="mobile-card p-3 mb-3 bg-white shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-dark mb-0">{{ $b->nama_balita }}</h6>
                                <span class="badge bg-success rounded-pill px-2.5 py-1.5">{{ $ageInMonths }} Bulan</span>
                            </div>
                            <div class="mb-2">
                                @if($b->jenis_kelamin === 'L')
                                    <span class="gender-badge gender-l d-inline-block"><i class="fa-solid fa-mars me-1"></i>Laki-laki</span>
                                @else
                                    <span class="gender-badge gender-p d-inline-block"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>
                                @endif
                            </div>
                            <div class="small text-muted mb-3">
                                <i class="fa-solid fa-cake-candles me-2 text-success"></i>{{ $birthDate->translatedFormat('d F Y') }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('analisis-fuzzy.create', ['balita_id' => $b->id_balita]) }}" class="btn btn-success btn-sm flex-grow-1 py-2 rounded-3 fw-semibold text-white">
                                    <i class="fa-solid fa-calculator me-1"></i> Analisis
                                </a>
                                @canany(['update-any-balita', 'update-own-balita'])
                                    <button class="btn btn-warning btn-sm flex-grow-1 py-2 rounded-3 text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#editBalitaModal{{ $b->id_balita }}">
                                        <i class="fa-solid fa-pen me-1"></i> Edit
                                    </button>
                                @endcanany
                                @can('delete-balita')
                                    <button class="btn btn-danger btn-sm flex-grow-1 py-2 rounded-3 btn-delete fw-semibold" data-id="{{ $b->id_balita }}">
                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $b->id_balita }}" action="{{ route('balita.destroy', $b->id_balita) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @else
                                    @if(auth()->user()->hasRole('tenaga-kesehatan'))
                                        <button class="btn btn-secondary btn-sm flex-grow-1 py-2 rounded-3" disabled title="Hanya Admin yang dapat menghapus data balita.">
                                            <i class="fa-solid fa-lock me-1"></i> Hapus
                                        </button>
                                    @endif
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Tambah Balita Modal -->
        @can('create-balita')
            <div class="modal fade" id="tambahBalitaModal" tabindex="-1" aria-labelledby="tambahBalitaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-success text-white border-0 py-3">
                            <h5 class="modal-title fw-bold" id="tambahBalitaModalLabel"><i class="fa-solid fa-baby me-2"></i>Tambah Balita Baru</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('balita.store') }}">
                            @csrf
                            <input type="hidden" name="id_orang_tua" value="{{ $parent->id }}">
                            <div class="modal-body p-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark">Nama Balita</label>
                                    <input type="text" name="nama_balita" class="form-control @error('nama_balita') is-invalid @enderror" placeholder="Masukkan nama balita" required value="{{ old('nama_balita') }}">
                                    @error('nama_balita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" max="{{ date('Y-m-d') }}" class="form-control @error('tanggal_lahir') is-invalid @enderror" required value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer border-0 p-4 pt-0">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success px-4">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <!-- Edit Balita Modals -->
        @canany(['update-any-balita', 'update-own-balita'])
            @foreach($parent->balita as $b)
                <div class="modal fade" id="editBalitaModal{{ $b->id_balita }}" tabindex="-1" aria-labelledby="editBalitaModalLabel{{ $b->id_balita }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header bg-warning text-dark border-0 py-3">
                                <h5 class="modal-title fw-bold" id="editBalitaModalLabel{{ $b->id_balita }}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Data Balita</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('balita.update', $b->id_balita) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">Nama Balita</label>
                                        <input type="text" name="nama_balita" class="form-control" placeholder="Masukkan nama balita" required value="{{ old('nama_balita', $b->nama_balita) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select" required>
                                            <option value="L" {{ old('jenis_kelamin', $b->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $b->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" max="{{ date('Y-m-d') }}" class="form-control" required value="{{ old('tanggal_lahir', $b->tanggal_lahir) }}">
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-4 pt-0">
                                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning px-4">Perbarui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endcanany

    @else
        {{-- VIEW: LIST PARENTS --}}
        
        <!-- Search and Filter Form -->
        <div class="card info-card shadow-sm p-4 mb-4">
            <form action="{{ route('balita.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-9 col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari orang tua berdasarkan nama, email, no hp, atau alamat..." value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 d-grid">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1"><i class="fa-solid fa-filter me-2"></i>Cari</button>
                        @if(!empty($search))
                            <a href="{{ route('balita.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left"></i></a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Parents List Card -->
        <div class="card info-card shadow-sm p-4">
            @if($parents->isEmpty())
                <div class="text-center py-5">
                    <i class="fa-solid fa-users-slash text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="text-muted mb-0">Tidak ditemukan data orang tua/wali yang cocok.</p>
                </div>
            @else
                <!-- Desktop Table View (md screen and up) -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover align-middle custom-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Orang Tua / Wali</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Jumlah Balita</th>
                                <th style="width: 180px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parents as $index => $p)
                                <tr>
                                    <td>{{ $parents->firstItem() + $index }}</td>
                                    <td class="fw-semibold text-dark">{{ $p->user->name }}</td>
                                    <td>
                                        <div class="small"><i class="fa-regular fa-envelope me-2 text-success"></i>{{ $p->user->email }}</div>
                                        <div class="small mt-1 text-muted"><i class="fa-solid fa-phone me-2 text-success"></i>{{ $p->no_hp ?? '-' }}</div>
                                    </td>
                                    <td><span class="text-truncate d-inline-block" style="max-width: 250px;" title="{{ $p->alamat }}">{{ $p->alamat ?? '-' }}</span></td>
                                    <td>
                                        <span class="badge bg-success py-2 px-3 rounded-pill">
                                            <i class="fa-solid fa-child me-1"></i> {{ $p->balita->count() }} Balita
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('balita.index', ['parent_id' => $p->id]) }}" class="btn btn-success btn-sm px-3 py-2">
                                            <i class="fa-regular fa-folder-open me-2"></i>Kelola Balita
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (less than md screen) -->
                <div class="d-block d-md-none">
                    @foreach($parents as $index => $p)
                        <div class="mobile-card p-3 mb-3 bg-white shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-dark mb-0">{{ $p->user->name }}</h6>
                                <span class="badge bg-success rounded-pill px-2.5 py-1.5">
                                    <i class="fa-solid fa-child me-1"></i> {{ $p->balita->count() }}
                                </span>
                            </div>
                            <div class="small text-muted mb-2">
                                <div><i class="fa-regular fa-envelope me-2 text-success mb-1"></i><span class="text-break">{{ $p->user->email }}</span></div>
                                <div class="mt-1"><i class="fa-solid fa-phone me-2 text-success"></i>{{ $p->no_hp ?? '-' }}</div>
                            </div>
                            <div class="small text-muted mb-3 text-truncate">
                                <i class="fa-solid fa-location-dot me-2 text-success"></i>{{ $p->alamat ?? '-' }}
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('balita.index', ['parent_id' => $p->id]) }}" class="btn btn-success py-2 rounded-3 btn-sm fw-semibold">
                                    <i class="fa-regular fa-folder-open me-2"></i>Kelola Balita
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Section -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $parents->appends(['search' => $search ?? ''])->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    @endif

</section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        // Handle SweetAlert2 Notifications
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        // Trigger Validation Modal Errors Auto-Show if validation fails on store/update
        @if($errors->any() && isset($parent))
            var myModal = new bootstrap.Modal(document.getElementById('tambahBalitaModal'), {});
            myModal.show();
        @endif

        // Handle Delete Confirmation
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data balita akan dihapus secara permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-trash me-2"></i>Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit();
                }
            });
        });
    });
</script>
@endpush
