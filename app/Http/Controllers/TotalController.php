<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Data;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Jabatan;

class TotalController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $user = User::where('id_role', '3')->get();
        $bidang = Bidang::all();

        $data = Data::all();

        $currentYear = Carbon::now()->year; // Ambil tahun saat ini

        // Mengambil data poin dari tabel 'data' untuk tahun ini
        $data1 = Data::whereYear('created_at', $currentYear)->get();

        //POIN PER KARYAWAN
        $karyawanTotals = []; // Penyimpanan total poin per bidang per bulan

        // Iterasi melalui data poin
        foreach ($data as $dataItem) {
            // Ambil bulan dari tanggal pembuatan ('created_at')
            $month = $dataItem->created_at->format('F');

            // Ambil ID bidang dari data
            $userId = $dataItem->user->nama_user;

            // Tambahkan poin ke total bidang untuk bulan tersebut
            if (!isset($karyawanTotals[$userId][$month])) {
                $karyawanTotals[$userId][$month] = 0;
            }
            $karyawanTotals[$userId][$month] += $dataItem->poin;
        }


        //POIN PER BIDANG
        $bidangTotals = []; // Penyimpanan total poin per bidang per bulan

        // Iterasi melalui data poin
        foreach ($data as $dataItem) {
            // Ambil bulan dari tanggal pembuatan ('created_at')
            $month = $dataItem->created_at->format('F');

            // Ambil ID bidang dari data
            $bidangId = $dataItem->bidang->nama_bidang;

            // Tambahkan poin ke total bidang untuk bulan tersebut
            if (!isset($bidangTotals[$bidangId][$month])) {
                $bidangTotals[$bidangId][$month] = 0;
            }
            $bidangTotals[$bidangId][$month] += $dataItem->poin;
        }


        // POIN PER BKPH
        $bkphTotals = [];

        // Ambil ID jabatan dari tabel "jabatan" berdasarkan klasifikasi "BKPH"
        $bkphJabatanId = Jabatan::where('klasifikasi', 'BKPH')->value('id_jabatan');

        // Mengambil data yang terkait dengan jabatan "BKPH"
        $data2 = Data::whereHas('user.jabatan', function ($query) use ($bkphJabatanId) {
            $query->where('id_jabatan', $bkphJabatanId);
        })->get();

        // Iterasi melalui data
        foreach ($data2 as $item) {
            $month = $item->created_at->format('F');
            $namaUser = $item->user->nama_user; // Ambil nama user

            // Pastikan kita menggunakan nama jabatan dari jabatan 'BKPH'
            $namaJabatan = $item->user->jabatan->nama_jabatan; // Ambil nama jabatan

            if (!isset($bkphTotals[$namaUser][$month])) {
                $bkphTotals[$namaUser][$month] = 0;
            }

            $bkphTotals[$namaUser][$month] += $item->poin;
        }


        // POIN PER KRPH
        $krphTotals = [];

        $data3 = Data::whereHas('user.jabatan', function ($query) {
            $query->where('klasifikasi', 'KRPH');
        })->get();


        foreach ($data3 as $krphItem) {
            $month = $krphItem->created_at->format('F');

            $krphId = $krphItem->user->jabatan->bagian;

            if (!isset($krphTotals[$krphId][$month])) {
                $krphTotals[$krphId][$month] = 0;
            }

            $krphTotals[$krphId][$month] += $krphItem->poin;
        }


        // POIN PER ASPER
        $asperTotals = [];

        // Mengambil ID jabatan dari tabel "jabatan" berdasarkan klasifikasi "asper"
        $asperJabatanId = Jabatan::where('klasifikasi', 'ASPER')->value('id_jabatan');

        // Mengambil data yang terkait dengan jabatan "asper" dan menghitung total poin per bulan
        $data4 = Data::whereHas('user.jabatan', function ($query) use ($asperJabatanId) {
            $query->where('id_jabatan', $asperJabatanId);
        })->get();

        foreach ($data4 as $asperItem) {
            $month = $asperItem->created_at->format('F');
            $asperId = $asperItem->user->jabatan->klasifikasi;

            // Menambahkan poin ke total poin per bulan
            if (!isset($asperTotals[$asperId][$month])) {
                $asperTotals[$asperId][$month] = 0;
            }
            $asperTotals[$asperId][$month] += $asperItem->poin;
        }

        return view('total.index', compact('user', 'data', 'data2', 'data3', 'data4', 'bidang', 'currentYear', 'karyawanTotals', 'bidangTotals', 'bkphTotals', 'krphTotals', 'asperTotals'), ['key' => 'total']);
    }
}