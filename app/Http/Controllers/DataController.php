<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('data.add', ['key'=>'data']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_bidang' => 'required',
            'id_shift' => 'required',
            'id_lokasi' => 'required',
            'tgl_waktu' => 'required',
            'foto' => 'required',
            'is_approved' => 'required',
        ]);

        $data = $request->all();
        Data::create($data);
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
