@extends('layouts.main')

@section('content')
    <title>Data User</title>

    @if ($errors->any())
        <div class="alert alert-danger fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-warning" aria-hidden="true"></i></strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                    </div>
                </div>
                <div class="form-group row col-12 col-md-10">
                    <label for="no_hp" class="col-sm-2 col-form-label required">No HP</label>
                    <div class="col-sm-10">
                        <input type="tel" name="no_hp" class="form-control" pattern="[0-9]{10,12}"
                            title="Masukkan nomor telepon dengan format yang benar (minimal 10 digit dan maksimal 12 digit)"
                            Required autocomplete="off">
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
                                pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                                title="Password harus terdiri dari setidaknya 8 karakter, setidaknya satu huruf kecil, satu huruf besar, dan satu angka"
                                Required autocomplete="off">
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group row col-12 col-md-10">
                    <label for="wilayah" class="col-sm-2 col-form-label">Wilayah</label>
                    <div class="col-sm-10">
                        <input name="wilayah" id="wilayah" class="form-control">
                        @foreach ($jabatan as $jabatan)
                            <div value="{{ $jabatan->wilayah }}">{{ $jabatan->wilayah }}</div>
                        @endforeach
                    </div>
                </div> --}}
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
