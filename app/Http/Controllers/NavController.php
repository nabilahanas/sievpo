<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Data;
use App\Models\Bidang;
use Carbon\Carbon;
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

        $currentYear = Carbon::now()->year;
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $datas = Data::all();
        $monthlyTotals = [];

        // Dapatkan bulan saat ini
        // $currentMonth = Carbon::now()->month;

        // Inisialisasi array untuk menyimpan nama-nama bulan
        $monthsToShow = [];

        // Buat array yang berisi semua nama bulan dari Januari hingga bulan saat ini
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::createFromDate($currentYear, $i, 1)->format('F');
            $monthsToShow[] = $monthName;

            // Inisialisasi total poin untuk bulan ini jika belum ada
            if (!isset($monthlyTotals[$monthName])) {
                $monthlyTotals[$monthName] = 0;
            }
        }

        // Update data poin untuk bulan-bulan yang memiliki poin
        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');
            $monthlyTotals[$month] += $dataItem->poin;
        }

        return view('layouts.dashboard', compact('monthlyTotals', 'monthsToShow', 'month', 'total', 'approved', 'rejected', 'pending', 'berita', 'jmlpengumuman', 'user', 'poin', 'approvedstatus', 'rejectedstatus', 'pendingstatus', 'pengumuman'), ['key' => 'dashboard']);
    }
}