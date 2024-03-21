<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poin;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use Illuminate\Support\Facades\Schema;

class HarianController extends Controller
{
    protected $primaryKey = 'id_poin';

    public function index()
    {
        // Mengambil nama bidang
        $bidang = Bidang::select('nama_bidang')->get();

        // Mengambil nama shift
        $shift = Shift::select('nama_shift')->get();

        $poin = Poin::all();
        return view('harian.index', compact('poin', 'bidang', 'shift'), ['key' => 'harian']);
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

                // Periksa apakah nama kolom poin ada dalam tabel Poin
                if (Schema::hasColumn('poin', $namaPoin)) {
                    // Jika ada, atur nilai poin sesuai
                    Poin::updateOrCreate(
                        ['id_data' => $data->id_data],
                        [$namaPoin => $nilaiPoin]
                    );
                }
            }
        }
    }
}