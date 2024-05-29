<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
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
        $jmluser = User::count();

        // USER LOGIN
        $usersauth = Auth::user();
        $poinku = Data::where('id_user', $usersauth->id_user)->sum('poin');
        $approvedstatus = Data::where('is_approved', 'approved')->where('id_user', $usersauth->id_user)->count();
        $rejectedstatus = Data::where('is_approved', 'rejected')->where('id_user', $usersauth->id_user)->count();
        $pendingstatus = Data::where('is_approved', 'pending')->where('id_user', $usersauth->id_user)->count();

        $pengumuman = Pengumuman::all();
        App::setLocale('id');

        // KARYAWAN TAHUNAN
        $currentYear = Carbon::now()->year;
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $datas = Data::all();
        $monthlyTotals = [];

        $monthsToShow = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::createFromDate($currentYear, $i, 1)->translatedFormat('F');
            $monthsToShow[] = $monthName;

            if (!isset($monthlyTotals[$monthName])) {
                $monthlyTotals[$monthName] = 0;
            }
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->translatedFormat('F');
            $monthlyTotals[$month] += $dataItem->poin;
        }

        // KARYAWAN BULAN
        $currentMonth = Carbon::now()->translatedFormat('F Y');
        $usersToShow = [];
        $totalPerUser = [];
        
        foreach ($users as $user) {
            $usersToShow[] = $user->nama_user;
            $totalPerUser[$user->id_user] = 0;
        }
        
        foreach ($datas as $dataItem) {
            $tanggal = Carbon::parse($dataItem->created_at);
            $userId = $dataItem->id_user; // Ensure id_user field exists
            $poin = $dataItem->poin;
        
            if ($tanggal->translatedFormat('F Y') === $currentMonth) {
                // Check if $userId exists in $totalPerUser before incrementing
                if (isset($totalPerUser[$userId])) {
                    $totalPerUser[$userId] += $poin;
                }
            }
        }
        arsort($totalPerUser);
        
        // Menggabungkan nama pengguna dengan total poin dalam satu array asosiatif
        $userPoinData = [];
        foreach ($totalPerUser as $userId => $poin) {
            $userPoinData[] = [
                'name' => $users->where('id_user', $userId)->first()->nama_user,
                'poin' => $poin
            ];
        }
        
        // Mengonversi array ke dalam format JSON untuk digunakan di JavaScript
        $userPoinDatas = json_encode($userPoinData);
        
        // KARYAWAN TOTAL
        $karlogin = Auth::user();
        $datas2 = $karlogin->data;
        $karTotals = [];

        $monthsKar = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::createFromDate($currentYear, $i, 1)->translatedFormat('F');
            $monthsKar[] = $monthName;

            if (!isset($karTotals[$monthName])) {
                $karTotals[$monthName] = 0;
            }
        }

        foreach ($datas2 as $dataItem) {
            $month = $dataItem->created_at->translatedFormat('F');
            $karTotals[$month] += $dataItem->poin;
        }

        // PERBANDINGAN KARYAWAN
        $currentMonths = now()->month;
        $karlogin = Auth::user();
        $poinUser = [];
        $poinAllUser = [];

        $monthName = now()->translatedFormat('F');
        $poinUser[$monthName] = 0;
        $poinAllUser[$monthName] = 0;

        foreach ($datas2 as $dataItem) {
            if ($dataItem->created_at->year == $currentYear && $dataItem->created_at->month == $currentMonths) {
                $poinUser[$monthName] += $dataItem->poin;
            }
        }

        foreach ($datas as $dataItem) {
            if ($dataItem->created_at->year == $currentYear && $dataItem->created_at->month == $currentMonths) {
                $poinAllUser[$monthName] += $dataItem->poin;
            }
        }


        return view('layouts.dashboard', compact('userPoinDatas', 'poinAllUser', 'poinUser', 'monthsKar', 'karTotals', 'totalPerUser', 'usersToShow', 'currentMonth','currentYear', 'users', 'monthlyTotals', 'monthsToShow', 'total', 'approved', 'rejected', 'pending', 'berita', 'jmlpengumuman', 'jmluser', 'poinku', 'approvedstatus', 'rejectedstatus', 'pendingstatus', 'pengumuman'), ['key' => 'dashboard']);
    }
}