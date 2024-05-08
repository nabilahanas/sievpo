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

        return view('karyawan.index', compact('karyawan', 'karyawanDeleted', 'totalKaryawan'), ['key' => 'karyawan']);
    }

    public function create()
    {
        return view('karyawan.add', ['key' => 'karyawan']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required',
        ]);

        $existingKaryawan = Karyawan::where('nama', $request->nama)->first();
        if ($existingKaryawan) {
            return redirect()->back()->withInput()->withErrors(['nama' => 'Karyawan telah terdaftar.']);
        }

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        return view('karyawan.edit', compact('karyawan'), ['key' => 'karyawan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $karyawan = Karyawan::find($id);

        $existingKaryawan = Karyawan::where('nama', $request->nama)->whereNotIn('id_karyawan', [$id])
        ->exists();
        if ($existingKaryawan) {
            return redirect()->back()->withInput()->withErrors(['nama' => 'Nama Karyawan telah terdaftar.']);
        }

        $karyawan->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
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
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus');
    }
}
