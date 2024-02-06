@extends('layouts.main')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
    <div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Role</h5>

        <form method="post" action="{{ route('role.update', $role->id_role) }}">
            @csrf
            <div class="mb-3">
                <label for="nama_role" class="form-label">Nama Role</label>
                <input type="text" class="form-control" id="nama_role" name="nama_role" value="{{ $role->nama_role }}" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $role->deskripsi }}" required>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
                <a type="button" class="btn btn-danger" href="/role">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection