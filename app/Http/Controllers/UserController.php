<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $primaryKey = 'id_user';

    public function index()
    {
        $users = User::all();
        $usersDeleted = User::onlyTrashed()->get();
        return view('users.index', compact('users','usersDeleted'), ['key'=>'users']);
    }

    public function create()
    {
        return view('users.register', ['key'=>'users'])->with('success', 'Data user berhasil');
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
        $users -> delete();

        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus');
    }
}
