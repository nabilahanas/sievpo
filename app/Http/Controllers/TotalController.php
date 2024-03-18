<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poin;

class TotalController extends Controller
{
    protected $primaryKey = 'id_poin';
    
    public function index()
    {
        $poin = Poin::all();
        return view('total.index', ['key'=>'total']);
    }
}
