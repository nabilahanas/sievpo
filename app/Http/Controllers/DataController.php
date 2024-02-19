<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\Shift;
use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $data = Data::all();
        return view('data.index', compact('data'), ['key'=>'data']);
    }

    public function create()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $formattedDateTime = now()->format('Y-m-d H:i:s');

        return view('data.add', compact('bidang', 'shift', 'lokasi', 'formattedDateTime'), ['key'=>'data']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_bidang' => 'required',
            'id_shift' => 'required',
            'id_lokasi' => 'required',
            'tgl_waktu' => 'required|date_format:Y-m-d H:i:s',
            'foto' => 'required',
            'is_approved' => 'required',
        ]);

        $data = $request->all(); //data diambil dari form

        Data::create($data); //data disimpan
        echo "Data berhasil ditambahkan" .PHP_EOL;

        return redirect()->route('data.index');
    }


    public function delete($id)
    {
        $data = Data::find($id);
        $data -> delete();

        echo "Data berhasil dihapus" .PHP_EOL;
        return redirect()->route('data.index');
    }
}
