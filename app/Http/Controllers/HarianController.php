<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poin;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;

class HarianController extends Controller
{
    protected $primaryKey = 'id_poin';

    public function index()
    {
        // Mengambil nama bidang
        $bidang = Bidang::select('nama_bidang')->get();

        // Mengambil nama shift
        $shift = Shift::select('nama_shift')->get();

        // $poin = Poin::all();
        $poin = Poin::with('data.user')->get();

        $user = User::select('nama_user')->get();

        return view('harian.index', compact('poin', 'bidang', 'shift', 'user'), ['key' => 'harian']);
    }

    public function updatePoinFromData()
{
    // Ambil data yang memiliki status is_approved = 'approved' dan load relasi bidang dan shift
    $approvedData = Data::where('is_approved', 'approved')->with('bidang', 'shift')->get();

    foreach ($approvedData as $data) {
        // Ambil id_bidang dari data
        $idBidang = $data->id_bidang;

        // Ambil id_shift dari data
        $idShift = $data->id_shift;

        // Ambil model Bidang yang sesuai dengan id_bidang
        $bidang = Bidang::find($idBidang);

        // Ambil model Shift yang sesuai dengan id_shift
        $shift = Shift::find($idShift);

        // Periksa apakah bidang dan shift ditemukan
        if ($bidang && $shift) {
            // Buat nama kolom poin dengan format yang sesuai
            $namaPoin = 'poin_' . $idBidang . '_' . $idShift;

            // Ambil nilai poin dari kolom 'poin' di tabel Data
            $nilaiPoin = $data->poin;

            // Ambil id_user dari data
            $idUser = $data->id_user;

            // Cek apakah sudah ada entri Poin untuk id_user yang diberikan
            $poin = Poin::where('id_user', $idUser)->first();

            // Jika tidak ada entri Poin untuk id_user, buat entri baru
            if (!$poin) {
                $poin = new Poin();
                $poin->id_user = $idUser;
            }

            // Atur nilai poin sesuai dengan nama poin yang sesuai
            $poin->$namaPoin = $nilaiPoin;
            $poin->save();
        }
    }
}


}