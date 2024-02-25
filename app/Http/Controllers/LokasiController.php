<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    protected $primaryKey = 'id_lokasi';

    public function index()
    {
        $lokasi = Lokasi::withTrashed()->get();
        return view('lokasi.index', compact('lokasi'), ['key'=>'lokasi']);
    }

    public function create()
    {
        return view('lokasi.add', ['key'=>'lokasi']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lokasi' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $data = $request->all();
        Lokasi::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil ditambahkan');
    }

    public function edit ($id)
    {
        $lokasi = Lokasi::find($id);
        return view('lokasi.edit', compact('lokasi'), ['key'=>'lokasi']);
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $lokasi = Lokasi::find($id);
        $lokasi->update([
            'nama_lokasi' => $request -> nama_lokasi,
            'latitude' => $request -> latitude,
            'longitude' => $request -> longitude,
        ]);

        echo "Data berhasil diubah" .PHP_EOL;
        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil diubah');
    }

    public function restore($id)
    {
        $lokasi=Lokasi::withTrashed()->find($id);
        $lokasi->restore();

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil ditampilkan');
    }

    public function delete($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi -> delete();

        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil disembunyikan');
    }
}