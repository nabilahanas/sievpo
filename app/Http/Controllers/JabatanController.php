<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    protected $primaryKey = 'id_jabatan';

    public function index()
    {
        $jabatan = Jabatan::all();
        return view('jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('jabatan.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
        ]);

        $data = $request->all();
        Jabatan::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('jabatan.index');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required',
        ]);
        $jabatan = Jabatan::find($id);
        $jabatan->update([
            'nama_jabatan' => $request -> nama_jabatan,
        ]);
        
        return redirect()->route('jabatan.index');
    }

    public function delete($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('jabatan.index');
    }
}
