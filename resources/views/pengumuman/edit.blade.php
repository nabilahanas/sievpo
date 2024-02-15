@extends('layouts.main')

@section('content')
    <title>Data Pengumuman</title>

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
            <i class="fas fa-pen mr-2"></i>Ubah Data Pengumuman
        </div>
        <form method="post" action="{{ route('pengumuman.update', $pengumuman->id_pengumuman) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Pengumuman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $pengumuman->judul }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="gambar" name="gambar"
                            value="{{ $pengumuman->gambar }}">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                value="{{ $pengumuman->deskripsi }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_publikasi" name="tgl_publikasi"
                            value="{{ $pengumuman->tgl_publikasi }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/pengumuman'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection