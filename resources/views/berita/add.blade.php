@extends('layouts.main')

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

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Tambah Berita</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('berita.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="id_berita" class="col-sm-2 col-form-label">ID Berita</label>
                    <div class="col-sm-10">
                        <option value=""></option>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10" name="id_berita" id="id_berita">
                        <input type="text" class="form-control" name="id_berita">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputFile">Gambar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose File</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tgl_publikasi" required>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" value="Tambah"><i
                        class="fa-solid fa-floppy-disk"></i>Simpan</button>
            </div>
        </form>
    </div>

@endsection
