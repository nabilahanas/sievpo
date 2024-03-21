<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\Poin;

class BulananController extends Controller
{
    protected $primaryKey = 'id_poin';

    public function index()
    {
        $bidang = Bidang::select('nama_bidang')->get();
        $shift = Shift::select('nama_shift')->get();
        $poin = Poin::all();

        return view('bulanan.index', compact('poin','bidang','shift'), ['key'=>'bulanan']);
    }
}
