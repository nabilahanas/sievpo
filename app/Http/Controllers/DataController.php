<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\Shift;
use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();
        $data = Data::all();

        return view('data.index', compact('bidang', 'shift', 'data'), ['key' => 'data']);
    }

    public function create()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $currentDateTime = now();
        $shift = Shift::whereTime('jam_mulai', '<=', $currentDateTime->format('H:i:s'))
            ->whereTime('jam_akhir', '>=', $currentDateTime->format('H:i:s'))
            ->first();

        return view('data.add', compact('bidang', 'shift', 'lokasi'), ['key' => 'data']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_bidang' => 'required',
            'id_shift' => 'required',
            'lokasi' => 'required',
            'tgl_waktu' => 'required|date_format:Y-m-d H:i:s',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'is_approved' => 'required|in:approved,rejected',
        ]);

        $request->merge(['is_approved' => 'pending']);

        // Mengisi nilai default tgl_waktu dengan waktu saat ini jika tidak ada yang diinput
        $data = $request->except('tgl_waktu');
        $data['tgl_waktu'] = $request->input('tgl_waktu', now());

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'foto-eviden/' . $filename;

            // Simpan gambar ke storage
            Storage::disk('public')->put($path, file_get_contents($image));

            // Simpan nama file ke dalam data
            $data['foto'] = $filename;
        } else {
            // Jika tidak ada gambar, atur 'gambar' menjadi null atau sesuai kebutuhan
            $data['foto'] = null;
        }

        Data::create($data); //data disimpan

        return redirect()->route('data.index')->with('success', 'Data berhasil ditambahkan');
    }


    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }
}
