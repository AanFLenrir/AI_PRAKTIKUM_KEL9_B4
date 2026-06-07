@extends('layouts.app-user')

@section('title', 'Lakukan Analisis Gizi - SIFUZI Balita')

@push('page-style')
    <style>
        .analisis-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

{{-- MAIN CONTENT SECTION --}}
@section('content')

    <section class="container py-4">

        {{-- BREADCRUMB / HERO BADGE --}}
        <div class="mb-4">
            <span class="hero-badge">LAKUKAN ANALISIS</span>
            <h1 class="fw-bold mt-2">Formulir Analisis Gizi</h1>
            <p class="text-muted">Pilih balita, lalu masukkan data fisik dan imunisasi untuk menghitung klasifikasi antropometri Z-Score dan logika fuzzy Mamdani.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="analisis-card card p-4">

                    <div class="text-center mb-4">
                        <i class="fa-solid fa-calculator text-success" style="font-size: 3rem;"></i>
                        <h3 class="fw-bold mt-3">Hitung Status Gizi</h3>
                        <p class="text-muted">Pilih balita terlebih dahulu untuk memuat data profilnya</p>
                    </div>

                    <form id="fuzzyForm" method="POST" action="/api/calculate-all">
                        @csrf

                        <!-- Pilih Orang Tua (Nakes Only) -->
                        @if(auth()->user()->can('view-any-balita'))
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="id_orang_tua">Pilih Orang Tua</label>
                                <select id="id_orang_tua" name="id_orang_tua" class="block mt-1 w-full" required>
                                    <option value="" disabled selected>Pilih Orang Tua...</option>
                                    @foreach($orangTuaList as $ot)
                                        <option value="{{ $ot->id }}">{{ $ot->user->name }} ({{ $ot->no_hp ?? '-' }})</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_orang_tua')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Pilih Balita -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="id_balita">Pilih Balita</label>
                            <select id="id_balita" name="id_balita" class="block mt-1 w-full" required @if(auth()->user()->can('view-any-balita')) disabled @endif>
                                @if(auth()->user()->can('view-any-balita'))
                                    <option value="" disabled selected>Pilih Orang Tua Terlebih Dahulu...</option>
                                @else
                                    <option value="" disabled selected>Pilih Balita...</option>
                                    @foreach($balitaList as $b)
                                        <option value="{{ $b->id_balita }}">{{ $b->nama_balita }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('id_balita')" class="mt-2" />
                        </div>

                        <!-- Balita Info Card (AJAX) -->
                        <div id="balita_info_card" class="card p-3 mb-4 bg-light border-0 d-none">
                            <h6 class="fw-bold text-success mb-2.5"><i class="fa-solid fa-circle-info me-2"></i>Informasi Balita</h6>
                            <div class="row g-2 text-dark small">
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 0.75rem;">Nama Balita</span>
                                    <span id="info_nama" class="fw-semibold">-</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 0.75rem;">Jenis Kelamin</span>
                                    <span id="info_jk" class="fw-semibold">-</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 0.75rem;">Tanggal Lahir</span>
                                    <span id="info_tgl_lahir" class="fw-semibold">-</span>
                                </div>
                                <div class="col-md-6 col-12">
                                    <span class="text-muted d-block" style="font-size: 0.75rem;">Umur (Bulan)</span>
                                    <span id="info_umur" class="fw-semibold text-success">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Berat Badan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="berat_badan">Berat Badan (kg)</label>
                            <x-text-input id="berat_badan" class="form-control block mt-1 w-full" type="number" step="0.01" name="berat_badan"
                                :value="old('berat_badan')" min="0.1" required placeholder="Contoh: 9.0" />
                            <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="tinggi_badan">Tinggi Badan (cm)</label>
                            <x-text-input id="tinggi_badan" class="form-control block mt-1 w-full" type="number" step="0.1" name="tinggi_badan"
                                :value="old('tinggi_badan')" min="1" required placeholder="Contoh: 65.0" />
                            <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />
                        </div>

                        <!-- Daftar Imunisasi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="daftar_imunisasi">Daftar Imunisasi yang Diterima</label>
                            <select id="daftar_imunisasi" name="daftar_imunisasi[]" class="block mt-1 w-full" multiple required>
                                @foreach($imunisasiList as $imun)
                                    <option value="{{ $imun->nama_imunisasi }}">{{ $imun->nama_imunisasi }} (Usia: {{ $imun->umur_bulan }} Bln)</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('daftar_imunisasi')" class="mt-2" />
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-success flex-grow-1 py-2.5 fw-semibold rounded-3">
                                MULAI ANALISIS
                            </button>

                            {{-- PLEASE DON'T REMOVE THIS RESET BUTTON --}}
                            {{-- JUST ADD CLASS .hidden TO NOT DISPLAY THIS BUTTON --}}
                            {{-- NEEDED TO SCRIPT WORK --}}
                            <button type="reset" class="btn btn-outline-secondary px-4 py-2.5 rounded-3">
                                RESET
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </section>

@endsection

{{-- CDNs --}}
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{-- JQUERY --}}
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

                // Reset error highlights
                form.find("input, select").removeClass('is-invalid');
                form.find(".error").remove();

                const inputs = form.find("input")
                const selects = form.find("select")

                inputs.each(function () {
                    if (this.validity.valueMissing) {
                        isValid = false
                        this.classList.add('is-invalid')
                        const requiredErrSPAN = $('<span>', {
                            class: "error text-danger small d-block mt-1",
                            text: "Kolom ini wajib diisi"
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
                    if (this.validity.valueMissing || (this.hasAttribute('multiple') && (!$(this).val() || $(this).val().length === 0))) {
                        isValid = false
                        this.classList.add('is-invalid')
                        this.classList.add('form-select-invalid')

                        if (!$(this).next().hasClass("error")) {
                            let msg = "Wajib memilih opsi";
                            if (this.hasAttribute('multiple')) {
                                msg = "Wajib memilih minimal satu imunisasi";
                            } else if (this.id === 'id_balita') {
                                msg = "Silakan pilih balita terlebih dahulu";
                            }
                            const requiredErrSPAN = $('<span>', {
                                class: "error text-danger small d-block mt-1",
                                text: msg
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

                    // Kirim form via AJAX
                    submitFormViaAjax();
                }
            })

            // AJAX Listener for Balita selection change
            $('#id_balita').change(function() {
                const id = $(this).val();
                if (!id) {
                    $('#balita_info_card').addClass('d-none');
                    return;
                }

                // Show loading state
                $('#balita_info_card').removeClass('d-none');
                $('#info_nama').html('<span class="spinner-border spinner-border-sm text-success"></span>');
                $('#info_jk').text('-');
                $('#info_tgl_lahir').text('-');
                $('#info_umur').text('-');

                $.ajax({
                    url: `/analisis-gizi/balita/${id}`,
                    type: 'GET',
                    success: function(data) {
                        $('#info_nama').text(data.nama_balita);
                        $('#info_jk').text(data.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
                        $('#info_tgl_lahir').text(data.tanggal_lahir);
                        $('#info_umur').text(data.umur_bulan + ' Bulan');

                        // Save details to info-card data attributes
                        $('#balita_info_card').data('jenis_kelamin', data.jenis_kelamin);
                        $('#balita_info_card').data('umur_bulan', data.umur_bulan);
                        $('#balita_info_card').data('nama_balita', data.nama_balita);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data balita.'
                        });
                        $('#balita_info_card').addClass('d-none');
                    }
                });
            });
        });

        function submitFormViaAjax() {
            const jenisKelamin = $('#balita_info_card').data('jenis_kelamin');
            const umurBulan = $('#balita_info_card').data('umur_bulan');
            const namaBalita = $('#balita_info_card').data('nama_balita');

            if (!jenisKelamin || umurBulan === undefined) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Balita',
                    text: 'Silakan pilih balita terlebih dahulu.'
                });
                return;
            }

            const formData = {
                id_balita: $('#id_balita').val(),
                nama_balita: namaBalita,
                jenis_kelamin: jenisKelamin,
                umur_bulan: Math.round(parseFloat(umurBulan)),
                berat_badan: parseFloat($('#berat_badan').val()),
                tinggi_badan: parseFloat($('#tinggi_badan').val()),
                daftar_imunisasi: $('#daftar_imunisasi').val() || []
            };

            $.ajax({
                url: '/api/calculate-all',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Simpan respon dan data input secara lokal di browser sessionStorage
                    sessionStorage.setItem('fuzzy_result', JSON.stringify(response));
                    sessionStorage.setItem('fuzzy_input', JSON.stringify(formData));
                    
                    // Arahkan ke halaman hasil
                    window.location.href = "{{ route('analisis-fuzzy.hasil') }}";
                },
                error: function (xhr) {
                    // Kembalikan form ke semula jika error
                    $("main form input, main form select").prop('readonly', false);
                    $("main form button[type='submit'], main form button[type='reset']").prop('disabled', false);

                    const submitBtn = $("button[type='submit']");
                    submitBtn.removeClass('btn-secondary').addClass('btn-success').html('MULAI ANALISIS');

                    let errMsg = 'Terjadi kesalahan saat melakukan perhitungan di server.';
                    console.log(xhr)
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errMsg = xhr.responseJSON.error;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Kalkulasi Gagal',
                        text: errMsg
                    });
                }
            });
        }
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
        
        if (resetBtn) {
            resetBtn.addEventListener('click', (e) => {
                resetInputStar()
                inputs.forEach((input) => {
                    input.classList.remove('is-invalid')
                })
                selects.forEach((select) => {
                    select.classList.remove('is-invalid')
                    select.classList.remove('form-select-invalid')
                })
                inputGroups.forEach((inputGroup) => {
                    inputGroup.classList.remove('outline-red')
                })
                document.querySelectorAll('.error').forEach((e) => e.remove())
                
                // Reset card info
                $('#balita_info_card').addClass('d-none').data('jenis_kelamin', '').data('umur_bulan', '').data('nama_balita', '');
                
                // Clear stored input in session storage when reset
                sessionStorage.removeItem('fuzzy_input');
                
                if (window.slimSelectInstance) {
                    window.slimSelectInstance.setSelected([]);
                }
                if (window.slimSelectOrangTua) {
                    window.slimSelectOrangTua.setSelected('');
                }
                if (window.slimSelectBalita) {
                    window.slimSelectBalita.setSelected('');
                    @if(auth()->user()->can('view-any-balita'))
                        window.slimSelectBalita.setData([
                            { text: 'Pilih Orang Tua Terlebih Dahulu...', value: '', placeholder: true }
                        ]);
                        window.slimSelectBalita.disable();
                    @endif
                }
            })
        }

        inputs.forEach((input) => {
            input.addEventListener('input', function () {
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

{{-- CUSTOM SCRIPT PAGE --}}
@push('script')
    <script>
        $(document).ready(function () {
            // Grouped balitas by parent
            const balitaByParent = @json($balitaGroupByParent ?? []);

            // Inisialisasi SlimSelect pada ID select terkait
            window.slimSelectBalita = new SlimSelect({
                select: '#id_balita',
                settings: {
                    placeholderText: 'Pilih Balita...',
                    allowDeselect: true
                }
            });

            window.slimSelectInstance = new SlimSelect({
                select: '#daftar_imunisasi',
                settings: {
                    placeholderText: 'Pilih Imunisasi...',
                    allowDeselect: true
                }
            });

            @if(auth()->user()->can('view-any-balita'))
                window.slimSelectOrangTua = new SlimSelect({
                    select: '#id_orang_tua',
                    settings: {
                        placeholderText: 'Pilih Orang Tua...',
                        allowDeselect: true
                    }
                });

                // Listener untuk filter Balita berdasarkan Orang Tua
                $('#id_orang_tua').change(function() {
                    const parentId = $(this).val();
                    
                    // Reset Balita select
                    if (window.slimSelectBalita) {
                        window.slimSelectBalita.setSelected('');
                    }
                    $('#id_balita').val('').trigger('change');

                    if (!parentId) {
                        if (window.slimSelectBalita) {
                            window.slimSelectBalita.setData([
                                { text: 'Pilih Orang Tua Terlebih Dahulu...', value: '', placeholder: true }
                            ]);
                            window.slimSelectBalita.disable();
                        }
                    } else {
                        const balitas = balitaByParent[parentId] || [];
                        const options = [
                            { text: 'Pilih Balita...', value: '', placeholder: true }
                        ];
                        balitas.forEach(b => {
                            options.push({ text: b.nama_balita, value: b.id_balita });
                        });

                        if (window.slimSelectBalita) {
                            window.slimSelectBalita.enable();
                            window.slimSelectBalita.setData(options);
                        }
                    }
                });
            @endif

            // Check preselectedId from query param
            const preselectedId = @json($preselectedBalitaId ?? null);

            // Pre-fill form if there is stored fuzzy_input (e.g. from "edit input" button) or query param
            const storedInput = sessionStorage.getItem('fuzzy_input');
            let initialBalitaId = null;
            let initialData = null;

            if (storedInput) {
                initialData = JSON.parse(storedInput);
                initialBalitaId = initialData.id_balita;
            } else if (preselectedId) {
                initialBalitaId = preselectedId;
            }

            if (initialBalitaId) {
                @if(auth()->user()->can('view-any-balita'))
                    let foundParentId = null;
                    for (const parentId in balitaByParent) {
                        const found = balitaByParent[parentId].find(b => b.id_balita == initialBalitaId);
                        if (found) {
                            foundParentId = parentId;
                            break;
                        }
                    }
                    
                    if (foundParentId && window.slimSelectOrangTua) {
                        window.slimSelectOrangTua.setSelected(foundParentId);
                        $('#id_orang_tua').val(foundParentId).trigger('change');
                        
                        // Beri jeda kecil agar select balita merender data baru
                        setTimeout(() => {
                            if (window.slimSelectBalita) {
                                window.slimSelectBalita.setSelected(initialBalitaId);
                                $('#id_balita').val(initialBalitaId).trigger('change');
                            }
                        }, 100);
                    }
                @else
                    if (window.slimSelectBalita) {
                        window.slimSelectBalita.setSelected(initialBalitaId);
                        $('#id_balita').trigger('change');
                    }
                @endif
            }

            if (initialData) {
                if (initialData.berat_badan) $('#berat_badan').val(initialData.berat_badan).trigger('input');
                if (initialData.tinggi_badan) $('#tinggi_badan').val(initialData.tinggi_badan).trigger('input');
                
                if (initialData.daftar_imunisasi && window.slimSelectInstance) {
                    window.slimSelectInstance.setSelected(initialData.daftar_imunisasi);
                }
            }
        });
    </script>
@endpush