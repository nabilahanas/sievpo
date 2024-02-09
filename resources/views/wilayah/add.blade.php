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
            <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Wilayah</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('wilayah.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_wilayah" class="col-sm-2 col-form-label">Nama Wilayah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_wilayah" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="latitude" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="longitude" required>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>
            </div>
        </form>
    </div>
@endsection
