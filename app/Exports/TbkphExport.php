<?php

namespace App\Exports;

use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use App\Models\Data;
use App\Models\Shift;
use App\Models\Bidang;
use app\Models\User;

class TbkphExport implements FromView
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
        $jabatan = Jabatan::all();

        $bkphTotals = [];

        // $jabatan = Jabatan::groupBy('bagian')
        //     ->select('bagian')
        //     ->get();

        $jabatan = Jabatan::whereNotIn('bagian', ['sistem'])
            ->groupBy('bagian')
            ->select('bagian')
            ->get();

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $bkphId = $dataItem->user->jabatan->bagian;

            if (!isset($bkphTotals[$bkphId][$month])) {
                $bkphTotals[$bkphId][$month] = 0;
            }
            $bkphTotals[$bkphId][$month] += $dataItem->poin;
        }

        return view('exports.rekaptotal.tbkph', compact('user', 'currentSemester', 'jabatan', 'bidang', 'currentYear', 'bkphTotals'), ['key' => 'tbkph']);
    }
}
