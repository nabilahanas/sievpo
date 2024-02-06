<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    protected $primaryKey = 'id_berita';

    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', compact('berita'), ['key'=>'berita']);
    }

    public function create()
    {
        return view('berita.add', ['key'=>'berita']);
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
        Berita::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('berita.index');
    }

    public function edit($id)
    {
        $berita = Berita::find($id);
        return view('berita.edit', compact('berita'), ['key'=>'berita']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => '',
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $berita = Berita::find($id);
        $berita->update([
            'judul' => $request -> judul,
            'gambar' => $request -> gambar,
            'deskripsi' => $request -> deskripsi,
            'tgl_publikasi' => $request -> tgl_publikasi,
        ]);
        echo "Data berhasil diubah" .PHP_EOL;
        return redirect()->route('berita.index');
    }

    public function delete($id)
    {
        $berita = Berita::find($id);
        $berita -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;

        return redirect()->route('berita.index');
    }
}
