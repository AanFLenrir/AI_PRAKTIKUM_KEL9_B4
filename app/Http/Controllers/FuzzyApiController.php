<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class FuzzyApiController extends Controller
{
    /**
     * Hit endpoint /api/v1/fuzzy-calculation
     */
    public function fuzzyCalculation(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required|string|in:L,P',
            'berat_badan' => 'required|numeric|gt:0',
            'tinggi_badan' => 'required|numeric|gt:0',
            'umur_bulan' => 'required|integer|min:0',
            'daftar_imunisasi' => 'required|array',
        ]);

        $payload = [
            'jenis_kelamin' => $request->jenis_kelamin,
            'berat_badan' => (float) $request->berat_badan,
            'tinggi_badan' => (float) $request->tinggi_badan,
            'umur_bulan' => (int) $request->umur_bulan,
            'daftar_imunisasi' => $request->daftar_imunisasi,
        ];

        // Send POST request to FastAPI server running on localhost:5000
        $response = Http::post('http://127.0.0.1:5000/api/v1/fuzzy-calculation', $payload);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal terhubung atau mendapatkan respon dari server fuzzy.',
                'details' => $response->body()
            ], $response->status());
        }

        return response()->json($response->json());
    }

    /**
     * Hit endpoint /api/v1/kalkulasi-zscore
     */
    public function zscoreCalculation(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required|string|in:L,P',
            'berat_badan' => 'required|numeric|gt:0',
            'tinggi_badan' => 'required|numeric|gt:0',
            'umur_bulan' => 'required|integer|min:0',
        ]);

        $payload = [
            'jenis_kelamin' => $request->jenis_kelamin,
            'berat_badan' => (float) $request->berat_badan,
            'tinggi_badan' => (float) $request->tinggi_badan,
            'umur_bulan' => (int) $request->umur_bulan,
        ];

        // Send POST request to FastAPI server running on localhost:5000
        $response = Http::post('http://127.0.0.1:5000/api/v1/kalkulasi-zscore', $payload);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal terhubung atau mendapatkan respon dari server z-score.',
                'details' => $response->body()
            ], $response->status());
        }

        return response()->json($response->json());
    }

    /**
     * Hit both endpoints concurrently using Http::pool
     */
    public function calculateAll(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required|string|in:L,P',
            'berat_badan' => 'required|numeric|gt:0',
            'tinggi_badan' => 'required|numeric|gt:0',
            'umur_bulan' => 'required|integer|min:0',
            'daftar_imunisasi' => 'required|array',
        ]);

        $fuzzyPayload = [
            'jenis_kelamin' => $request->jenis_kelamin,
            'berat_badan' => (float) $request->berat_badan,
            'tinggi_badan' => (float) $request->tinggi_badan,
            'umur_bulan' => (int) $request->umur_bulan,
            'daftar_imunisasi' => $request->daftar_imunisasi,
        ];

        $zscorePayload = [
            'jenis_kelamin' => $request->jenis_kelamin,
            'berat_badan' => (float) $request->berat_badan,
            'tinggi_badan' => (float) $request->tinggi_badan,
            'umur_bulan' => (int) $request->umur_bulan,
        ];

        // Send concurrent POST requests to FastAPI server running on localhost:5000
        $responses = Http::pool(fn (Pool $pool) => [
            $pool->as('fuzzy')->post('http://127.0.0.1:5000/api/v1/fuzzy-calculation', $fuzzyPayload),
            $pool->as('zscore')->post('http://127.0.0.1:5000/api/v1/kalkulasi-zscore', $zscorePayload),
        ]);

        if ($responses['fuzzy']->failed() || $responses['zscore']->failed()) {
            return response()->json([
                'error' => 'Gagal terhubung atau mendapatkan respon lengkap dari server perhitungan.',
                'fuzzy_status' => $responses['fuzzy']->status(),
                'zscore_status' => $responses['zscore']->status(),
                'fuzzy_details' => $responses['fuzzy']->body(),
                'zscore_details' => $responses['zscore']->body(),
            ], 500);
        }

        return response()->json([
            'fuzzy' => $responses['fuzzy']->json(),
            'zscore' => $responses['zscore']->json(),
        ]);
    }
}
