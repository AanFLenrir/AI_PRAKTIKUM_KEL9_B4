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
                        Total <strong class="text-indigo-700 dark:text-indigo-300">35 aturan</strong> untuk menentukan status gizi dan rekomendasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tabel 35 Rules -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                <h4 class="font-bold text-gray-900 dark:text-white">📋 Daftar Aturan (Rule Base) – 35 Aturan</h4>
                <span class="text-xs bg-indigo-100 dark:bg-indigo-900/70 text-indigo-800 dark:text-indigo-200 px-3 py-1 rounded-full font-semibold">35 Aturan</span>
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
                        <!-- FASE 1 (Rules 1-7) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">1</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">2</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">3</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">4</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Sedang AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">5</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">6</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">7</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 1 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>

                        <!-- FASE 2 (Rules 8-14) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">8</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">9</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">10</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Sedang AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">11</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Berat AND Tinggi = Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-blue-700 dark:text-blue-400 font-semibold">Gizi Lebih</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">12</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">13</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">14</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 2 AND Berat = Sedang AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>

                        <!-- FASE 3 (Rules 15-21) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">15</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">16</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">17</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">18</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Sedang AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">19</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Berat AND Tinggi = Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-blue-700 dark:text-blue-400 font-semibold">Gizi Lebih</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">20</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">21</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 3 AND Berat = Sedang AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>

                        <!-- FASE 4 (Rules 22-28) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">22</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">23</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">24</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">25</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Sedang AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">26</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Berat AND Tinggi = Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-blue-700 dark:text-blue-400 font-semibold">Gizi Lebih</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">27</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Ringan AND Tinggi = Agak Panjang AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">28</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 4 AND Berat = Sedang AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>

                        <!-- FASE 5 (Rules 29-35) -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">29</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Sedang AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">30</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Berat AND Tinggi = Agak Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-red-800 dark:text-red-300 font-semibold">Obesitas</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">31</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Berat AND Tinggi = Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-blue-700 dark:text-blue-400 font-semibold">Gizi Lebih</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">32</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Tidak Lengkap</td><td class="px-4 py-2 text-red-700 dark:text-red-400 font-semibold">Gizi Buruk</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">33</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Sebagian</td><td class="px-4 py-2 text-orange-700 dark:text-orange-400 font-semibold">Gizi Kurang</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">34</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Ringan AND Tinggi = Rendah AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"><td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">35</td><td class="px-4 py-2 text-gray-800 dark:text-gray-200">Umur = Fase 5 AND Berat = Sedang AND Tinggi = Panjang AND Imunisasi = Lengkap</td><td class="px-4 py-2 text-green-700 dark:text-green-400 font-semibold">Normal</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Keterangan Variabel -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Fase Umur</div><ul class="text-sm text-gray-700 dark:text-gray-300 mt-1"><li>Fase 1: 0-6 bulan</li><li>Fase 2: 7-12 bulan</li><li>Fase 3: 13-24 bulan</li><li>Fase 4: 25-36 bulan</li><li>Fase 5: 37-60 bulan</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Berat</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Ringan</li><li>Sedang</li><li>Berat</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Tinggi</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Rendah</li><li>Agak Panjang</li><li>Panjang</li></ul></div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-gray-200 dark:border-gray-700"><div class="font-bold text-indigo-700 dark:text-indigo-300">Imunisasi</div><ul class="text-sm text-gray-700 dark:text-gray-300"><li>Tidak Lengkap</li><li>Sebagian</li><li>Lengkap</li></ul></div>
        </div>

        <div class="mt-8 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl p-5 border border-indigo-200 dark:border-indigo-800">
            <div class="flex gap-3"><i class="fas fa-lightbulb text-indigo-600 dark:text-indigo-400 text-xl"></i><div class="text-sm text-gray-800 dark:text-gray-200"><strong>Metode Mamdani:</strong> Aturan di atas menggunakan inferensi MIN-MAX dan defuzzifikasi centroid. Cocok untuk sistem penilaian gizi balita.</div></div>
        </div>
    </div>
</div>
@endsection