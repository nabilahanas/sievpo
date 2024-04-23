<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\BulananExport;
use Maatwebsite\Excel\Facades\Excel;

class BulananController extends Controller
{
    protected $primaryKey = 'id_data';

    public function export(Request $request) 
    {
        return Excel::download(new BulananExport($request->bulan, $request->tahun), 'Rekap Bulanan.xlsx');
    }

    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('F Y');
    
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();
    
        $data = [];
    
        if ($request->has('bulan') && $request->has('tahun')) {
            $searchMonth = Carbon::createFromDate($request->tahun, $request->bulan, 1);
            $currentMonth = $searchMonth->format('F Y');
    
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
    
        // dd($data);
    
        return view('bulanan.index', compact('currentMonth', 'request', 'shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
    

}
