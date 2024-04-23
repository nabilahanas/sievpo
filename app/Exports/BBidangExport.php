<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;

class BbidangExport implements FromView
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('F Y');

        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        if (request()->has('bulan') && request()->has('tahun')) {
            $searchMonth = Carbon::createFromDate(request()->tahun, request()->bulan, 1);
            $currentMonth = $searchMonth->format('F Y');

            $datas = Data::whereYear('created_at', request()->tahun)
                         ->whereMonth('created_at', request()->bulan)
                         ->get();
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $item) {
            $tanggal = Carbon::parse($item->created_at)->format('d-m-Y');
            $bidangId = $item->id_bidang;
    
            if (!isset($data[$bidangId][$tanggal])) {
                $data[$bidangId][$tanggal] = 0;
            }
    
            $data[$bidangId][$tanggal] += $item->poin;
        }

        return view('exports.rekapbulanan.bbidang', compact('currentMonth','shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
}
