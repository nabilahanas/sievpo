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
        $jmluser = User::count();

        // USER LOGIN
        $usersauth = Auth::user();
        $poin = Data::where('id_user', $usersauth->id_user)->count('poin');
        $approvedstatus = Data::where('is_approved', 'approved')->where('id_user', $usersauth->id_user)->count();
        $rejectedstatus = Data::where('is_approved', 'rejected')->where('id_user', $usersauth->id_user)->count();
        $pendingstatus = Data::where('is_approved', 'pending')->where('id_user', $usersauth->id_user)->count();

        $pengumuman = Pengumuman::all();

        // KARYAWAN TAHUNAN
        $currentYear = Carbon::now()->year;
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $datas = Data::all();
        $monthlyTotals = [];

        $monthsToShow = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::createFromDate($currentYear, $i, 1)->format('F');
            $monthsToShow[] = $monthName;

            if (!isset($monthlyTotals[$monthName])) {
                $monthlyTotals[$monthName] = 0;
            }
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');
            $monthlyTotals[$month] += $dataItem->poin;
        }

        // KARYAWAN BULAN
        $currentMonth = Carbon::now()->format('F Y');
        $users = User::where('id_role', '3')->get();
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

            if ($tanggal->format('F Y') === $currentMonth) {
                // Check if $userId exists in $totalPerUser before incrementing
                if (isset($totalPerUser[$userId])) {
                    $totalPerUser[$userId] += $poin;
                }
            }
        }
        arsort($totalPerUser);


        // KARYAWAN TOTAL
        $karlogin = Auth::user();
        $datas2 = $karlogin->data;
        $karTotals = [];

        $monthsKar = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::createFromDate($currentYear, $i, 1)->format('F');
            $monthsKar[] = $monthName;

            if (!isset($karTotals[$monthName])) {
                $karTotals[$monthName] = 0;
            }
        }

        foreach ($datas2 as $dataItem) {
            $month = $dataItem->created_at->format('F');
            $karTotals[$month] += $dataItem->poin;
        }

        // PERBANDINGAN KARYAWAN
        $currentMonths = now()->month;
        $karlogin = Auth::user();
        $poinUser = [];
        $poinAllUser = [];

        $monthName = now()->format('F');
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


        return view('layouts.dashboard', compact('poinAllUser', 'poinUser', 'monthsKar', 'karTotals', 'totalPerUser', 'usersToShow', 'currentMonth','currentYear', 'users', 'monthlyTotals', 'monthsToShow', 'month', 'total', 'approved', 'rejected', 'pending', 'berita', 'jmlpengumuman', 'jmluser', 'poin', 'approvedstatus', 'rejectedstatus', 'pendingstatus', 'pengumuman'), ['key' => 'dashboard']);
    }
}