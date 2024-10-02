<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use App\Repository\BeritaRepository;

class BeritaController extends Controller
{
    protected $beritaRepository;

    public function __construct(BeritaRepository $beritaRepository)
    {
        $this->beritaRepository = $beritaRepository;
    }

    public function index()
    {
        $berita = $this->beritaRepository->getBerita();
        $beritaDeleted = $this->beritaRepository->getDeletedBerita();

        return request()->ajax()
            ? $this->beritaRepository->getBerita()
            : view('berita.index', compact('berita', 'beritaDeleted'), ['key' => 'berita']);
    }

    public function create()
    {
        return view('berita.add', ['key' => 'berita']);
    }

    public function store(BeritaRequest $request)
    {
        $berita = $this->beritaRepository->getStore($request);
        return $request->ajax() || $request->wantsJson()
            ? $this->apiResponseSuccess($berita)
            : redirect()->route('berita.index')->with('success', 'Data berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = $this->beritaRepository->getById($id);
        return view('berita.edit', compact('berita'), ['key' => 'berita']);
    }

    public function update(BeritaRequest $request, $id)
    {
        $berita = $this->beritaRepository->getUpdate($request, $id);

        return $request->ajax() || $request->wantsJson()
            ? $this->apiResponseSuccess($berita)
            : redirect()->route('berita.index')->with('success', 'Data berita berhasil diubah');
    }

    public function restore($id)
    {
        $this->beritaRepository->getRestore($id);
        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dipulihkan');
    }

    public function delete($id)
    {
        $this->beritaRepository->getDelete($id);
        return redirect()->route('berita.index')->with('success', 'Data berita berhasil dihapus');
    }

}
