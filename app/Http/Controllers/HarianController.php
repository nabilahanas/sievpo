<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\HarianExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class HarianController extends Controller
{
    protected $primaryKey = 'id_data';

    public function export(Request $request) 
    {
        return Excel::download(new HarianExport($request->search), 'Rekap Harian.xlsx');
    }

    public function index(Request $request)
    {
        App::setLocale('id');
        $now = Carbon::now();

        $currentDate = $now->translatedFormat('d F Y');

        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        if ($request->has('search')) {
            $searchDate = Carbon::parse($request->search)->format('Y-m-d');
            $datas = Data::whereDate('created_at', $searchDate)->get();
            $currentDate = Carbon::parse($request->search)->translatedFormat('d F Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('Y-m-d');
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

        return view('harian.index', compact('currentDate', 'shifts', 'users', 'data', 'bidang'), ['key' => 'harian']);
    }


}