<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    protected $primaryKey = 'id_shift';

    public function index()
    {
        $shift = Shift::withTrashed()->get();
        return view('shift.index', compact('shift'), ['key' => 'shift']);
    }

    public function create()
    {
        return view('shift.add', ['key' => 'shift']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_shift' => 'required',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_akhir' => 'required|date_format:H:i:s',
            'poin' => 'required',
        ]);

        $data = $request->all();

        $data['jam_mulai'] = date('H:i:s', strtotime($data['jam_mulai']));
        $data['jam_akhir'] = date('H:i:s', strtotime($data['jam_akhir']));

        Shift::create($data);

        return redirect()->route('shift.index')->with('success', 'Data shift berhasil ditambahkan');
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('shift.edit', compact('shift'), ['key' => 'shift']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_shift' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
            'poin' => 'required'
        ]);

        $shift = SHift::find($id);
        $shift->update([
            'nama_shift' => $request->nama_shift,
            'jam_mulai' => $request->jam_mulai,
            'jam_akhir' => $request->jam_akhir,
            'poin' => $request->poin,
        ]);

        return redirect()->route('shift.index')->with('success', 'Data shift berhasil diubah');
    }
    
    public function restore($id)
    {
        $shift=Shift::withTrashed()->find($id);
        $shift->restore();

        return redirect()->route('shift.index')->with('success', 'Data shift berhasil ditampilkan');
    }

    public function delete($id)
    {
        $shift = Shift::find($id);
        $shift -> delete();

        return redirect()->route('shift.index')->with('success', 'Data shift berhasil disembunyikan');
    }
}
