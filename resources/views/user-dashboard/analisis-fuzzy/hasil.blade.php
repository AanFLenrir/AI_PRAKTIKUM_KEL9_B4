@extends('layouts.app-user')

@section('title', 'TITLE PAGE - SIFUZI Balita')

@push('page-style')
<style>
    /* CUSTOM CSS FOR PAGE */
</style>
@endpush

@section('content')

<section class="container py-5">

    <div class="text-center mb-5">
        <span class="hero-badge">ANALISIS FUZZY</span>
        <h1 class="fw-bold">Calon Halaman Analisis Fuzzy</h1>
        <p class="text-muted">
            Ini Akan Menjadi Halaman Untuk Analisis Fuzzy
        </p>
    </div>

</section>

@endsection

{{-- CDNs --}}
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- SWEET ALERT --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{-- JQUERY --}}
@endpush

{{-- CDNs Style --}}
@push('page-style')

@endpush

{{-- SCRIPT PAGE --}}
@push('script')
<script>
    // When Document Loaded 
    $(document).ready(function () {

    })
</script>
@endpush
