@extends('layouts.page')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
    <div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Wilayah</h5>

        <form method="post" action="{{ route('wilayah.update', $wilayah->id_wilayah) }}">
            @csrf
            <div class="mb-3">
                <label for="nama_wilayah" class="form-label">Nama Wilayah:</label>
                <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah" value="{{ $wilayah->nama_wilayah }}">
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude:</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $wilayah->latitude }}">
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude:</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $wilayah->longitude }}">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Longitude:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $wilayah->deskripsi }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>

@endsection