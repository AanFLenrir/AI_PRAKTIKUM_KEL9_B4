<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    // Hapus __construct

    public function index(Request $request)
    {
        $search = $request->get('search');
        $imunisasis = Imunisasi::when($search, fn($q) => $q->where('nama_imunisasi', 'like', "%{$search}%")->orWhere('usia_rekomendasi', 'like', "%{$search}%"))->paginate(10);
        return view('admin.master-data.imunisasi.index', compact('imunisasis', 'search'));
    }

    public function create()
    {
        return view('admin.master-data.imunisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_imunisasi' => 'required',
            'usia_rekomendasi' => 'required',
            'deskripsi' => 'nullable',
        ]);
        Imunisasi::create($request->all());
        return redirect()->route('imunisasi.index')->with('success', 'Imunisasi ditambahkan');
    }

    public function edit(Imunisasi $imunisasi)
    {
        return view('admin.master-data.imunisasi.edit', compact('imunisasi'));
    }

    public function update(Request $request, Imunisasi $imunisasi)
    {
        $request->validate([
            'nama_imunisasi' => 'required',
            'usia_rekomendasi' => 'required',
            'deskripsi' => 'nullable',
        ]);
        $imunisasi->update($request->all());
        return redirect()->route('imunisasi.index')->with('success', 'Imunisasi diupdate');
    }

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();
        return redirect()->route('imunisasi.index')->with('success', 'Imunisasi dihapus');
    }
}