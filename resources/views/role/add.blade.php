@extends('layouts.main')

@section('content')

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


    <div class="card mt-4">
        <div class="card-body">

            <h5 class="card-title fw-bolder mb-3">Tambah Role</h5>

            <form method="post" action="{{ route('role.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Nama Role</label>
                    <input type="text" class="form-control" name="nama_role" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                    <a type="button" class="btn btn-danger" href="/role">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
