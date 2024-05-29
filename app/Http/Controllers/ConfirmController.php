<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use App\Models\Data;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ConfirmController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index(Request $request)
    {
        $data = Data::with(['bidang', 'shift', 'user']);

        if ($request->has('c_search') && !empty($request->input('c_search'))) {
            $c_search = $request->input('c_search');
            $data->where('is_approved', $c_search);
        }

        $data->orderBy('created_at', 'desc');

        if ($request->ajax() || $request->isXmlHttpRequest() || $request->input('is_ajax') === 'true') {
            return DataTables::eloquent($data)->toJson();
        }

        return view(
            'confirm.index',
            [
                'data' => []
            ],
            [
                'key' => 'confirm'
            ]
        );
    }


    public function approval(Request $request, $id, $status)
    {
        try {
            $data = Data::findOrFail($id);

            $idShift = $data->id_shift;
            $shift = Shift::find($idShift);

            $poin = $shift?->poin ?? 0;

            $createdDayOfWeek = Carbon::parse($data->created_at)->dayOfWeek;

            if ($status === 'approved') {
                if ($createdDayOfWeek === CarbonInterface::SATURDAY || $createdDayOfWeek === CarbonInterface::SUNDAY) {
                    $data->update(['is_approved' => 'approved', 'poin' => $poin + 1]);
                } else {
                    $response = Http::get('https://api-harilibur.vercel.app/api');

                    if ($response->successful()) {
                        $holidays = $response->json();
                        $createdDate = Carbon::parse($data->created_at)->toDateString();

                        $nationalHolidays = [];

                        foreach ($holidays as $holiday) {
                            if ($holiday['is_national_holiday']) {
                                $nationalHolidays[] = $holiday['holiday_date'];
                            }
                        }

                        if (in_array($createdDate, $nationalHolidays)) {
                            $data->update(['is_approved' => 'approved', 'poin' => $poin + 1]);
                        } else {
                            $data->update(['is_approved' => 'approved', 'poin' => $poin]);
                        }
                    }
                }

            } elseif ($status === 'rejected') {
                $data->update(['is_approved' => 'rejected', 'poin' => 0]);
            }

            return response()->json(['message' => 'Laporan berhasil dinilai']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return redirect()->route('confirm.index')->with('success', 'Data berhasil dihapus');
    }
}
