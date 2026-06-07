<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnalisisFuzzyController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // Check permission
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk melihat data analisis gizi.');

        $query = Pemeriksaan::with(['balita', 'statusGizi', 'petugas']);

        // RBAC: Tenaga kesehatan sees all, Orang Tua only sees their own children
        if (!$user->can('view-any-balita')) {
            $query->whereHas('balita', function ($q) use ($user) {
                $q->where('id_orang_tua', $user->id);
            });
        }

        // Optional search filter by Balita's name
        $search = $request->get('search');
        if ($search) {
            $query->whereHas('balita', function ($q) use ($search) {
                $q->where('nama_balita', 'like', "%{$search}%");
            });
        }

        // Paginate 5 items per page (5 baris/card per halaman)
        $pemeriksaans = $query->orderBy('tanggal_periksa', 'desc')
            ->orderBy('id_pemeriksaan', 'desc')
            ->paginate(5);

        return view('user-dashboard.analisis-fuzzy.index', compact('pemeriksaans', 'search'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk melakukan analisis gizi.');

        $orangTuaList = [];
        $balitaGroupByParent = [];
        $preselectedBalitaId = $request->query('balita_id');

        // Load list of Balita based on RBAC
        if ($user->can('view-any-balita')) {
            $balitaList = \App\Models\Balita::orderBy('nama_balita', 'asc')->get();
            $orangTuaList = \App\Models\OrangTua::join('users', 'orang_tua.id', '=', 'users.id')
                ->orderBy('users.name', 'asc')
                ->select('orang_tua.*')
                ->with('user')
                ->get();
            $balitaGroupByParent = \App\Models\Balita::orderBy('nama_balita', 'asc')
                ->get()
                ->groupBy('id_orang_tua');
        } else {
            $balitaList = \App\Models\Balita::where('id_orang_tua', $user->id)->orderBy('nama_balita', 'asc')->get();
        }

        $imunisasiList = \App\Models\Imunisasi::orderBy('umur_bulan', 'asc')->get();

        return view('user-dashboard.analisis-fuzzy.analisis', compact('balitaList', 'imunisasiList', 'orangTuaList', 'balitaGroupByParent', 'preselectedBalitaId'));
    }

    public function getBalita($id)
    {
        $user = Auth::user();
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses.');

        $balita = \App\Models\Balita::findOrFail($id);

        // RBAC validation
        if (!$user->can('view-any-balita')) {
            if ($balita->id_orang_tua != $user->id) {
                return response()->json(['error' => 'Akses ditolak'], 403);
            }
        }

        // Calculate age in months relative to today
        $birthDate = \Carbon\Carbon::parse($balita->tanggal_lahir);
        $ageInMonths = $birthDate->diffInDays(\Carbon\Carbon::now()) / 30.44;

        return response()->json([
            'id_balita' => $balita->id_balita,
            'nama_balita' => $balita->nama_balita,
            'jenis_kelamin' => $balita->jenis_kelamin,
            'tanggal_lahir' => $birthDate->translatedFormat('d F Y'),
            'umur_bulan' => round($ageInMonths, 1),
            'umur_bulan_raw' => $ageInMonths
        ]);
    }

    public function hasil()
    {
        $user = Auth::user();
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk melihat hasil analisis gizi.');

        return view('user-dashboard.analisis-fuzzy.hasil');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk menyimpan data pemeriksaan.');

        $validator = Validator::make($request->all(), [
            'id_balita' => 'required|exists:balita,id_balita',
            'umur_bulan' => 'required|numeric|min:0|max:60',
            'berat_badan' => 'required|numeric|min:1.5|max:40.0',
            'tinggi_badan' => 'required|numeric|min:35.0|max:130.0',
            'imt' => 'required|numeric|min:5.0|max:45.0',
            'kategori_bbu' => 'nullable|string',
            'kategori_pbu' => 'nullable|string',
            'kategori_bbpb' => 'nullable|string',
            'kategori_imtu' => 'nullable|string',
            'nilai_fuzzy' => 'required|numeric|between:0,100',
            'kategori_status_gizi' => 'required|string',
            'detail_hasil' => 'required|array',
            'daftar_imunisasi' => 'nullable|array'
        ], [
            // Pesan Kustom Bahasa Indonesia kamu tetap sama
            'id_balita.required' => 'Balita harus dipilih.',
            'id_balita.exists' => 'Data balita tidak ditemukan di database.',
            'umur_bulan.required' => 'Umur balita wajib diisi.',
            'umur_bulan.max' => 'Umur maksimal yang didukung sistem adalah 60 bulan (5 tahun).',
            'umur_bulan.min' => 'Umur tidak boleh minus.',
            'berat_badan.required' => 'Berat badan wajib diisi.',
            'berat_badan.min' => 'Berat badan terlalu kecil (minimal 1.5 kg).',
            'berat_badan.max' => 'Berat badan melebihi batas maksimal sistem (40 kg).',
            'tinggi_badan.required' => 'Tinggi badan wajib diisi.',
            'tinggi_badan.min' => 'Tinggi badan terlalu kecil untuk balita (minimal 35 cm).',
            'tinggi_badan.max' => 'Tinggi badan melebihi batas maksimal sistem (130 cm).',
            'imt.required' => 'Nilai IMT wajib disertakan.',
            'imt.min' => 'Hasil hitung IMT terlalu rendah (minimal 5.0).',
            'imt.max' => 'Hasil hitung IMT tidak masuk akal secara medis (maksimal 45.0). Periksa kembali input tinggi/berat badan.',
            'nilai_fuzzy.required' => 'Nilai Predikat Fuzzy wajib diisi.',
            'nilai_fuzzy.between' => 'Nilai standar fuzzy harus berada di rentang 0 sampai 100.',
            'kategori_status_gizi.required' => 'Kategori kesimpulan status gizi harus diisi.',
            'detail_hasil.required' => 'Detail perhitungan aturan fuzzy wajib dilampirkan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'is_validation_error' => true,
                'errors' => $validator->errors()->toArray(),
                'message' => $validator->errors()->first() // Ambil satu pesan error pertama untuk jalan pintas
            ], 422);
        }

        $balita = \App\Models\Balita::findOrFail($request->id_balita);

        $balita = \App\Models\Balita::findOrFail($request->id_balita);

        // RBAC validation
        if (!$user->can('view-any-balita')) {
            if ($balita->id_orang_tua != $user->id) {
                return response()->json(['error' => 'Akses ditolak. Anda hanya dapat menyimpan data pemeriksaan untuk balita milik sendiri.'], 403);
            }
        }

        // Find status gizi ID
        $statusGizi = \App\Models\StatusGizi::where('nama_status', $request->kategori_status_gizi)->first();
        $id_status_gizi = $statusGizi ? $statusGizi->id_status_gizi : 3;

        // Perform transactional save
        DB::beginTransaction();
        try {
            // Create Pemeriksaan record
            $pemeriksaan = Pemeriksaan::create([
                'tanggal_periksa' => now()->toDateString(),
                'umur_bulan' => (int) round($request->umur_bulan),
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'nilai_fuzzy' => $request->nilai_fuzzy,
                'imt' => $request->imt,
                'kategori_bbu' => $request->kategori_bbu === 'Data SD tidak tersedia' ? null : $request->kategori_bbu,
                'kategori_pbu' => $request->kategori_pbu === 'Data SD tidak tersedia' ? null : $request->kategori_pbu,
                'kategori_bbpb' => $request->kategori_bbpb === 'Data SD tidak tersedia' ? null : $request->kategori_bbpb,
                'kategori_imtu' => $request->kategori_imtu === 'Data SD tidak tersedia' ? null : $request->kategori_imtu,
                'id_balita' => $request->id_balita,
                'id_user' => $user->id,
                'id_status_gizi' => $id_status_gizi
            ]);

            // Save active rules in detail_hasil_fuzzy
            foreach ($request->detail_hasil as $rule) {
                \App\Models\DetailHasilFuzzy::create([
                    'rule_aktif' => $rule['rule_aktif'],
                    'alpha_predikat' => $rule['alpha_predikat'],
                    'nilai_defuzzy' => $rule['nilai_deffuzy'], // Map from JSON's 'nilai_deffuzy' to DB's 'nilai_defuzzy'
                    'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan,
                    'id_rule' => $rule['id_rule']
                ]);
            }

            // Attach immunizations
            if ($request->has('daftar_imunisasi') && !empty($request->daftar_imunisasi)) {
                $imunisasiIds = \App\Models\Imunisasi::whereIn('nama_imunisasi', $request->daftar_imunisasi)
                    ->pluck('id_imunisasi')
                    ->toArray();
                $pemeriksaan->imunisasi()->attach($imunisasiIds);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Hasil pemeriksaan gizi balita berhasil disimpan.',
                'id_pemeriksaan' => $pemeriksaan->id_pemeriksaan
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Gagal menyimpan data pemeriksaan gizi.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        // Check permission
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk melihat detail analisis gizi.');

        // Load examination with all relations, fuzzy details, and immunizations
        $pemeriksaan = Pemeriksaan::with(['balita', 'statusGizi', 'petugas', 'detailHasilFuzzy', 'imunisasi'])->findOrFail($id);

        // RBAC check for detail access
        if (!$user->can('view-any-balita')) {
            if ($pemeriksaan->balita->id_orang_tua != $user->id) {
                abort(403, 'Anda tidak memiliki hak akses untuk melihat detail pemeriksaan balita ini.');
            }
        }

        return view('user-dashboard.analisis-fuzzy.show', compact('pemeriksaan'));
    }
}
