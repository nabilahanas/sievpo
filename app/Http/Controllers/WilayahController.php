<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    // Menampilkan semua data wilayah
    public function index()
    {
        $wilayahs = DB::table('wilayah')->get();
        return view('wilayah.index', compact('wilayahs'));
    }


    // Menampilkan form untuk menambahkan data wilayah
    public function add()
    {
        return view('wilayah.add');
    }

    // Menyimpan data wilayah yang baru ditambahkan
    public function store(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Wilayah::add($request->all());

        return redirect()->route('wilayah.index')->with('success', 'Data wilayah berhasil ditambahkan.');
    }

    // Menampilkan detail suatu wilayah
    public function show(Wilayah $wilayah)
    {
        return view('wilayah.show', compact('wilayah'));
    }

    // Menampilkan form untuk mengedit data wilayah
    public function edit(Wilayah $wilayah)
    {
        return view('wilayah.edit', compact('wilayah'));
    }

    // Menyimpan perubahan pada data wilayah yang diedit
    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'nama_wilayah' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $wilayah->update($request->all());

        return redirect()->route('wilayah.index')->with('success', 'Data wilayah berhasil diperbarui.');
    }

    // Menghapus suatu data wilayah
    public function delete(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('wilayah.index')->with('success', 'Data wilayah berhasil dihapus.');
    }
}
