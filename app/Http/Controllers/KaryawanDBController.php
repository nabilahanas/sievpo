<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanDBController extends Controller
{
    protected $primaryKey = 'id_karyawan';

    public function index()
    {
        $karyawan = Karyawan::all();
        $karyawanDeleted = Karyawan::onlyTrashed()->get();
        
        $totalKaryawan = Karyawan::count();

        return view('karyawan.index', compact('karyawan', 'karyawanDeleted', 'totalKaryawan'), ['key'=>'karyawan']);
    }

    public function create()
    {
        return view('karyawan.add', ['key'=>'karyawan']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'=>'required',
            'jabatan'=>'required',
        ]);
        $data = $request->all();
        Karyawan::create($data);

        return redirect()->route('karyawan.index')->with('succes', 'Data karyawan berhasil ditambahan');
    }

    public function edit($id)
    {
        $karaywan = Karyawan::find($id);
        return view('karyawan.edit', compact('karyawan'), ['key'=>'karyawan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'=>'required',
            'jabatan'=>'required'
        ]);

        $karyawan = Karyawan::find($id);
        $karyawan->update([
            'nama' => $request -> nama,
            'jabatan' => $request -> jabatan,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diubah');
    }

    public function restore($id)
    {
        $karyawan = Karyawan::onlyTrashed()->find($id);

        $karyawan->restore();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dipulihkan');
    }

    public function delete($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan -> delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus');
    }
}
