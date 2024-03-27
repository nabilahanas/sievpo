<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use App\Models\Data;
use Illuminate\Http\Request;
use App\Http\Controllers\HarianController;

class ConfirmController extends Controller
{
    protected $primaryKey = 'id_data';
    public function index()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();
        $data = Data::all();

        return view('confirm.index', compact('bidang', 'shift', 'data'), ['key' => 'confirm']);
    }

    // protected $harianController;

    // public function __construct(HarianController $harianController)
    // {
    //     $this->harianController = $harianController;
    // }

    public function approval($id, $status)
    {
        $data = Data::findOrFail($id);

        // Mengambil id_shift dari data
        $idShift = $data->id_shift;

        // Mengambil data shift berdasarkan id_shift
        $shift = Shift::find($idShift);

        // Mengambil nilai poin dari shift atau mengatur menjadi 0 jika shift tidak ditemukan
        $poin = $shift ? $shift->poin : 0;

        // Mengupdate data sesuai dengan status
        if ($status === 'approved') {
            // Jika disetujui, mengupdate is_approved menjadi 'approved' dan menambahkan poin dari shift
            $data->update(['is_approved' => 'approved', 'poin' => $data->poin + $poin]);
        } elseif ($status === 'rejected') {
            // Jika ditolak, mengupdate is_approved menjadi 'rejected' dan menetapkan poin menjadi 0
            $data->update(['is_approved' => 'rejected', 'poin' => 0]);
        }

        // $this->harianController->updatePoinFromData();

        return redirect()->route('confirm.index')->with('success', 'Laporan berhasil dinilai');
    }

    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return redirect()->route('confirm.index')->with('success', 'Data berhasil dihapus');
    }

}
