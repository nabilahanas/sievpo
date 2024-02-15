@extends('layouts.main')

@section('content')
    <title>Data Berita</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data Berita
        </div>
        <form class="form-horizontal" method="post" action="{{ route('berita.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="id_berita" class="col-sm-2 col-form-label">ID Berita</label>
                    <div class="col-sm-10">
                        <select class="form-control" disabled>
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan Judul Berita"
                            required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="fileInput" name="gambar" accept="image/*"
                            >
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Berita" required></textarea>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_publikasi" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/berita'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection