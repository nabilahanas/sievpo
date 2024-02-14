<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function index()
    {
        // $poin = Poin::all();
        return view('confirm.index', ['key'=>'confirm']);
    }
}
