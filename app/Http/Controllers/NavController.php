<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NavController extends Controller
{
    public function dashboard()
    {
        return view('layouts.dashboard', ['key'=>'dashboard']);
    } 
}
