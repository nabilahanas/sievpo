<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;

class MingguanExport implements FromView
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
        $now = Carbon::now();
        $start_date = request()->start_date ? Carbon::parse(request()->start_date) : Carbon::now()->startOfWeek();
        $end_date = request()->end_date ? Carbon::parse(request()->end_date) : $start_date->copy()->endOfWeek();
        $currentDate = $now->format('d F Y');
        $datas = Data::whereBetween('created_at', [$start_date, $end_date])->get();

        $users = User::where('id_role', '3')->get();
        $bidang = Bidang::all();
        $shifts = Shift::all();

        $data = [];

        foreach ($datas as $item) {
            // Jika start_date dan end_date tidak ditentukan, atau jika item berada dalam rentang tanggal yang ditentukan
            if (!$start_date || !$end_date || ($item->created_at->between($start_date, $end_date))) {
                $tanggal = $item->created_at->format('Y-m-d');
                $userId = $item->id_user;
                $bidangId = $item->id_bidang;
                $shiftId = $item->id_shift;
                $poin = $item->poin;

                if (!isset($data[$userId][$tanggal][$bidangId][$shiftId])) {
                    $data[$userId][$tanggal][$bidangId][$shiftId] = 0;
                }

                $data[$userId][$tanggal][$bidangId][$shiftId] += $poin;
            }
        }


        // dd($data);

        return view('exports.mingguan', compact('currentDate', 'shifts', 'users', 'data', 'bidang', 'start_date', 'end_date'), ['key' => 'mingguan']);
    }
}
