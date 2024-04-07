<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Data;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Jabatan;

class TotalController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $data = Data::all();
        
        $currentYear = Carbon::now()->year; 
        $data1 = Data::whereYear('created_at', $currentYear)->get();

        //POIN PER KARYAWAN
        $karyawanTotals = [];

        foreach ($data as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $userId = $dataItem->user->nama_user;

            // Tambahkan poin ke total bidang untuk bulan tersebut
            if (!isset($karyawanTotals[$userId][$month])) {
                $karyawanTotals[$userId][$month] = 0;
            }
            $karyawanTotals[$userId][$month] += $dataItem->poin;
        }


        //POIN PER BIDANG
        $bidangTotals = [];

        foreach ($data as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bidangId = $dataItem->bidang->nama_bidang;

            if (!isset($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }

        // POIN PER BKPH
        $bkphTotals = [];
        $jabatan = Jabatan::groupBy('bagian')
                ->select('bagian')
                ->get();

        foreach ($data as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bkphId = $dataItem->user->jabatan->bagian;

            if (!isset($bkphTotals[$bkphId][$month])) {
                $bkphTotals[$bkphId][$month] = 0;
            }
            $bkphTotals[$bkphId][$month] += $dataItem->poin;
        }


        // POIN PER KRPH
        $jabatan1 = User::with('jabatan')
                ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
                ->where('jabatan.klasifikasi', 'KRPH')
                ->get();

        $krphTotals = [];
        
        foreach ($data as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $krphId = $dataItem->user->nama_user;

            if (!isset($krphTotals[$krphId][$month])) {
                $krphTotals[$krphId][$month] = 0;
            }
            $krphTotals[$krphId][$month] += $dataItem->poin;
        }

        


        // POIN PER ASPER
        $jabatan2 = User::with('jabatan')
                ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
                ->where('jabatan.klasifikasi', 'ASPER')
                ->get();
        $asperTotals = [];

        foreach ($data as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $asperId = $dataItem->user->nama_user;

            if (!isset($asperTotals[$asperId][$month])) {
                $asperTotals[$asperId][$month] = 0;
            }
            $asperTotals[$asperId][$month] += $dataItem->poin;
        }

        return view('total.index', compact('user', 'data', 'jabatan','jabatan1','jabatan2', 'bidang', 'currentYear', 'karyawanTotals', 'bidangTotals', 'bkphTotals', 'krphTotals', 'asperTotals'), ['key' => 'total']);
    }
}