@extends('layouts.main')

@section('content')

<h4 class="mt-0">Data Role</h4>

<a href="{{ route('role.add') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama Role</th>
        <th>Deskripsi</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($role as $role)
            <tr>
                <td>{{ $role->nama_role }}</td>
                <td>{{ $role->deskripsi }}</td>
                <td>
                    <a href="{{ route('role.edit', $role->id_role) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                    <form action="{{route('role.delete', $role->id_role)}}" method="post" class="d-inline">
                        @csrf
                        @method('POST')
                        <button class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection