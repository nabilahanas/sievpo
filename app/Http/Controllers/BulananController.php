<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;
use Illuminate\Http\Request;

class BulananController extends Controller
{
    protected $primaryKey = 'id_data';

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
            $datas = Data::whereYear('created_at', $searchMonth->year)
                ->whereMonth('created_at', $searchMonth->month)
                ->get();

            $currentMonth = $searchMonth->format('F Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $bulan = Carbon::parse($item->created_at)->format('m-Y');
            $userId = $item->id_user;
            $bidangId = $item->id_bidang;
            $shiftId = $item->id_shift;
            $poin = $item->poin;

            if (!isset($data[$userId][$bulan][$bidangId][$shiftId])) {
                $data[$userId][$bulan][$bidangId][$shiftId] = 0;
            }

            $data[$userId][$bulan][$bidangId][$shiftId] += $poin;
        }

        // dd($data);

        return view('bulanan.index', compact('currentMonth', 'shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
}
