<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Shift;
use App\Models\Data;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function index()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();
        $data = Data::all();

        return view('confirm.index', compact('bidang','shift','data'), ['key'=>'confirm']);
    }
}
