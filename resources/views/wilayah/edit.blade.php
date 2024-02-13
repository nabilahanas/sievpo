@extends('layouts.main')

@section('content')
    <title>Data Wilayah</title>

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
            <i class="fas fa-pen mr-2"></i>Ubah Data Wilayah
        </div>
        <form method="post" action="{{ route('wilayah.update', $wilayah->id_wilayah) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_wilayah" class="col-sm-2 col-form-label">Nama Wilayah:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah"
                            value="{{ $wilayah->nama_wilayah }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="latitude" class="col-sm-2 col-form-label">Latitude:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="latitude" name="latitude"
                            value="{{ $wilayah->latitude }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="longitude" class="col-sm-2 col-form-label">Longitude:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="longitude" name="longitude"
                            value="{{ $wilayah->longitude }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Longitude:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ $wilayah->deskripsi }}">
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary mr-2"><i class="fas fa-save"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary mr-2"><i class="fas fa-redo"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/wilayah'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
