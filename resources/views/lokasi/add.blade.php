@extends('layouts.main')

@section('content')
    <title>Data Lokasi</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data Lokasi
        </div>
        <form class="form-horizontal" method="post" action="{{ route('lokasi.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_lokasi" class="col-sm-2 col-form-label required">Nama Lokasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_lokasi" required>
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
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/lokasi'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
