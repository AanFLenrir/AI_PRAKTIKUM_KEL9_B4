<?php

namespace App\Http\Controllers;

use App\Models\StatusGizi;
use Illuminate\Http\Request;

class StatusGiziController extends Controller
{
    // Hapus __construct

    public function index(Request $request)
    {
        $search = $request->get('search');
        $statuses = StatusGizi::when($search, fn($q) => $q->where('nama_status', 'like', "%{$search}%"))->paginate(10);
        return view('admin.master-data.status-gizi.index', compact('statuses', 'search'));
    }

    public function create()
    {
        return view('admin.master-data.status-gizi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|unique:status_gizis',
            'warna' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        StatusGizi::create($request->all());
        return redirect()->route('status-gizi.index')->with('success', 'Status Gizi ditambahkan');
    }

    public function edit(StatusGizi $statusGizi)
    {
        return view('admin.master-data.status-gizi.edit', compact('statusGizi'));
    }

    public function update(Request $request, StatusGizi $statusGizi)
    {
        $request->validate([
            'nama_status' => 'required|unique:status_gizis,nama_status,' . $statusGizi->id,
            'warna' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        $statusGizi->update($request->all());
        return redirect()->route('status-gizi.index')->with('success', 'Status Gizi diupdate');
    }

    public function destroy(StatusGizi $statusGizi)
    {
        $statusGizi->delete();
        return redirect()->route('status-gizi.index')->with('success', 'Status Gizi dihapus');
    }
}