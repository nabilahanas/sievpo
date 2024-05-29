<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class DataController extends Controller
{
    protected $primaryKey = 'id_data';

    public function index()
    {
        $user = Auth::user();
        $data = Data::orderBy('created_at', 'desc')->where('id_user', $user->id_user)->with('bidang', 'shift')->get();

        return view('data.index', compact('data', 'user'), ['key' => 'data']);
    }

    public function create()
    {
        $bidang = Bidang::all();
        $shift = Shift::all();

        $currentDateTime = now();
        $shift = Shift::whereTime('jam_mulai', '<=', $currentDateTime->format('H:i:s'))
            ->whereTime('jam_akhir', '>=', $currentDateTime->format('H:i:s'))
            ->first();

        return view('data.add', compact('bidang', 'shift'), ['key' => 'data']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_bidang' => 'required',
            'id_shift' => 'required',
            'lokasi' => 'required',
            'tgl_waktu' => 'required|date_format:Y-m-d H:i:s',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);
    
        $data = $request->except('tgl_waktu');
        $data['tgl_waktu'] = $request->input('tgl_waktu', now());
    
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'foto-eviden/' . $filename;
    
            Storage::disk('public')->put($path, file_get_contents($image));
    
            $data['foto'] = $filename;
    
        } else {
            $data['foto'] = null;
        }
    
        $existingData = Data::whereDate('tgl_waktu', '=', date('Y-m-d', strtotime($request->tgl_waktu)))
            ->where('id_shift', $request->id_shift)
            ->where('id_user', $request->id_user)
            ->exists();
    
    
        if ($existingData) {
            return redirect()->back()->withInput()->withErrors(['tgl_waktu' => 'Data dengan tanggal dan shift yang sama sudah ada.']);
        }
    
        Data::create($data);
    
        return redirect()->route('data.index')->with('success', 'Data berhasil ditambahkan');
    }
    

    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }
}
