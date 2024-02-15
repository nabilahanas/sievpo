<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    protected $primaryKey = 'id_pengumuman';

    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pengumuman.index', compact('pengumuman'), ['key'=>'pengumuman']);
    }

    public function create()
    {
        return view('pengumuman.add', ['key'=>'pengumuman']);
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
            $path = 'gambar-pengumuman/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            $data['gambar'] = $filename;
        } else {
            $data['gambar'] = null;
        }

        $pengumuman = Pengumuman::create($data);
        echo "Data berhasil ditambahkan" . PHP_EOL;

        return redirect()->route('pengumuman.index');

    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);
        return view('pengumuman.edit', compact('pengumuman'), ['key'=>'pengumuman']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        $pengumuman = Pengumuman::find($id);

        $pengumuman->judul = $request->judul;
        $pengumuman->deskripsi = $request->deskripsi;
        $pengumuman->tgl_publikasi = $request->tgl_publikasi;

        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete('gambar-pengumuman/' . $pengumuman->gambar);
            }

            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-pengumuman/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            $pengumuman->gambar = $filename;
        }

        $pengumuman->save();

        echo "Data berhasil diubah" . PHP_EOL;
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
