@extends('layouts.main')

@section('content')
    <title>Data Shift</title>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-pen"></i> Ubah Data Shift
        </div>
        <form method="post" action="{{ route('shift.update', $shift->id_shift) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_shift" class="col-sm-2 col-form-label">Nama Shift</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_shift" name="nama_shift"
                            value="{{ $shift->nama_shift }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jam_mulai" name="jam_mulai"
                            value="{{ $shift->jam_mulai }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jam_akhir" class="col-sm-2 col-form-label">Jam Akhir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jam_akhir" name="jam_akhir"
                            value="{{ $shift->jam_akhir }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save"></i>
                        Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"></i>
                        Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/shift'"><i
                            class="fas fa-reply"></i> Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
