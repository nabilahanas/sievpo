<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wilayah;

class WilayahController extends Controller
{
    protected $primaryKey = 'id_wilayah';

    // Menampilkan semua data wilayah
    public function index()
    {
        $wilayah = Wilayah::all();
        return view('wilayah.index', compact('wilayah'));
    }


    // Menampilkan form untuk menambahkan data wilayah
    public function create()
    {
        return view('wilayah.add');
    }

    // Menyimpan data wilayah yang baru ditambahkan
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_wilayah' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();
        Wilayah::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('wilayah.index');
    }

    // Menampilkan detail suatu wilayah
    // public function show(Wilayah $wilayah)
    // {
    //     return view('wilayah.show', compact('wilayah'));
    // }

    // Menampilkan form untuk mengedit data wilayah
    public function edit($id)
    {
        $wilayah = Wilayah::find($id);
        return view('wilayah.edit', compact('wilayah'));
    }

    // Menyimpan perubahan pada data wilayah yang diedit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wilayah' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
        ]);

        $wilayah = Wilayah::find($id);
        $wilayah->update([
            'nama_wilayah' => $request -> nama_wilayah,
            'latitude' => $request -> latitude,
            'longitude' => $request -> longitude,
            'deskripsi' => $request -> deskripsi,
        ]);
        echo "Data berhasil diubah" .PHP_EOL;
        return redirect()->route('wilayah.index');
    }

    // Menghapus suatu data wilayah
    public function delete($id)
    {
        $wilayah = Wilayah::find($id);
        $wilayah -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('wilayah.index');
    }
}
