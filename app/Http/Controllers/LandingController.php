<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Berita;
use App\Models\User;
use App\Models\Karyawan;
use Sunra\PhpSimple\HtmlDomParser;

class LandingController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::count();
        $bidang = Bidang::count();

        return view('landing.home', compact('karyawan', 'bidang'), ['key' => 'landing']);
    }

    public function profile()
    {
        return view('landing.profile', ['key' => 'landing']);
    }

    public function visimisi()
    {
        return view('landing.visimisi', ['key' => 'landing']);
    }

    public function struktur()
    {
        return view('landing.struktur', ['key' => 'landing']);
    }

    public function datakaryawan()
    {
        $karyawan = Karyawan::all();

        return view('landing.datakaryawan', compact('karyawan'), ['key' => 'landing']);
    }

    public function berita()
    {
        $berita = Berita::all();

        $beritaContent = [];

        foreach ($berita as $item) {
            try {
                // Mendapatkan URL dari setiap berita
                $url = $item->deskripsi;

                // Mendapatkan konten HTML dari URL menggunakan HtmlDomParser
                $html = HtmlDomParser::file_get_html($url);

                // Simpan konten HTML dalam array
                $beritaContent[$item->id_berita] = $html;
            } catch (\Exception $e) {
                // Tangani kesalahan yang terjadi saat mengambil konten dari URL
                // Anda dapat menentukan tindakan yang sesuai, seperti menyimpan pesan kesalahan atau memberikan nilai default
                $beritaContent[$item->id_berita] = null;
            }
        }

        return view('landing.berita', compact('berita', 'beritaContent'), ['key' => 'landing']);
    }

    public function fitur()
    {
        return view('landing.fitur', ['key' => 'landing']);
    }

    public function wilayah()
    {
        return view('landing.wilayah', ['key' => 'landing']);
    }
}