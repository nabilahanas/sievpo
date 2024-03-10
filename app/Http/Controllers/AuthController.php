<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Jabatan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        $role = Role::all();
        $jabatan = Jabatan::all();

        return view('users/register', compact('role','jabatan'), ['key' => 'dashboard']);
    }


    public function registered(Request $request)
    {
        $users = User::create([
            'nama_user' => $request->nama_user,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'id_role' => $request->input('role'),
            'id_jabatan' => $request->input('jabatan'),
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Data user berhasil ditambahkan');
    }

    public function login()
    {
        return view('users/login');
    }

    public function ceklogin(Request $request)
    {
        if (
            !Auth::attempt([
                'nip' => $request->nip,
                'password' => $request->password,
            ])
        ) {
            return redirect('/login');
        } else {

            $request->session()->put('just_logged_in', true);

            $pengumuman = Pengumuman::all();
            $request->session()->put('pengumuman', $pengumuman);

            return redirect('/home');
        }
    }
    public function handle($request, $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
