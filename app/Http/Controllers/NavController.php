<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function dashboard()
    {
        $pengumuman = Pengumuman::all();
        return view('layouts.dashboard', compact('pengumuman'), ['key'=>'dashboard']);
    }
}