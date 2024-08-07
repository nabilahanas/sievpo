@extends('layouts.main')

@section('content')
    <title>Data User</title>

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
            <i class="fas fa-plus mr-2"></i>Tambah Data User
        </div>
        <form class="form-horizontal" method="POST" action="/registered">
            @csrf
            <div class="card-body">
                <div class="form-group row col-12 col-md-10">
                    <label for="nama_user" class="col-sm-2 col-form-label required">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_user" class="form-control" Required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="nip" class="col-sm-2 col-form-label required">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" name="nip" class="form-control" Required autocomplete="off">
                        {{-- <small class="form-text text-danger">Gunakan kode PHT di awal NIP! Contoh: PHT1234567890</small> --}}
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="no_hp" class="col-sm-2 col-form-label required">No HP</label>
                    <div class="col-sm-10">
                        <input type="tel" name="no_hp" class="form-control" pattern="08[0-9]{8,10}"
                            title="Masukkan nomor telepon dengan format yang benar (dimulai dengan 08 dan memiliki 10 hingga 12 digit)"
                            required autocomplete="off">
                        <small class="form-text text-muted">Contoh: 08xxxxxxxxx</small>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="role" class="col-sm-2 col-form-label required">Role</label>
                    <div class="col-sm-10">
                        <select name="role" class="custom-select" Required>
                            <option value="" disabled selected>Pilih Role</option>
                            @foreach ($role as $role)
                                <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="jabatan" class="col-sm-2 col-form-label required">Jabatan</label>
                    <div class="col-sm-10">
                        <select name="jabatan" class="custom-select" Required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $jabatan)
                                <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="password" class="col-sm-2 col-form-label required">Password</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control"
                                pattern="^(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                                title="Password harus terdiri dari setidaknya 8 karakter, setidaknya satu huruf kecil dan satu huruf besar"
                                Required autocomplete="off">
                        </div>
                        <small class="form-text text-muted">Password harus terdiri dari setidaknya 8 karakter,
                            setidaknya satu huruf kecil dan satu huruf besar</small>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='/users'"><i
                            class="fas fa-reply mr-2"></i>Kembali</button>
                </div>
            </div>
        </form>
    </div>
@endsection
