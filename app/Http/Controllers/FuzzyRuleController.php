<?php

namespace App\Http\Controllers;

use App\Models\RulesFuzzy;
use Illuminate\Support\Facades\Auth;

class FuzzyRuleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rules_fuzzy = RulesFuzzy::paginate(15);

        if ($user->hasRole('admin')) {
            return view('admin.fuzzy-rules.index', compact('rules_fuzzy'));
        } elseif ($user->hasRole('tenaga-kesehatan')) {
            
        }
        return back(401)->with("Unauthorized");
    }
}