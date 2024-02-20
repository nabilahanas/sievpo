<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    protected $primaryKey = 'id_berita';

    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', compact('berita'), ['key' => 'berita']);
    }

    public function create()
    {
        return view('berita.add', ['key' => 'berita']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-berita/' . $filename;

            // Simpan gambar ke storage
            Storage::disk('public')->put($path, file_get_contents($gambar));

            // Simpan nama file ke dalam data
            $data['gambar'] = $filename;
        } else {
            // Jika tidak ada gambar, atur 'gambar' menjadi null atau sesuai kebutuhan
            $data['gambar'] = null;
        }

        $berita = Berita::create($data);
        echo "Data berhasil ditambahkan" . PHP_EOL;

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::find($id);
        return view('berita.edit', compact('berita'), ['key' => 'berita']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $berita = Berita::find($id);

        // Update other fields
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tgl_publikasi = $request->tgl_publikasi;

        // Check if a new image is uploaded
        if ($request->hasFile('gambar')) {
            // Delete the old image if exists
            if ($berita->gambar) {
                Storage::disk('public')->delete('gambar-berita/' . $berita->gambar);
            }

            // Upload the new image
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-berita/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            // Update the image field in the database
            $berita->gambar = $filename;
        }

        $berita->save();

        echo "Data berhasil diubah" . PHP_EOL;
        return redirect()->route('berita.index')->with('success', 'Data berita berhasil diubah');
    }

    public function delete($id)
    {
        $berita = Berita::find($id);
        $berita->delete();

        echo "Data berhasil dihapus" . PHP_EOL;

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dihapus');
    }
}
