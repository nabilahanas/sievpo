@extends('layouts.main')

@section('content')
    <title>Data Jabatan</title>

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
            <i class="fas fa-pen mr-2"></i>Ubah Data Jabatan
        </div>
        <form method="post" action="{{ route('jabatan.update', $jabatan->id_jabatan) }}">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_jabatan" class="col-sm-2 col-form-label required">Nama Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                            value="{{ $jabatan->nama_jabatan }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="wilayah" class="col-sm-2 col-form-label required">Pilih Wilayah</label>
                    <div class="col-sm-10">
                        <select name="wilayah" id="wilayah" class="custom-select" required>
                            <option value="1" {{ $jabatan->wilayah ? 'selected' : '' }}>Wilayah Barat</option>
                            <option value="0" {{ !$jabatan->wilayah ? 'selected' : '' }}>Wilayah Timur</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="bagian" class="col-sm-2 col-form-label required">Bagian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bagian" name="bagian"
                            value="{{ $jabatan->bagian }}" required>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="klasifikasi" class="col-sm-2 col-form-label required">Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="klasifikasi" name="klasifikasi"
                            value="{{ $jabatan->klasifikasi }}" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    {{-- <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button> --}}
                    <button type="button" class="btn btn-danger" onclick="window.location='/jabatan'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
