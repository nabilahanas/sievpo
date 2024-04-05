<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;
use Carbon\Carbon;

class HarianController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $now = Carbon::now();
        $currentDate = $now->format('d F Y');;

        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        // Mengisi array rekapitulasi poin dengan nilai default nol untuk setiap pengguna dan shift
        foreach ($users as $user) {
            $hariIni = Carbon::now()->startofDay();
            while ($hariIni->lte(Carbon::now())){
                foreach ($bidang as $b){
                    foreach ($shifts as $shift) {
                        $data[$user->id_user][$hariIni->format('Y-m-d')][$b->id_bidang][$shift->id_shift] = 0;
                    }
                }
                $hariIni->addDay();
            }
        }

        $datas = Data::all();

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('Y-m-d');
            $data[$item->id_user][$tanggal][$item->id_bidang][$item->id_shift] = $item->poin;
        }

        return view('harian.index', compact('currentDate','shifts', 'users', 'data', 'bidang'), ['key' => 'harian']);
    }
}