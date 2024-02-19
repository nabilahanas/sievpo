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
            <i class="fas fa-plus mr-2"></i>Tambah Data Wilayah
        </div>
        <form class="form-horizontal" method="post" action="{{ route('wilayah.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_wilayah" class="col-sm-2 col-form-label required">Nama Wilayah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_wilayah" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="latitude" class="col-sm-2 col-form-label required">Latitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="latitude" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="longitude" class="col-sm-2 col-form-label required">Longitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label required">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/wilayah'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection