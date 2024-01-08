<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NavController extends Controller
{
    public function home()
    {
        return view ('layouts/home');
    }
}
