<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poin;

class HarianController extends Controller
{
    // protected $primaryKey = 'id_poin';

    public function index()
    {
        $poin = Poin::all();
        return view('harian.index', compact('poin'), ['key'=>'harian']);
    }
}
