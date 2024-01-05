<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('users/register');
    }

    public function registered(Request $request)
    {
        $user = User::create([
            'nama_user' => $request -> nama_user,
            'nip' => $request -> nip,
            'role' => $request -> role,
            'password' => bcrypt ($request -> password),
            'id_jabatan' => $request -> id_jabatan,
            'id_wilayah' => $request -> id_wilayah,
        ]);
        return redirect('/login')->with('success', 'Data user berhasil ditambahkan');
    }


    public function login()
    {
        return view('users/login');
    }

    public function ceklogin(Request $request)
    {
        if (!Auth::attempt([
            'nip' => $request -> nip , 
            'password' => $request -> password
        ]))
        {
            return redirect('/login');
        }
        else{
            return redirect("Berhasil Login");
        }
    }
    // public function handle($request, $next)
    // {
    //     return Auth::onceBasic() ?: $next($request);
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/');
    // }
}
