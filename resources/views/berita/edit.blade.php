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
            <i class="fas fa-pen mr-2"></i>Ubah Data Berita
        </div>
        <form method="post" action="{{ route('berita.update', $berita->id_berita) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Berita</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $berita->judul }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="gambar" name="gambar"
                            value="{{ $berita->gambar }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ $berita->deskripsi }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_publikasi" name="tgl_publikasi"
                            value="{{ $berita->tgl_publikasi }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/berita'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
