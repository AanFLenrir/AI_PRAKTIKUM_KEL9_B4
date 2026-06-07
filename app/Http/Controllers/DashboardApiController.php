<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Balita;
use App\Models\Pemeriksaan;
use App\Models\OrangTua;

class DashboardApiController extends Controller
{
    public function getStats()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Ubah sesuai kebutuhan role testing
        $isNakes = $user->hasRole('tenaga-kesehatan');

        // 1. Inisialisasi Subquery terlebih dahulu
        $latestPemeriksaansSubquery = DB::table('pemeriksaan')
            ->selectRaw('MAX(id_pemeriksaan) as id_pemeriksaan')
            ->groupBy('id_balita');

        // 2. Modifikasi Subquery SEBELUM dipakai di query lain
        if (!$isNakes) {
            $latestPemeriksaansSubquery->whereIn('id_balita', function ($query) use ($user) {
                $query->select('id_balita')
                    ->from('balita')
                    ->where('id_orang_tua', $user->id);
            });
        }

        // 3. SEKARANG baru masukkan subquery yang sudah matang ke query utama
        $distributionQuery = Pemeriksaan::select('id_status_gizi', DB::raw('count(*) as count'))
            ->whereIn('id_pemeriksaan', $latestPemeriksaansSubquery);

        // 4. Eksekusi data distribusi
        $distributionData = $distributionQuery->groupBy('id_status_gizi')
            ->pluck('count', 'id_status_gizi')
            ->toArray();

        $statusMap = [
            1 => 'Gizi Buruk',
            2 => 'Gizi Kurang',
            3 => 'Normal',
            4 => 'Gizi Lebih',
            5 => 'Obesitas'
        ];

        $statusDistribution = [];
        foreach ($statusMap as $id => $name) {
            $statusDistribution[$name] = $distributionData[$id] ?? 0;
        }

        // 5. Response berdasarkan Role
        if ($isNakes) {
            $totalBalita = Balita::count();
            $totalPemeriksaan = Pemeriksaan::count();
            $totalOrtu = OrangTua::count();

            return response()->json([
                'total_balita' => $totalBalita,
                'total_pemeriksaan' => $totalPemeriksaan,
                'total_ortu' => $totalOrtu,
                'status_distribution' => $statusDistribution
            ]);
        } else {
            $totalBalita = Balita::where('id_orang_tua', $user->id)->count();

            // Memanfaatkan data $latestPemeriksaansSubquery yang sudah disaring di atas
            $totalPemeriksaan = DB::table('pemeriksaan')
                ->whereIn('id_pemeriksaan', $latestPemeriksaansSubquery)
                ->count();

            return response()->json([
                'total_balita' => $totalBalita,
                'total_pemeriksaan' => $totalPemeriksaan,
                'status_distribution' => $statusDistribution
            ]);
        }
    }
}
