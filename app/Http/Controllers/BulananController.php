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
            $startDate = $searchMonth->startOfMonth();
            $endDate = $searchMonth->endOfMonth();
            $datas = Data::whereBetween('created_at', [$startDate, $endDate])->get();

            $currentMonth = $searchMonth->format('F Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $userId = $item->id_user;

            if (!isset($data[$userId][$tanggal])) {
                $data[$userId][$tanggal] = 0;
            }

            $data[$userId][$tanggal] += $item->poin;
        }

        // dd($data);

        return view('bulanan.index', compact('currentMonth','request', 'shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
}
