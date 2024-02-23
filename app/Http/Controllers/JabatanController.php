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
        $jabatan = Jabatan::withTrashed()->get();
        return view('jabatan.index', compact('jabatan'), ['key'=>'jabatan']);
    }

    public function create()
    {
        return view('jabatan.add', ['key'=>'jabatan']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'wilayah' => 'required|boolean',
            'bagian' => 'required',
            'klasifikasi' => 'required',
        ]);

        $data = $request->all();
        Jabatan::create($data);

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return view('jabatan.edit', compact('jabatan'), ['key'=>'jabatan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'wilayah' => 'required|boolean',
            'bagian' => 'required',
            'klasifikasi' => 'required',
        ]);
        $jabatan = Jabatan::find($id);
        $jabatan->update([
            'nama_jabatan' => $request -> nama_jabatan,
            'wilayah' => $request -> wilayah,
            'bagian' => $request -> bagian,
            'klasifikasi' => $request -> klasifikasi,
        ]);
        
        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil diubah');
    }

    public function restore($id)
    {
        $jabatan = Jabatan::withTrashed()->find($id);
        $jabatan->restore();

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil dipulihkan');
    }

    public function delete($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan -> delete();

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil dihapus');
    }
}
