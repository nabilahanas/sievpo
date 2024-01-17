<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    protected $primaryKey = 'id_pengumuman';

    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'gambar' => '',
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $data = $request->all();
        Pengumuman::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('pengumuman.index');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => '',
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $pengumuman = Pengumuman::find($id);
        $pengumuman->update([
            'judul' => $request -> judul,
            'gambar' => $request -> gambar,
            'deskripsi' => $request -> deskripsi,
            'tgl_publikasi' => $request -> tgl_publikasi,
        ]);
        echo "Data berhasil diubah" .PHP_EOL;
        return redirect()->route('pengumuman.index');
    }

    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('pengumuman.index');
    }
}
