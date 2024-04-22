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

class TBidangExport implements FromView
{
    protected $semester;
    protected $year;
    public function __construct($semester, $year)
    {
        $this->semester = $semester;
        $this->year = $year;
    }

    public function view(): View
    {
        $currentSemester = request()->input('semester');
        $currentYear = request()->input('year', Carbon::now()->year);
        $datas = Data::whereYear('created_at', $currentYear)->get();

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $bidangTotals = [];

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bidangId = $dataItem->id_bidang;

            if (!isset($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }
       
        return view('exports.rekaptotal.tbidang', compact('user','currentSemester', 'bidang', 'currentYear', 'bidangTotals'), ['key' => 'tbidang']);
    }
}
