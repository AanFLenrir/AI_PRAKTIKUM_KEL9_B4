<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        // Fetch User and Role
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $role = $user->getRoleNames()->first();

        // Kembalikan View sesuai Marwah
        if ($role == 'admin') {
            return view('admin.dashboard', compact('user', 'role'));
        } elseif ($role == 'tenaga-kesehatan' || $role == 'orang-tua') {
            return view('user-dashboard.index', compact('user', 'role'));
        }
        
        // Fallback jika user terdaftar tapi entah kenapa belum punya role
        abort(403, 'Anda tidak memiliki role yang sah untuk mengakses sistem.');
    }

}
