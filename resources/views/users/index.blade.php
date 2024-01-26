@extends('layouts.main')

@section('content')

<h4 class="mt-5">Data User</h4>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Nama</th>
        <th>NIP</th>
        <th>No HP</th>
        <th>Role</th>
        <th>Jabatan</th>
        <th>Wilayah</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->nip }}</td>
                <td>{{ $user->no_hp }}</td>
                <td>{{ $user->role->nama_role }}</td>
                <td>{{ $user->jabatan->nama_jabatan}}</td>
                <td>
                    @if($user->jabatan->wilayah == 0) Wilayah Timur
                    @elseif($user->jabatan->wilayah == 1) Wilayah Barat
                    @endif
                </td>
                <td>

                    <form action="{{route('users.delete', $user->id_user)}}" method="post" class="d-inline">
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