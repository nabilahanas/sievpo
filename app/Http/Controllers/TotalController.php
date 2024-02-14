<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TotalController extends Controller
{
    public function index()
    {
        // $poin = Poin::all();
        return view('total.index', ['key'=>'total']);
    }
}
