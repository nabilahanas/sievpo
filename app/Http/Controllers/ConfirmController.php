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
        $data = Data::with(['bidang', 'shift', 'user']); // Inisialisasi eloquent

        if ($request->has('c_search') && !empty($request->input('c_search'))) {
            $c_search = $request->input('c_search');
            // Filter data berdasarkan kata kunci pencarian pada kolom 'is_approved'
            $data->where('is_approved', $c_search);
        }

        // Urutkan data berdasarkan waktu masuk (created_at) dari terbaru ke terlama
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


    public function approval($id, $status)
    {
        $data = Data::findOrFail($id);

        // Mengambil id_shift dari data
        $idShift = $data->id_shift;

        // Mengambil data shift berdasarkan id_shift
        $shift = Shift::find($idShift);

        // Mengambil nilai poin dari shift atau mengatur menjadi 0 jika shift tidak ditemukan
        $poin = $shift?->poin ?? 0;

        // $isWeekend = Carbon::parse($data->created_at)->isWeekend();
        // $isHoliday = false;

        $createdDayOfWeek = Carbon::parse($data->created_at)->dayOfWeek;

        // Pengecekan status
        if ($status === 'approved') {
            if ($createdDayOfWeek === CarbonInterface::SATURDAY) {
                $poin += 1;
            } elseif ($createdDayOfWeek === CarbonInterface::SUNDAY) {
                // Menambah poin tambahan untuk Sabtu dan Minggu jika status disetujui
                // if ($isWeekend) {
                $poin += 1;
            } else {
                // Panggil API untuk mendapatkan daftar hari libur nasional
                $response = Http::get('https://api-harilibur.vercel.app/api');

                // Periksa apakah panggilan API berhasil
                if ($response->successful()) {
                    // Ambil daftar hari libur nasional dari respons
                    $nationalHolidays = $response->json();

                    // Periksa apakah tanggal dibuatnya data adalah hari libur nasional
                    $createdDate = Carbon::parse($data->created_at)->toDateString();
                    if (in_array($createdDate, $nationalHolidays)) {
                        // $isHoliday = count(array_filter($nationalHolidays, fn ($date) => isset($date['holiday_date']) && $date['holiday_date'] === $createdDate)) > 0;
                        // if ($isHoliday) {
                        $poin += 1;
                    }
                }
            }

            // Update data menjadi 'approved' dan menambahkan poin dari shift hanya jika bukan Sabtu, Minggu, atau hari libur nasional
            // if ($isWeekend || $isHoliday) {
            if ($createdDayOfWeek !== CarbonInterface::SATURDAY && $createdDayOfWeek !== CarbonInterface::SUNDAY && !in_array($createdDate, $nationalHolidays)) {
                $data->update(['is_approved' => 'approved', 'poin' => $poin += 1]);
            } else {
                $data->update(['is_approved' => 'approved', 'poin' => $poin]);
            }
        } elseif ($status === 'rejected') {
            $data->update(['is_approved' => 'rejected', 'poin' => 0]);
        }

        return redirect()->route('confirm.index')->with('success', 'Laporan berhasil dinilai');
    }

    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return redirect()->route('confirm.index')->with('success', 'Data berhasil dihapus');
    }
}
