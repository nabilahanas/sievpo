<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Jabatan;

class UserController extends Controller
{
    protected $primaryKey = 'id_user';

    public function index()
    {
        $users = User::all();
        $usersDeleted = User::onlyTrashed()->get();
        return view('users.index', compact('users', 'usersDeleted'), ['key' => 'users']);
    }

    public function create()
    {
        return view('users.register', ['key' => 'users'])->with('success', 'Data user berhasil');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $jabatans = Jabatan::all();
        $users = User::find($id);
        return view('users.edit', compact('users','roles','jabatans'), ['key' => 'users']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            // 'id_role' => 'required',
            // 'id_jabatan' => 'required',
            // 'password' => 'password'
        ]);

        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update nama dan NIP pengguna
        $user->nama_user = $request->nama_user;
        $user->nip = $request->nip;

        // Periksa apakah password diisi atau tidak
        if ($request->has('password')) {
            // Jika diisi, update password
            $request->validate([
                'password' => '', // Sesuaikan validasi ini sesuai kebutuhan
            ]);
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('users.index')->with('success', 'Data user berhasil diubah');
    }


    public function restore($id)
    {
        $users = User::onlyTrashed()->find($id);
        $users->restore();

        return redirect()->route('users.index')->with('success', 'Data user berhasil dipulihkan');
    }

    public function delete($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus');
    }
}
