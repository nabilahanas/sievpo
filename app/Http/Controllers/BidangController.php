<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidang;

class BidangController extends Controller
{
    protected $primaryKey = 'id_bidang';

    public function index()
    {
        $bidang = Bidang::all();
        return view('bidang.index', compact('bidang'), ['key'=>'bidang']);
    }

    public function create()
    {
        return view('bidang.add', ['key'=>'bidang']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_bidang' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();
        Bidang::create($data);
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('bidang.index')->with('success', 'Data bidang berhasil ditambahkan');
    }

    public function edit ($id)
    {
        $bidang = Bidang::find($id);
        return view('bidang.edit', compact('bidang'), ['key'=>'bidang']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'deskripsi' => 'required',
        ]);

        $bidang = Bidang::find($id);
        $bidang->update([
            'nama_bidang' => $request -> nama_bidang,
            'deskripsi' => $request -> deskripsi,
        ]);
        echo "Data berhasil diubah" .PHP_EOL;
        return redirect()->route('bidang.index')->with('success', 'Data bidang berhasil diubah');
    }

    public function disable($id)
    {
        $bidang = Bidang::find($id);
        if (!$bidang) {
            return redirect()->route('bidang.index')->with('error', 'Data bidang tidak ditemukan');
        }

        $bidang->update(['is_active' => false]);

        return redirect()->route('bidang.index')->with('success', 'Data bidang berhasil dinonaktifkan');
    }

    public function enable($id)
    {
        $bidang = Bidang::find($id);
        if (!$bidang) {
            return redirect()->route('bidang.index')->with('error', 'Data bidang tidak ditemukan');
        }

        $bidang->update(['is_active' => true]);

        return redirect()->route('bidang.index')->with('success', 'Data bidang berhasil diaktifkan');
    }

    // public function delete($id)
    // {
    //     $bidang = Bidang::find($id);
    //     $bidang -> delete();
        
    //     echo "Data berhasil dihapus" .PHP_EOL;

    //     return redirect()->route('bidang.index')->with('success', 'Data bidang berhasil dihapus');
    // }
}
