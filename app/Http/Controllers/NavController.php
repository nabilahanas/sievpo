<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function dashboard()
    {
        return view('layouts.dashboard', ['key'=>'dashboard']);
    }
}