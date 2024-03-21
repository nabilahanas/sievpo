<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\Poin;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;

class BulananController extends Controller
{
    protected $primaryKey = 'id_poin';

    public function index(Request $request)
    {
        $currentMonth = Carbon::now()->month; // Ambil bulan saat ini
        $currentYear = Carbon::now()->year; // Ambil tahun saat ini

        $poin = Poin::all();
        $bidang = Bidang::all();
        $shift = Shift::all();

        $items = Poin::whereHas('data', function($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                  ->whereYear('created_at', $currentYear);
        })
        ->get()
        ->groupBy(function($item) {
            return $item->data->user->id_user;
        });

        foreach ($items as $userId => $userItems) {
            // Inisialisasi total masing-masing poin untuk setiap user
            $userTotals = [];
            for ($i = 1; $i <= 4; $i++) {
                for ($j = 11; $j <= 18; $j++) {
                    $columnName = "poin_{$i}_{$j}";
                    $userTotals[$columnName] = 0;
                }
            }
        
            // Hitung total masing-masing poin untuk setiap user
            foreach ($userItems as $item) {
                for ($i = 1; $i <= 4; $i++) {
                    for ($j = 11; $j <= 18; $j++) {
                        $columnName = "poin_{$i}_{$j}";
                        $userTotals[$columnName] += $item->$columnName;
                    }
                }
            }
        
            // Gabungkan total poin untuk setiap user ke dalam total keseluruhan
            foreach ($userTotals as $columnName => $total) {
                if (!isset($totals[$columnName])) {
                    $totals[$columnName] = 0;
                }
                $totals[$columnName] += $total;
            }
        }

        return view('bulanan.index', compact('poin','bidang','shift','totals','items'), ['key' => 'bulanan']);
    }

}
