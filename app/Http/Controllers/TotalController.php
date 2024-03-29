<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poin;
use App\Models\Data;
use App\Models\Bidang;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;

class TotalController extends Controller
{
    protected $primaryKey = 'id_poin';

    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year; // Ambil tahun saat ini

        $poin = Poin::all();
        $bidang = Bidang::all();
        $shift = Shift::all();
        $data = Data::all();
        $user = User::all();

        // Memuat relasi yang diperlukan dari model Poin
        $items = Poin::with('data.user')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function ($item) {
                return $item->data->id_user;
            })
            ->map(function ($userItems) {
                return $userItems->groupBy(function ($item) {
                    return $item->created_at->format('F'); // Kelompokkan berdasarkan bulan
                });
            });

        $totals = [];

        // Hitung total masing-masing poin untuk setiap user per bulan
        foreach ($items as $userId => $userMonths) {
            foreach ($userMonths as $month => $userItems) {
                // Inisialisasi total poin untuk setiap bulan
                if (!isset ($totals[$userId][$month])) {
                    $totals[$userId][$month] = 0;
                }

                // Hitung total poin untuk bulan ini
                foreach ($userItems as $item) {
                    for ($i = 1; $i <= 4; $i++) {
                        for ($j = 11; $j <= 18; $j++) {
                            $columnName = "poin_{$i}_{$j}";
                            $totals[$userId][$month] += $item->$columnName;
                        }
                    }
                }
            }
        }


        // Mengambil data poin dari tabel 'data' untuk tahun ini
        $data = Data::whereYear('created_at', $currentYear)->get();


        //POIN PER BIDANG
        $bidangTotals = []; // Penyimpanan total poin per bidang per bulan

        // Iterasi melalui data poin
        foreach ($data as $dataItem) {
            // Ambil bulan dari tanggal pembuatan ('created_at')
            $month = $dataItem->created_at->format('F');

            // Ambil ID bidang dari data
            $bidangId = $dataItem->id_bidang;

            // Tambahkan poin ke total bidang untuk bulan tersebut
            if (!isset ($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }


        // POIN PER BKPH
        $bkphTotals = [];

        foreach ($data as $item) {
            $month = $item->created_at->format('F');

            $bkphId = $item->user->jabatan->bagian;

            if (!isset ($bkphTotals[$bkphId][$month])) {
                $bkphTotals[$bkphId][$month] = 0;
            }

            $bkphTotals[$bkphId][$month] += $item->poin;
        }


        // POIN PER KRPH
        $krphTotals = [];

        $data = Data::whereHas('user.jabatan', function ($query) {
            $query->where('klasifikasi', 'KRPH');
        })->get();


        foreach ($data as $krphItem) {
            $month = $krphItem->created_at->format('F');

            $krphId = $krphItem->user->jabatan->klasifikasi;

            if (!isset ($krphTotals[$krphId][$month])) {
                $krphTotals[$krphId][$month] = 0;
            }

            $krphTotals[$krphId][$month] += $krphItem->poin;
        }


        // POIN PER ASPER
        $asperTotals = [];

        $data = Data::whereHas('user.jabatan', function ($query) {
            $query->where('klasifikasi', 'ASPER');
        })->get();


        foreach ($data as $asperItem) {
            $month = $asperItem->created_at->format('F');

            $asperId = $asperItem->user->jabatan->klasifikasi;

            if (!isset ($asperTotals[$asperId][$month])) {
                $asperTotals[$asperId][$month] = 0;
            }

            $asperTotals[$asperId][$month] += $asperItem->poin;
        }


        return view('total.index', compact('poin', 'bidang', 'shift', 'totals', 'items', 'bidangTotals', 'bkphTotals', 'krphTotals', 'asperTotals'), ['key' => 'total']);
    }
}