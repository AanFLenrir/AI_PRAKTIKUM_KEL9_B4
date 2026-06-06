<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hapus method __construct() karena middleware sudah diatur di route

    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::with('roles')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
            ->paginate(10);
        return view('admin.master-data.user.index', compact('users', 'search'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.master-data.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('success', 'User ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.master-data.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'nullable|exists:roles,name',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if ($request->role) {
            $user->syncRoles([$request->role]);
        }
        return redirect()->route('users.index')->with('success', 'User diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User dihapus');
    }
}