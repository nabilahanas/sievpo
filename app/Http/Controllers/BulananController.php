<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BulananController extends Controller
{
    // protected $primaryKey = 'id_poin';

    public function index()
    {
        // $poin = Poin::all();
        return view('bulanan.index', ['key'=>'bulanan']);
    }
}
