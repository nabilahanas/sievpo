@extends('layouts.main')

@section('content')
    <title>Data Shift</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-pen mr-2"></i>Ubah Data Shift
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
                <div class="form-group row col-12 col-md-10">
                    <label for="poin" class="col-sm-2 col-form-label">Poin</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="poin" value="1" min="1"
                            max="10" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/shift'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
