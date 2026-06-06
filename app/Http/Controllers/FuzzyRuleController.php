<?php

namespace App\Http\Controllers;

class FuzzyRuleController extends Controller
{
    public function index()
    {
        return view('admin.fuzzy-rules.index'); // <-- perhatikan path ini
    }
}