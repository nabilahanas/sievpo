<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Bidang;
use App\Models\Shift;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\User;

class BkrphExport implements FromView
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

        $jabatan1 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'KRPH')
            ->get();

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
            $krphId = $item->user->id_user;
    
            if (!isset($data[$krphId][$tanggal])) {
                $data[$krphId][$tanggal] = 0;
            }
    
            $data[$krphId][$tanggal] += $item->poin;
        }

        return view('exports.rekapbulanan.bkrph', compact('currentMonth', 'jabatan1','shifts', 'users', 'data', 'bidang'), ['key' => 'bulanan']);
    }
}
