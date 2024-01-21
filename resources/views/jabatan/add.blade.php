@extends('layouts.page')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">

            <h5 class="card-title fw-bolder mb-3">Tambah Jabatan</h5>

            <form method="post" action="{{ route('jabatan.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control" name="nama_jabatan" required>
                </div>
                <div class="mb-3">
                    <label for="wilayah">Pilih Wilayah</label>
                    <select name="wilayah" id="wilayah" class="form-control">
                        <option value="" disabled selected>Pilih Wilayah</option>
                        <option value="1">Wilayah Barat</option>
                        <option value="0">Wilayah Timur</option>
                    </select>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                    <a type="button" class="btn btn-danger" href="/jabatan">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
