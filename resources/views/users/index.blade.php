@extends('layouts.main')

@section('title', 'Data User')

@section('content')
    <title>Data User</title>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('register') }}" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="user" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
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
                                <td>{{ $user->jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($user->jabatan->wilayah == 0)
                                        Wilayah Timur
                                    @elseif($user->jabatan->wilayah == 1)
                                        Wilayah Barat
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('users.delete', $user->id_user) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash mr-2"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection