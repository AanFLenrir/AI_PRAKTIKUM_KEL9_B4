<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        // Check permission
        abort_if(!$user->can('view-any-balita') && !$user->can('view-own-balita'), 403, 'Anda tidak memiliki hak akses untuk melihat data balita.');

        if ($user->can('view-any-balita')) {
            $parentId = $request->get('parent_id');

            if ($parentId) {
                // View toddlers of a specific parent
                $parent = OrangTua::with(['user', 'balita' => function($q) {
                    $q->orderBy('nama_balita', 'asc');
                }])->findOrFail($parentId);

                return view('user-dashboard.data-balita.index', compact('parent'));
            }

            // List all parents
            $search = $request->get('search');
            $parents = OrangTua::with(['user', 'balita'])
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('user', function ($qu) use ($search) {
                            $qu->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                        })
                        ->orWhere('no_hp', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%");
                    });
                })
                ->paginate(5);

            return view('user-dashboard.data-balita.index', compact('parents', 'search'));
        } else {
            // For orang-tua role (view-own-balita)
            $parent = OrangTua::with(['user', 'balita' => function($q) {
                $q->orderBy('nama_balita', 'asc');
            }])->firstOrCreate(['id' => $user->id], ['alamat' => '-', 'no_hp' => '-']);

            return view('user-dashboard.data-balita.index', compact('parent'));
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        // Check permission
        abort_if(!$user->can('create-balita'), 403, 'Anda tidak memiliki hak akses untuk menambah data balita.');

        $request->validate([
            'nama_balita' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'id_orang_tua' => 'required|exists:orang_tua,id',
        ]);

        // For orang-tua role, prevent storing under another parent's ID
        if (!$user->can('view-any-balita') && $request->id_orang_tua != $user->id) {
            abort(403, 'Anda hanya dapat mendaftarkan balita untuk diri sendiri.');
        }

        Balita::create($request->all());

        return redirect()->route('balita.index', ['parent_id' => $request->id_orang_tua])
            ->with('success', 'Data balita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $balita = Balita::findOrFail($id);

        // Check permission
        if (!$user->can('update-any-balita')) {
            abort_if(!$user->can('update-own-balita') || $balita->id_orang_tua != $user->id, 403, 'Anda tidak memiliki hak akses untuk mengubah data balita ini.');
        }

        $request->validate([
            'nama_balita' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
        ]);

        $balita->update($request->all());

        return redirect()->route('balita.index', ['parent_id' => $balita->id_orang_tua])
            ->with('success', 'Data balita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Check permission
        abort_if(!auth()->user()->can('delete-balita'), 403, 'Anda tidak memiliki hak akses untuk menghapus data balita.');

        $balita = Balita::findOrFail($id);
        $parentId = $balita->id_orang_tua;
        $balita->delete();

        return redirect()->route('balita.index', ['parent_id' => $parentId])
            ->with('success', 'Data balita berhasil dihapus.');
    }
}
