@extends('layouts.app-breeze')   {{-- atau sesuaikan dengan layout Anda --}}

@slot('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Master Data') }}
    </h2>
@endslot

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card User -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-2">Manajemen User</h3>
                        <p class="text-sm mb-4">Kelola data pengguna (admin, tenaga kesehatan, orang tua).</p>
                        <a href="{{ route('users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kelola User →</a>
                    </div>
                </div>

                <!-- Card Status Gizi -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-2">Status Gizi</h3>
                        <p class="text-sm mb-4">Kelola kategori status gizi (Buruk, Kurang, Baik, Lebih).</p>
                        <a href="{{ route('status-gizi.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Kelola Status Gizi →</a>
                    </div>
                </div>

                <!-- Card Imunisasi -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-2">Imunisasi</h3>
                        <p class="text-sm mb-4">Kelola data imunisasi (BCG, DPT, Polio, Campak).</p>
                        <a href="{{ route('imunisasi.index') }}" class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Kelola Imunisasi →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection