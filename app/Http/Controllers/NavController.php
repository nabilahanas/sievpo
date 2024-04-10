<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Data;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function dashboard()
    {
        // ADMIN
        $total = Data::count('poin');
        $approved = Data::where('is_approved', 'approved')->count();
        $rejected = Data::where('is_approved', 'rejected')->count();
        $pending = Data::where('is_approved', 'pending')->count();
        $berita = Berita::count();
        $jmlpengumuman = Pengumuman::count();
        $user = User::count();

        //USER LOGIN
        $users = Auth::user();
        $poin = Data::where('id_user', $users->id_user)->count('poin');
        $approvedstatus = Data::where('is_approved', 'approved')->where('id_user', $users->id_user)->count();
        $rejectedstatus = Data::where('is_approved', 'rejected')->where('id_user', $users->id_user)->count();
        $pendingstatus = Data::where('is_approved', 'pending')->where('id_user', $users->id_user)->count();

        $pengumuman = Pengumuman::all();
        return view('layouts.dashboard', compact('total', 'approved', 'rejected', 'pending', 'berita', 'jmlpengumuman', 'user', 'poin', 'approvedstatus', 'rejectedstatus', 'pendingstatus', 'pengumuman'), ['key' => 'dashboard']);
    }
}