<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Data;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Exports\TKaryawanExport;
use App\Exports\TBidangExport;
use App\Exports\TbkphExport;
use App\Exports\TkrphExport;
use App\Exports\TasperExport;
use Maatwebsite\Excel\Facades\Excel;

class TotalController extends Controller
{
    protected $primaryKey = 'id_data';

    public function exportkaryawan(Request $request)
    {
        return Excel::download(new TKaryawanExport($request->semester, $request->year), 'Total Karyawan.xlsx');
    }

    public function exportbidang(Request $request)
    {
        return Excel::download(new TBidangExport($request->semester, $request->year), 'Total Bidang.xlsx');
    }

    public function exportbkph(Request $request)
    {
        return Excel::download(new TbkphExport($request->semester, $request->year), 'Total BKPH.xlsx');
    }

    public function exportkrph(Request $request)
    {
        return Excel::download(new TkrphExport($request->semester, $request->year), 'Total KRPH.xlsx');
    }

    public function exportasper(Request $request)
    {
        return Excel::download(new TasperExport($request->semester, $request->year), 'Total AsperKBKPH.xlsx');
    }
    public function karyawan(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $karyawanTotals = [];

        if ($request->has('semester') && $request->has('year')) {
            $semester = $request->semester;
            $year = $request->year;

            if ($semester == 01) {
                $startMonth = 1;
                $endMonth = 7;
            } else {
                $startMonth = 8;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->format('Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $userId = $dataItem->id_user;

            if (!isset($karyawanTotals[$userId][$month])) {
                $karyawanTotals[$userId][$month] = 0;
            }
            $karyawanTotals[$userId][$month] += $dataItem->poin;
        }

        return view('total.karyawan', compact('user', 'request', 'bidang', 'currentYear', 'karyawanTotals'), ['key' => 'tkaryawan']);
    }

    public function bidang(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $bidangTotals = [];

        if ($request->has('semester') && $request->has('year')) {
            $semester = $request->semester;
            $year = $request->year;

            if ($semester == 01) {
                $startMonth = 1;
                $endMonth = 7;
            } else {
                $startMonth = 8;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->format('Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bidangId = $dataItem->id_bidang;

            if (!isset($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }

        return view('total.bidang', compact('user', 'request', 'bidang', 'currentYear', 'bidangTotals'), ['key' => 'tbidang']);
    }

    public function bkph(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $bkphTotals = [];

        // $jabatan = Jabatan::groupBy('bagian')
        //     ->select('bagian')
        //     ->get();

        $jabatan = Jabatan::whereNotIn('bagian', ['sistem'])
            ->groupBy('bagian')
            ->select('bagian')
            ->get();


        if ($request->has('semester') && $request->has('year')) {
            $semester = $request->semester;
            $year = $request->year;

            if ($semester == 01) {
                $startMonth = 1;
                $endMonth = 7;
            } else {
                $startMonth = 8;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->format('Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bkphId = $dataItem->user->jabatan->bagian;

            if (!isset($bkphTotals[$bkphId][$month])) {
                $bkphTotals[$bkphId][$month] = 0;
            }
            $bkphTotals[$bkphId][$month] += $dataItem->poin;
        }

        return view('total.bkph', compact('user', 'request', 'jabatan', 'bidang', 'currentYear', 'bkphTotals'), ['key' => 'tbkph']);
    }

    public function krph(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $jabatan1 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'KRPH')
            ->get();

        $krphTotals = [];

        if ($request->has('semester') && $request->has('year')) {
            $semester = $request->semester;
            $year = $request->year;

            if ($semester == 01) {
                $startMonth = 1;
                $endMonth = 6;
            } else {
                $startMonth = 7;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->format('Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $krphId = $dataItem->user->id_user;

            if (!isset($krphTotals[$krphId][$month])) {
                $krphTotals[$krphId][$month] = 0;
            }
            $krphTotals[$krphId][$month] += $dataItem->poin;
        }

        // HIGHCHARTS
        $categories = [];

        foreach ($user as $u) {
            if ($u->jabatan->klasifikasi == 'KRPH')
                $categories[] = $u->nama_user;

        }

        return view('total.krph', compact('user', 'request', 'jabatan1', 'bidang', 'currentYear', 'krphTotals', 'categories'), ['key' => 'tkrph']);
    }

    public function asper(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $jabatan2 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'ASPER')
            ->get();

        $asperTotals = [];

        if ($request->has('semester') && $request->has('year')) {
            $semester = $request->semester;
            $year = $request->year;

            if ($semester == 01) {
                $startMonth = 1;
                $endMonth = 7;
            } else {
                $startMonth = 8;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->format('Y');
        } else {
            $datas = Data::all();
        }


        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $asperId = $dataItem->user->id_user;

            if (!isset($asperTotals[$asperId][$month])) {
                $asperTotals[$asperId][$month] = 0;
            }
            $asperTotals[$asperId][$month] += $dataItem->poin;
        }

        // HIGHCHARTS
        $categories = [];

        foreach ($user as $u) {
            if ($u->jabatan->klasifikasi == 'ASPER')
                $categories[] = $u->nama_user;

        }

        return view('total.asper', compact('user', 'request', 'jabatan2', 'bidang', 'currentYear', 'asperTotals', 'categories'), ['key' => 'tasper']);
    }
}