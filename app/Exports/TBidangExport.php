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
use Illuminate\Support\Facades\App;

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
        App::setLocale('id');
        $currentYear = Carbon::now()->year;

        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $bidangTotals = [];

        if (request()->has('semester') && request()->has('year')) {
            $semester = request()->semester;
            $year = request()->year;

            if ($semester == 1) {
                $startMonth = 1;
                $endMonth = 6;
            } else {
                $startMonth = 7;
                $endMonth = 12;
            }

            $searchStart = Carbon::createFromDate($year, $startMonth, 1);

            $searchEnd = Carbon::createFromDate($year, $endMonth, 1)->endOfMonth();

            $datas = Data::whereBetween('created_at', [$searchStart, $searchEnd])->get();

            $currentYear = $searchStart->translatedFormat('Y');
        } else {
            $datas = Data::all();
        }

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->translatedFormat('F');

            $bidangId = $dataItem->id_bidang;

            if (!isset($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }
       
        return view('exports.rekaptotal.tbidang', compact('user', 'bidang', 'currentYear', 'bidangTotals'), ['key' => 'tbidang']);
    }
}
