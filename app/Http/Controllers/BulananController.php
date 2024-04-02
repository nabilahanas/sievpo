<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;

class BulananController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $users = User::all();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        foreach ($users as $user) {
            $bulanIni = Carbon::now()->startOfMonth();
            while ($bulanIni->lte(Carbon::now())) {
                foreach ($bidang as $b) {
                    foreach ($shifts as $shift) {
                        $data[$user->id_user][$bulanIni->format('Y-m')][$b->id_bidang][$shift->id_shift] = 0;
                    }
                }
                $bulanIni->addMonth();
            }
        }

        $datas = Data::all();

        foreach ($datas as $item) {
            $bulan = Carbon::parse($item->created_at)->format('Y-m');
            $data[$item->id_user][$bulan][$item->id_bidang][$item->id_shift] = $item->poin;
        }

        return view('bulanan.index', compact('shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
}
