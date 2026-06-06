<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\StatusGizi;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatistikController extends Controller
{
    public function index()
    {
        // ==================== PIE CHART ====================
        $pieLabels = [];
        $pieData = [];

        // Cek apakah tabel pemeriksaan dan balita ada
        if (Schema::hasTable('pemeriksaan') && Schema::hasTable('balita')) {
            // Ambil status gizi terakhir (pemeriksaan dengan id_pemeriksaan tertinggi) per balita
            $latestPemeriksaan = Pemeriksaan::select('id_balita', 'id_status_gizi')
                ->whereIn('id_pemeriksaan', function ($query) {
                    $query->select(DB::raw('MAX(id_pemeriksaan)'))
                        ->from('pemeriksaan')
                        ->groupBy('id_balita');
                })
                ->get();

            $statusCounts = [];
            $statuses = StatusGizi::all();
            foreach ($statuses as $status) {
                $statusCounts[$status->nama_status] = 0;
            }
            foreach ($latestPemeriksaan as $p) {
                $status = StatusGizi::find($p->id_status_gizi);
                if ($status) {
                    $statusCounts[$status->nama_status]++;
                }
            }
            $pieLabels = array_keys($statusCounts);
            $pieData = array_values($statusCounts);
        } else {
            // Data dummy agar chart tetap muncul
            $pieLabels = ['Gizi Buruk', 'Gizi Kurang', 'Normal', 'Gizi Lebih', 'Obesitas'];
            $pieData = [0, 0, 0, 0, 0];
        }

        // ==================== LINE CHART ====================
        $months = [];
        $counts = [];

        if (Schema::hasTable('balita') && Schema::hasColumn('balita', 'created_at')) {
            for ($i = 11; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $months[] = $month->format('M Y');
                $counts[] = Balita::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }
        } else {
            // Fallback: data kosong
            for ($i = 11; $i >= 0; $i--) {
                $months[] = now()->subMonths($i)->format('M Y');
                $counts[] = 0;
            }
        }

        $totalBalita = Balita::count();

        return view('admin.statistik.index', compact('pieLabels', 'pieData', 'months', 'counts', 'totalBalita'));
    }
}