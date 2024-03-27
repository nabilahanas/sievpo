<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;

class HarianController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {

        $users = User::all();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        // inisialisasi array untuk menyimpan data rekapitulasi poin
        $data = [];

        // Mengisi array rekapitulasi poin dengan nilai default nol untuk setiap pengguna dan shift
        foreach ($users as $user) {
            foreach ($shifts as $shift) {
                $data[$user->id][$shift->id] = 0; // Nilai default poin adalah 0
            }
        }

        // Mengambil data rekapitulasi poin yang sebenarnya
        $datas = Data::all();

        // Mengisi array rekapitulasi poin dengan data yang sebenarnya
        foreach ($datas as $item) {
            $datas[$item->id_user][$item->id_shift] = $item->poin;
        }

        return view('harian.index', compact( 'shifts', 'users', 'datas', 'bidang'), ['key' => 'harian']);
    }
}