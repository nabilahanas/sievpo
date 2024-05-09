@extends('layouts.main')

@section('content')
    <title>Data Berita</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="card card-successv2">
        <div class="card-header">
            <i class="fas fa-pen mr-2"></i>Ubah Data Berita
        </div>
        <form method="post" action="{{ route('berita.update', $berita->id_berita) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="tgl_publikasi" class="col-sm-3 col-form-label required">Tanggal Publikasi</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl_publikasi" name="tgl_publikasi"
                            value="{{ $berita->tgl_publikasi }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="judul" class="col-sm-3 col-form-label required">Judul Berita</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $berita->judul }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="gambar" name="gambar"
                            value="{{ $berita->gambar }}" accept="image/jpeg, image/png, image/jpg, image/svg">
                        <small class="form-text text-muted">Gambar harus bertipe: jpeg, png, jpg, atau svg</small>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="link" class="col-sm-3 col-form-label required">Link Berita</label>
                    <div class="col-sm-9">
                        <input type="url" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ $berita->deskripsi }}" required>
                        <small class="form-text text-muted">Contoh: https://example.com</small>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    {{-- <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button> --}}
                    <button type="button" class="btn btn-danger" onclick="window.location='/berita'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
