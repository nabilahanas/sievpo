@extends('layouts.main')

@section('content')
    <title>Data Jabatan</title>

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
            <i class="fas fa-plus"></i> Tambah Data Jabatan
        </div>
        <form class="form-horizontal" method="post" action="{{ route('jabatan.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_jabatan" class="col-sm-2 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_jabatan" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="wilayah" class="col-sm-2 col-form-label">Pilih Wilayah</label>
                    <div class="col-sm-10">
                        <select name="wilayah" id="wilayah" class="form-control">
                            <option value="" disabled selected>Pilih Wilayah</option>
                            <option value="1">Wilayah Barat</option>
                            <option value="0">Wilayah Timur</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save"></i>
                        Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"></i>
                        Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/jabatan'"><i
                            class="fas fa-reply"></i> Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
