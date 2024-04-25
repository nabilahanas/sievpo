<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Exports\BKaryawanExport;
use App\Exports\BBidangExport;
use App\Exports\BbkphExport;
use App\Exports\BkrphExport;
use App\Exports\BasperExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class BulananController extends Controller
{
    protected $primaryKey = 'id_data';

    public function export(Request $request) 
    {
        return Excel::download(new BKaryawanExport($request->bulan, $request->tahun), 'Bulanan Karyawan.xlsx');
    }

    public function exportbidang(Request $request) 
    {
        return Excel::download(new BBidangExport($request->bulan, $request->tahun), 'Bulanan Bidang.xlsx');
    }

    public function exportbkph(Request $request) 
    {
        return Excel::download(new BbkphExport($request->bulan, $request->tahun), 'Bulanan BKPH.xlsx');
    }

    public function exportkrph(Request $request) 
    {
        return Excel::download(new BkrphExport($request->bulan, $request->tahun), 'Bulanan KRPH.xlsx');
    }

    public function exportasper(Request $request) 
    {
        return Excel::download(new BasperExport($request->bulan, $request->tahun), 'Bulanan AsperKBKPH.xlsx');
    }

    public function karyawan(Request $request)
    {
        App::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->translatedFormat('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();
    
        $data = [];
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->translatedFormat('F Y');
    
            // Ambil semua data untuk bulan yang diminta
            $datas = Data::whereYear('created_at', $request->tahun)
                         ->whereMonth('created_at', $request->bulan)
                         ->get();
        } else {
            // Jika tidak ada bulan dan tahun yang diminta, ambil semua data
            $datas = Data::all();
        }
    
        // Iterasi melalui data dan kumpulkan poin per tanggal
        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $userId = $item->id_user;
    
            if (!isset($data[$userId][$tanggal])) {
                $data[$userId][$tanggal] = 0;
            }
    
            $data[$userId][$tanggal] += $item->poin;
        }

        // // HIGHCHARTS
        // $categories = [];

        // foreach ($users as $u) {
        //     $categories[] = $u->nama_user;
        // }
    
        return view('bulanan.karyawan', compact('currentMonth', 'request', 'shifts', 'users', 'data', 'bidang'), ['key' => 'bkaryawan']);
    }
    
    public function bidang(Request $request)
    {
        App::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->translatedFormat('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();
    
        $data = [];
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->translatedFormat('F Y');
    
            // Ambil semua data untuk bulan yang diminta
            $datas = Data::whereYear('created_at', $request->tahun)
                         ->whereMonth('created_at', $request->bulan)
                         ->get();
        } else {
            // Jika tidak ada bulan dan tahun yang diminta, ambil semua data
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $bidangId = $item->id_bidang;
    
            if (!isset($data[$bidangId][$tanggal])) {
                $data[$bidangId][$tanggal] = 0;
            }
    
            $data[$bidangId][$tanggal] += $item->poin;
        }

        return view ('bulanan.bidang', compact('request', 'bidang', 'currentMonth', 'data'), ['key' => 'bbidang']);
    }

    public function bkph(Request $request)
    {
        App::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->translatedFormat('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();
    
        $data = [];

        $jabatan = Jabatan::groupBy('bagian')
            ->select('bagian')
            ->get();
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->translatedFormat('F Y');
    
            // Ambil semua data untuk bulan yang diminta
            $datas = Data::whereYear('created_at', $request->tahun)
                         ->whereMonth('created_at', $request->bulan)
                         ->get();
        } else {
            // Jika tidak ada bulan dan tahun yang diminta, ambil semua data
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $bkphId = $item->user->jabatan->bagian;
    
            if (!isset($data[$bkphId][$tanggal])) {
                $data[$bkphId][$tanggal] = 0;
            }
    
            $data[$bkphId][$tanggal] += $item->poin;
        }



        return view ('bulanan.bkph', compact('request', 'jabatan', 'bidang', 'currentMonth', 'data'), ['key' => 'bbkph']);
    }

    public function krph(Request $request)
    {
        App::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->translatedFormat('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $jabatan1 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'KRPH')
            ->get();
    
        $data = [];
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->translatedFormat('F Y');
    
            // Ambil semua data untuk bulan yang diminta
            $datas = Data::whereYear('created_at', $request->tahun)
                         ->whereMonth('created_at', $request->bulan)
                         ->get();
        } else {
            // Jika tidak ada bulan dan tahun yang diminta, ambil semua data
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $krphId = $item->user->id_user;
    
            if (!isset($data[$krphId][$tanggal])) {
                $data[$krphId][$tanggal] = 0;
            }
    
            $data[$krphId][$tanggal] += $item->poin;
        }

        return view ('bulanan.krph', compact('request', 'jabatan1', 'bidang', 'currentMonth', 'data'), ['key' => 'bkrph']);
    }

    public function asper(Request $request)
    {
        App::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->translatedFormat('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $jabatan2 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'ASPER')
            ->get();
    
        $data = [];
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->translatedFormat('F Y');
    
            // Ambil semua data untuk bulan yang diminta
            $datas = Data::whereYear('created_at', $request->tahun)
                         ->whereMonth('created_at', $request->bulan)
                         ->get();
        } else {
            // Jika tidak ada bulan dan tahun yang diminta, ambil semua data
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $asperId = $item->user->id_user;
    
            if (!isset($data[$asperId][$tanggal])) {
                $data[$asperId][$tanggal] = 0;
            }
    
            $data[$asperId][$tanggal] += $item->poin;
        }

        return view ('bulanan.asper', compact('request', 'jabatan2', 'bidang', 'currentMonth', 'data'), ['key' => 'basper']);
    }

}
