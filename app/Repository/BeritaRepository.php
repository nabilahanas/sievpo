<?php

namespace App\Repository;

use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaRepository
{
    protected $berita;

    public function __construct(Berita $berita)
    {
        $this->berita = $berita;
    }

    public function getBerita()
    {
        return $this->berita->all();
    }

    public function getDeletedBerita()
    {
        return $this->berita->onlyTrashed()->get();
    }

    public function getById($id)
    {
        return $this->berita->find($id);
    }

    public function getStore(BeritaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-berita/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));
            $data['gambar'] = $filename;
        }

        $existingBerita = $this->berita->where('judul', $data['judul'])->exists();
        if ($existingBerita) {
            throw new \Exception('Berita sudah terdata.');
        }

        return $this->berita->create($data);
    }

    public function getUpdate(BeritaRequest $request, $id)
    {
        $berita = $this->getById($id);

        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->tgl_publikasi = $request->tgl_publikasi;

        if ($request->hasFile('gambar') && ($gambar = $request->file('gambar'))) {
            if ($berita->gambar) {
                Storage::disk('public')->delete('gambar-berita/' . $berita->gambar);
            }
            $filename = time() . '_' . $gambar->getClientOriginalName();
            $path = 'gambar-berita/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($gambar));    
            $berita->gambar = $filename;
        }

        $existingBerita = $this->berita->where('judul', $request->judul)->whereNotIn('id_berita', [$id])
        ->exists();
        if ($existingBerita) {
            throw new \Exception('Judul berita sudah ada.');
        }
        
        $berita->save();
        return $berita;
    }

    public function getDelete($id)
    {
        $berita = $this->getById($id);
        $berita->deleteImage();
        $berita->delete();
        return $berita;
    }

    public function getRestore($id)
    {
        $berita = $this->berita->onlyTrashed()->find($id);
        $berita->deleteImage();
        $berita->restore();
        return $berita;
    }
}