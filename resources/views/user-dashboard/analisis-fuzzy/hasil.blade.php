@extends('layouts.app-user')

@section('title', 'Hasil Analisis Gizi - SIFUZI Balita')

@push('page-style')
<style>
    .result-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        display: block;
        margin-bottom: 2px;
    }
    .info-value {
        font-weight: 600;
        color: #212529;
    }
    .zscore-badge {
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        display: inline-block;
    }
    .z-normal {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    .z-warning {
        background-color: #fffde7;
        color: #f57f17;
    }
    .z-danger {
        background-color: #ffebee;
        color: #c62828;
    }
    .z-info {
        background-color: #e3f2fd;
        color: #0d47a1;
    }
    .z-muted {
        background-color: #f5f5f5;
        color: #616161;
    }
    .rule-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .rule-card {
        border-left: 4px solid var(--color-primary);
        background-color: #fcfdfc;
    }
</style>
@endpush

@section('content')
<section class="container py-4">

    {{-- BREADCRUMB / HERO BADGE --}}
    <div class="mb-4">
        <span class="hero-badge">HASIL ANALISIS</span>
        <h1 class="fw-bold mt-2">Hasil Evaluasi Sementara</h1>
        <p class="text-muted">Hasil perhitungan status antropometri dan logika fuzzy Mamdani (data belum disimpan ke sistem).</p>
    </div>

    <div class="row g-4">
        {{-- LEFT COLUMN: Input Parameters --}}
        <div class="col-lg-5 col-md-12">
            <!-- Data Input Card -->
            <div class="card result-card p-4 mb-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-file-invoice me-2"></i>Parameter Input</h5>
                <hr class="mt-0 mb-3 text-muted">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="info-label">Nama Balita</span>
                        <span id="input_nama_balita" class="info-value text-dark fw-bold">-</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Jenis Kelamin</span>
                        <span id="input_jenis_kelamin" class="info-value">-</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Umur</span>
                        <span id="input_umur" class="info-value">-</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Berat Badan</span>
                        <span id="input_berat" class="info-value">-</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <span class="info-label">Tinggi Badan</span>
                        <span id="input_tinggi" class="info-value">-</span>
                    </div>
                </div>

                <div class="mt-4">
                    <span class="info-label mb-2">Daftar Imunisasi yang Diterima</span>
                    <div id="input_imunisasi_container" class="d-flex flex-wrap gap-1.5">
                        <!-- Badges loaded dynamically -->
                    </div>
                </div>
            </div>

            <!-- Action Buttons Card -->
            <div class="card result-card p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-sliders me-2"></i>Pilihan Aksi</h5>
                <p class="small text-muted mb-4">Data di bawah ini merupakan simulasi kalkulasi. Anda dapat kembali mengedit input atau menyimpannya.</p>
                <div class="d-grid gap-2">
                    <button id="btn_simpan" class="btn btn-success py-2.5 fw-semibold rounded-3" type="button">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Simpan
                    </button>
                    <a href="{{ route('analisis-fuzzy.create') }}" class="btn btn-outline-secondary py-2.5 fw-semibold rounded-3">
                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Input
                    </a>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Z-Score & Fuzzy Results --}}
        <div class="col-lg-7 col-md-12">
            <!-- Antropometri (Z-Score) Card -->
            <div class="card result-card p-4 mb-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-calculator me-2"></i>Hasil Klasifikasi Antropometri (Z-Score)</h5>
                <hr class="mt-0 mb-3 text-muted">
                
                <div class="row g-3">
                    <div class="col-md-6 col-12">
                        <span class="info-label">Berat Badan menurut Umur (BB/U)</span>
                        <span id="zscore_bbu" class="zscore-badge w-100 text-center z-muted">
                            Data SD tidak tersedia
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Panjang/Tinggi Badan menurut Umur (PB/U)</span>
                        <span id="zscore_pbu" class="zscore-badge w-100 text-center z-muted">
                            Data SD tidak tersedia
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Berat Badan menurut Panjang/Tinggi (BB/PB)</span>
                        <span id="zscore_bbpb" class="zscore-badge w-100 text-center z-muted">
                            Data SD tidak tersedia
                        </span>
                    </div>
                    <div class="col-md-6 col-12">
                        <span class="info-label">Indeks Massa Tubuh menurut Umur (IMT/U)</span>
                        <span id="zscore_imtu" class="zscore-badge w-100 text-center z-muted">
                            Data SD tidak tersedia
                        </span>
                    </div>
                    <div class="col-12 mt-3">
                        <span class="info-label">Nilai IMT</span>
                        <span id="zscore_imt" class="info-value fs-5 text-dark">-</span>
                    </div>
                </div>
            </div>

            <!-- Fuzzy Inference Card -->
            <div class="card result-card p-4">
                <h5 class="fw-bold text-success mb-3"><i class="fa-solid fa-gears me-2"></i>Hasil Perhitungan Logika Fuzzy (Mamdani)</h5>
                <hr class="mt-0 mb-3 text-muted">

                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-12">
                        <span class="info-label">Status Gizi Akhir (Fuzzy)</span>
                        <span id="fuzzy_status" class="zscore-badge fs-6 fw-bold w-100 text-center py-2.5 z-muted">
                            -
                        </span>
                    </div>
                    <div class="col-md-6 col-12 text-center text-md-start border-start-md ps-md-4">
                        <span class="info-label">Nilai Defuzzifikasi (Skor Gizi)</span>
                        <span id="fuzzy_skor" class="d-block fs-3 fw-bold text-dark">-</span>
                    </div>
                </div>

                <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-list-check me-2 text-success"></i>Aturan Fuzzy (Rule) yang Aktif</h6>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle rule-table mb-0 small">
                        <thead>
                            <tr>
                                <th>Kode/Aturan Aktif</th>
                                <th style="width: 100px;" class="text-center">α-Predikat</th>
                                <th style="width: 100px;" class="text-center">Defuzzy</th>
                            </tr>
                        </thead>
                        <tbody id="fuzzy_rules_body">
                            <!-- Rows loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        // Load data from sessionStorage
        const result = JSON.parse(sessionStorage.getItem('fuzzy_result'));
        const input = JSON.parse(sessionStorage.getItem('fuzzy_input'));

        if (!result || !input) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Kosong',
                text: 'Harap lakukan perhitungan dari form terlebih dahulu.',
                confirmButtonText: 'Kembali'
            }).then(() => {
                window.location.href = "{{ route('analisis-fuzzy.create') }}";
            });
            return;
        }

        // Helper function for Z-Score coloring
        function getZScoreBadgeClass(category) {
            if (!category || category === 'Data SD tidak tersedia') {
                return 'z-muted';
            }
            const cat = category.toLowerCase();
            if (cat.includes('normal') || cat.includes('tinggi')) {
                return 'z-normal';
            }
            if (cat.includes('sangat kurang') || cat.includes('sangat pendek') || cat.includes('buruk')) {
                return 'z-danger';
            }
            if (cat.includes('kurang') || cat.includes('pendek') || cat.includes('berisiko') || cat.includes('lebih') || cat.includes('obesitas')) {
                return 'z-warning';
            }
            return 'z-info';
        }

        // Helper function for Fuzzy Status coloring
        function getFuzzyStatusClass(status) {
            if (!status) return 'z-muted';
            if (status === 'Gizi Buruk') return 'z-danger';
            if (status === 'Gizi Kurang' || status === 'Gizi Lebih' || status === 'Obesitas') return 'z-warning';
            return 'z-normal';
        }

        // 1. Populate Input fields
        $('#input_nama_balita').text(input.nama_balita || '-');
        $('#input_jenis_kelamin').text(input.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        $('#input_umur').text(parseFloat(input.umur_bulan).toFixed(1) + ' Bulan');
        $('#input_berat').text(parseFloat(input.berat_badan).toFixed(2) + ' kg');
        $('#input_tinggi').text(parseFloat(input.tinggi_badan).toFixed(1) + ' cm');

        // Populate Immunizations
        const container = $('#input_imunisasi_container');
        container.empty();
        if (input.daftar_imunisasi && input.daftar_imunisasi.length > 0) {
            input.daftar_imunisasi.forEach(imun => {
                container.append(`<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-3 small me-1 mb-1"><i class="fa-solid fa-check me-1"></i>${imun}</span>`);
            });
        } else {
            container.append('<span class="text-muted small">Tidak ada imunisasi</span>');
        }

        // 2. Populate Z-Score fields
        const z = result.zscore;
        if (z) {
            $('#zscore_imt').text(z.imt ? parseFloat(z.imt).toFixed(2) : '-');
            
            $('#zscore_bbu').text(z.kategori_bbu || 'Data SD tidak tersedia')
                .removeClass().addClass('zscore-badge w-100 text-center ' + getZScoreBadgeClass(z.kategori_bbu));

            $('#zscore_pbu').text(z.kategori_pbu || 'Data SD tidak tersedia')
                .removeClass().addClass('zscore-badge w-100 text-center ' + getZScoreBadgeClass(z.kategori_pbu));

            $('#zscore_bbpb').text(z.kategori_bbpb || 'Data SD tidak tersedia')
                .removeClass().addClass('zscore-badge w-100 text-center ' + getZScoreBadgeClass(z.kategori_bbpb));

            $('#zscore_imtu').text(z.kategori_imtu || 'Data SD tidak tersedia')
                .removeClass().addClass('zscore-badge w-100 text-center ' + getZScoreBadgeClass(z.kategori_imtu));
        }

        // 3. Populate Fuzzy fields
        const f = result.fuzzy;
        if (f) {
            $('#fuzzy_status').text(f.kategori_status_gizi || '-')
                .removeClass().addClass('zscore-badge fs-6 fw-bold w-100 text-center py-2.5 ' + getFuzzyStatusClass(f.kategori_status_gizi));
            
            $('#fuzzy_skor').text(f.skor_gizi ? parseFloat(f.skor_gizi).toFixed(4) : '-');

            // Populate active rules
            const rulesBody = $('#fuzzy_rules_body');
            rulesBody.empty();
            if (f.detail_hasil && f.detail_hasil.length > 0) {
                f.detail_hasil.forEach(rule => {
                    rulesBody.append(`
                        <tr>
                            <td>
                                <div class="p-2 rule-card rounded-1">
                                    <code>${rule.rule_aktif}</code>
                                </div>
                            </td>
                            <td class="text-center fw-semibold text-dark">${parseFloat(rule.alpha_predikat).toFixed(4)}</td>
                            <td class="text-center fw-semibold text-dark">${parseFloat(rule.nilai_deffuzy).toFixed(2)}</td>
                        </tr>
                    `);
                });
            } else {
                rulesBody.append('<tr><td colspan="3" class="text-center text-muted py-3">Tidak ada rule aktif</td></tr>');
            }
        }

        // Handle Simpan Click
        $('#btn_simpan').click(function(e) {
            e.preventDefault();

            if (!result || !input) return;

            // Show confirmation dialog first
            Swal.fire({
                title: 'Simpan Hasil Pemeriksaan?',
                text: "Hasil pemeriksaan gizi balita ini akan disimpan ke database secara permanen.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-floppy-disk me-2"></i>Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((alertResult) => {
                if (alertResult.isConfirmed) {
                    // Disable button and show spinner
                    const btn = $('#btn_simpan');
                    btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');

                    // Prepare payload matching controller validation
                    const payload = {
                        id_balita: input.id_balita,
                        umur_bulan: parseFloat(input.umur_bulan),
                        berat_badan: parseFloat(input.berat_badan),
                        tinggi_badan: parseFloat(input.tinggi_badan),
                        imt: parseFloat(result.zscore.imt),
                        kategori_bbu: result.zscore.kategori_bbu,
                        kategori_pbu: result.zscore.kategori_pbu,
                        kategori_bbpb: result.zscore.kategori_bbpb,
                        kategori_imtu: result.zscore.kategori_imtu,
                        nilai_fuzzy: parseFloat(result.fuzzy.skor_gizi),
                        kategori_status_gizi: result.fuzzy.kategori_status_gizi,
                        detail_hasil: result.fuzzy.detail_hasil,
                        daftar_imunisasi: input.daftar_imunisasi
                    };

                    $.ajax({
                        url: "{{ route('analisis-fuzzy.store') }}",
                        type: 'POST',
                        data: JSON.stringify(payload),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            // Clear sessionStorage
                            sessionStorage.removeItem('fuzzy_result');
                            sessionStorage.removeItem('fuzzy_input');

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Disimpan!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "{{ route('analisis-fuzzy.index') }}";
                            });
                        },
                        error: function(xhr) {
                            btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk me-2"></i>Simpan');
                            let errorMsg = 'Gagal menyimpan hasil analisis.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMsg = xhr.responseJSON.error;
                            } else if (xhr.responseJSON && xhr.responseJSON.details) {
                                errorMsg = xhr.responseJSON.details;
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menyimpan',
                                text: errorMsg
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
