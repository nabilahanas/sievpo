@extends('layouts.main')

@section('title', 'Profil User')

@section('content')
    <title>Profil User</title>

    <div class="container-fluid">
        <div class="breadcrumb mb-4">
            <div class="breadcrumb-item active">Selamat datang, (Nama)!</div>
        </div>

        <div class="card">
            <div class="container py-5">
                <div class="row">
                    <div class="col-4">
                        <div class="card mb-4">
                            <div class="card-body text-center mt-3 mb-3">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="mt-3 mb-1">(Nama)</h5>
                                <p class="text-muted mb-1">(Level)</p>
                                <p class="text-muted mb-3">Perum Perhutani KPH Semarang</p>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-outline-danger" href="/logout" role="button">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-successv2 mt-2 ml-2"><b>Profile Account</b></h3>
                                <ul class="nav nav-tabs justify-content-end">
                                    <li class="nav-item"><a class="nav-link active" href="#info"
                                            data-toggle="tab">Personal Info</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#editfoto" data-toggle="tab">Edit
                                            Foto</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#editpass" data-toggle="tab">Edit
                                            Password</a></a></li>
                                </ul>
                            </div>
                            <div class="card-body mb-4 ml-4">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="info">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Nama</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(Nama)</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">NIP</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(NIP)</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Peran</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(Peran)</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Jabatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(Jabatan)</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Bagian</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(Bagian)</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="mb-0">Wilayah</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(Wilayah)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="editfoto">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <label>Pilih File Foto</label>
                                                    <input class="form-control" type="file" id="fileInput"
                                                        name="fileInput" accept="image/*">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <button type="button" class="btn btn-info2"><i class="fas fa-sync"></i>
                                                        Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="editpass">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password Baru</label>
                                            <input type="password" class="form-control" id="exampleInputEmail1"
                                                placeholder="Masukkan password baru">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Ulangi Password Baru</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="Masukkan password baru">
                                        </div>
                                        <div class="form-group mb-2">
                                            <button type="button" class="btn btn-info2"><i class="fas fa-sync"></i>
                                                Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
