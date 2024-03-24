<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poin;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Shift;
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

        // Memuat relasi yang diperlukan dari model Poin
        $items = Poin::with('data.user')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function ($item) {
                return $item->data->user_id; // Ganti menjadi user_id atau sesuai dengan nama kolom yang sesuai
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

        return view('total.index', compact('poin', 'bidang', 'shift', 'totals', 'items'), ['key' => 'total']);
    }


}
