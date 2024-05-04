@extends('layouts.main')

@section('content')
    <title>Data Karyawan</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-pen mr-2"></i>Ubah Data Karyawan
        </div>
        <form method="post" action="{{ route('karyawan.update', $karyawan->id_karyawan) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama" class="col-sm-2 col-form-label required">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama"
                            value="{{ $karyawan->nama }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jabatan" class="col-sm-2 col-form-label required">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jabatan"
                            value="{{ $karyawan->jabatan }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/karyawan'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
