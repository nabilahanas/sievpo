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
        return view('users.index', compact('users'), ['key'=>'users']);
    }

    public function create()
    {
        return view('users.register', ['key'=>'users']);
    }

    public function delete($id)
    {
        $users = User::find($id);
        $users -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus');
    }
}
