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

class TasperExport implements FromView
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

        $jabatan2 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'ASPER')
            ->get();

        $asperTotals = [];

        foreach ($datas as $dataItem) {
            $month = $dataItem->created_at->format('F');

            $asperId = $dataItem->user->id_user;

            if (!isset($asperTotals[$asperId][$month])) {
                $asperTotals[$asperId][$month] = 0;
            }
            $asperTotals[$asperId][$month] += $dataItem->poin;
        }

        return view('exports.rekaptotal.tasper', compact('user',  'jabatan2', 'bidang', 'currentYear', 'currentSemester','asperTotals'), ['key' => 'tasper']);
    }
}
