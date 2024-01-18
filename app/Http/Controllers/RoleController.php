<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    protected $primaryKey = 'id_role';

    public function index()
    {
        $role = Role::all();
        return view('role.index', compact('role'));
    }

    public function create()
    {
        return view('role.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_role' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();
        Role::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required',
            'deskripsi' => 'required',
        ]);
        $role = Role::find($id);
        $role -> update([
            'nama_role' => $request -> nama_role,
            'deskripsi' => $request -> deskripsi,
        ]);

        return redirect()->route('role.index');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role -> delete();
        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('role.index');
    }
}
