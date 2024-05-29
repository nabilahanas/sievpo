<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\MingguanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class MingguanController extends Controller
{
    protected $primaryKey = 'id_data';

    public function export(Request $request) 
    {
        return Excel::download(new MingguanExport($request->start_date, $request->end_date), 'Rekap Mingguan.xlsx');
    }

    public function index(Request $request)
    {
        App::setLocale('id');
        $now = Carbon::now();
        $start_date = $now->startOfWeek();
        $end_date = $start_date->copy()->endOfWeek();

        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
        
            $datas = Data::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $datas = Data::whereBetween('created_at', [$start_date, $end_date])->get();
        }        

        foreach ($datas as $item) {
            $tanggal = $item->created_at->format('Y-m-d');
                $userId = $item->id_user;
                $bidangId = $item->id_bidang;
                $shiftId = $item->id_shift;
                $poin = $item->poin;

                if (!isset($data[$userId][$tanggal][$bidangId][$shiftId])) {
                    $data[$userId][$tanggal][$bidangId][$shiftId] = 0;
                }

                $data[$userId][$tanggal][$bidangId][$shiftId] += $poin;
        }
        // dd($data);
        
        return view('mingguan.index', compact('shifts', 'users', 'data', 'bidang', 'start_date', 'end_date'), ['key' => 'mingguan']);
    }
}
