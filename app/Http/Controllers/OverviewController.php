<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function show()
    {
        return view('dashboard.overview.overview')
            ->with('title','Over View Page');
    }
}
