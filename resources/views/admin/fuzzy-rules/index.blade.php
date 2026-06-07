@extends('layouts.app-breeze')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6 text-gray-800 dark:text-gray-200 text-sm font-medium">
            <i class="fas fa-home mr-1"></i> Dashboard / <span class="text-indigo-600 dark:text-indigo-400">Rules Fuzzy (Mamdani)</span>
        </div>

        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-900/70 flex items-center justify-center text-indigo-700 dark:text-indigo-300">
                    <i class="fas fa-robot text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Basis Aturan Fuzzy – Metode Mamdani</h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Variabel input: <strong>Umur (fase)</strong>, <strong>Berat</strong>, <strong>Tinggi</strong>, <strong>Imunisasi</strong>.
                        Total <strong class="text-indigo-700 dark:text-indigo-300">{{ $rules_fuzzy->total() }} aturan</strong> untuk menentukan status gizi dan rekomendasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tabel Rules -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                <h4 class="font-bold text-gray-900 dark:text-white">📋 Daftar Aturan (Rule Base) – {{ $rules_fuzzy->total() }} Aturan</h4>
                <span class="text-xs bg-indigo-100 dark:bg-indigo-900/70 text-indigo-800 dark:text-indigo-200 px-3 py-1 rounded-full font-semibold">{{ $rules_fuzzy->total() }} Aturan</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-indigo-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-indigo-800 dark:text-indigo-300">No</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-indigo-800 dark:text-indigo-300">IF (Premis)</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-indigo-800 dark:text-indigo-300">THEN (Kesimpulan)</th>
                         </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-900">
                        @foreach($rules_fuzzy as $rule)
                            @php
                                $status = $rule->hasil_status_gizi;
                                $colorClass = 'text-gray-700 dark:text-gray-300';
                                if ($status == 'Gizi Buruk') {
                                    $colorClass = 'text-red-700 dark:text-red-400';
                                } elseif ($status == 'Gizi Kurang') {
                                    $colorClass = 'text-orange-700 dark:text-orange-400';
                                } elseif ($status == 'Normal') {
                                    $colorClass = 'text-green-700 dark:text-green-400';
                                } elseif ($status == 'Gizi Lebih') {
                                    $colorClass = 'text-blue-700 dark:text-blue-400';
                                } elseif ($status == 'Obesitas') {
                                    $colorClass = 'text-red-800 dark:text-red-300';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">{{ $rule->id_rule }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">
                                    Umur = {{ str_replace('_', ' ', $rule->fase_umur) }} AND Berat = {{ str_replace('_', ' ', $rule->kategori_berat) }} AND Tinggi = {{ str_replace('_', ' ', $rule->kategori_tinggi) }} AND Imunisasi = {{ str_replace('_', ' ', $rule->kategori_imunisasi) }}
                                </td>
                                <td class="px-4 py-2 {{ $colorClass }} font-semibold">{{ $status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                {{ $rules_fuzzy->links() }}
            </div>
        </div>

        <!-- Keterangan Variabel -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Fase Umur</div><ul class="text-sm text-gray-700 dark:text-gray-300 mt-1"><li>Fase 1: 0-6 bulan</li><li>Fase 2: 7-12 bulan</li><li>Fase 3: 13-24 bulan</li><li>Fase 4: 25-36 bulan</li><li>Fase 5: 37-60 bulan</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Berat</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Ringan</li><li>Sedang</li><li>Berat</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Tinggi</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Pendek</li><li>Agak Panjang</li><li>Panjang</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Imunisasi</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Tidak Lengkap</li><li>Sebagian</li><li>Lengkap</li></ul></div>
        </div>

        <div class="mt-8 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl p-5 border border-indigo-200 dark:border-indigo-800">
            <div class="flex gap-3">
                <i class="fas fa-lightbulb text-indigo-600 dark:text-indigo-400 text-xl"></i>
                <div class="text-sm text-gray-800 dark:text-gray-200">
                    <strong>Metode Mamdani:</strong> Aturan di atas menggunakan inferensi MIN-MAX dan defuzzifikasi centroid. Cocok untuk sistem penilaian gizi balita.
                    <br>
                    <span class="mt-1 block text-xs text-indigo-600 dark:text-indigo-400">
                        * Kombinasi total diperoleh dari: 5 Fase Umur &times; 3 Kategori Berat &times; 3 Kategori Tinggi &times; 3 Kategori Imunisasi = 135 total aturan keputusan.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection