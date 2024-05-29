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

class TkrphExport implements FromView
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

        $jabatan1 = User::with('jabatan')
            ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.klasifikasi', 'KRPH')
            ->get();

        $krphTotals = [];

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

            $krphId = $dataItem->user->id_user;

            if (!isset($krphTotals[$krphId][$month])) {
                $krphTotals[$krphId][$month] = 0;
            }
            $krphTotals[$krphId][$month] += $dataItem->poin;
        }

        return view('exports.rekaptotal.tkrph', compact('user', 'jabatan1', 'bidang', 'currentYear', 'krphTotals'), ['key' => 'tkrph']);
    }
}
