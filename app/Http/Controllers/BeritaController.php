<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BeritaController extends Controller
{
    protected $primaryKey = 'id_berita';

    public function index()
    {
        $berita = Berita::all();
        $beritaDeleted = Berita::onlyTrashed()->get();

        return view('berita.index', compact('berita', 'beritaDeleted'), ['key' => 'berita']);
    }

    public function create()
    {
        return view('berita.add', ['key' => 'berita']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

        $existingBerita = Berita::where('judul', $request->judul)->exists();
        if ($existingBerita) {
            return redirect()->back()->withInput()->withErrors(['judul' => 'Berita sudah terdata.']);
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::find($id);
        return view('berita.edit', compact('berita'), ['key' => 'berita']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg', // Validate image
            'deskripsi' => 'required',
            'tgl_publikasi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $berita = Berita::find($id);

        // Update other fields
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tgl_publikasi = $request->tgl_publikasi;

        // Check if a new image is uploaded
        if ($request->hasFile('gambar') && ($gambar = $request->file('gambar'))) {
            // Delete the old image if exists
            if ($berita->gambar) {
                Storage::disk('public')->delete('gambar-berita/' . $berita->gambar);
            }

            // Upload the new image
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-berita/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            // Update the image field in the database
            $berita->gambar = $filename;
        }

        $existingBerita = Berita::where('judul', $request->judul)->whereNotIn('id_berita', [$id])
        ->exists();
        if ($existingBerita) {
            return redirect()->back()->withInput()->withErrors(['judul' => 'Judul berita sudah ada.']);
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil diubah');
    }

    public function restore($id)
    {
        $berita = Berita::onlyTrashed()->find($id);

        // Hapus gambar terkait sebelum memulihkan
        $berita->deleteImage();

        // Memulihkan model
        $berita->restore();

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dipulihkan');
    }

    public function delete($id)
    {
        $berita = Berita::find($id);

        // Hapus gambar terkait sebelum menghapus
        $berita->deleteImage();

        // Menghapus model
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dihapus');
    }

}
