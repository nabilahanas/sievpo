<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;

class HarianExport implements FromView
{
    public function __construct($search)
    {
        $this->search = $search;
    }

    public function view(): View
    {
        $datas = Data::all();
        $now = Carbon::now();

        $currentDate = $now->format('d F Y');
        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('Y-m-d');
            $userId = $item->id_user;
            $bidangId = $item->id_bidang;
            $shiftId = $item->id_shift;
            $poin = $item->poin;

            // Periksa apakah key sudah ada dalam $data, jika tidak, inisialisasi dengan 0
            if (!isset($data[$userId][$tanggal][$bidangId][$shiftId])) {
                $data[$userId][$tanggal][$bidangId][$shiftId] = 0;
            }

            // Tambahkan poin ke dalam data yang sesuai
            $data[$userId][$tanggal][$bidangId][$shiftId] += $poin;
        }
        
        return view('exports.harian', compact('currentDate', 'shifts', 'users', 'data', 'bidang'), ['key' => 'harian']);
    }
}
