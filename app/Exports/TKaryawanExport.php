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

class TKaryawanExport implements FromView
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

        $karyawanTotals = [];

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $userId = $dataItem->id_user;

            if (!isset($karyawanTotals[$userId][$month])) {
                $karyawanTotals[$userId][$month] = 0;
            }
            $karyawanTotals[$userId][$month] += $dataItem->poin;
        }

        return view('exports.rekaptotal.tkaryawan', compact('user', 'bidang', 'currentYear', 'currentSemester', 'karyawanTotals'), ['key' => 'tkaryawan']);
    }
}
