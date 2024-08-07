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
        $beritalanding = Berita::orderBy('created_at', 'desc')->paginate(9);

        $beritaContent = [];

        foreach ($berita as $item) {
            try {
                $url = $item->deskripsi;

                $htmlContent = file_get_contents($url);

                $beritaContent[$item->id_berita] = $htmlContent;
            } catch (\Exception $e) {
                $beritaContent[$item->id_berita] = null;
            }
        }

        return view('landing.berita', compact('berita', 'beritalanding','beritaContent'), ['key' => 'landing']);
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