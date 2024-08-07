@extends('layouts.main')

@section('title', 'Data User')

@section('content')
    <title>Data User</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-check-circle mr-2" aria-hidden="true"></i></strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('register') }}" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="user" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>No. HP</th>
                            <th>Peran</th>
                            <th>Jabatan</th>
                            <th>Wilayah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>{{ $user->role->nama_role }}</td>
                                <td>{{ $user->jabatan->nama_jabatan ?? '' }}</td>
                                <td>
                                    @if ($user->jabatan)
                                        @if ($user->jabatan->wilayah == 0)
                                            Wilayah Timur
                                        @elseif($user->jabatan->wilayah == 1)
                                            Wilayah Barat
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <button onclick="window.location='{{ route('users.edit', $user->id_user) }}'"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $user->id_user }}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{ $user->id_user }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="hapusModalLabel">Konfirmasi</h4>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('users.delete', $user->id_user) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Data user yang dihapus <b>dapat</b> dipulihkan.
                                                        <br>Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Yakin</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (count($usersDeleted) > 0)
        <h3 class="ml-3">Riwayat Data User</h3>
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table id="ruser" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-secondary">
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>No. HP</th>
                            <th>Peran</th>
                            <th>Jabatan</th>
                            <th>Wilayah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersDeleted as $item)
                            <tr>
                                <td>{{ $item->nama_user }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->role->nama_role }}</td>
                                <td>{{ $item->jabatan->nama_jabatan ?? '' }}</td>
                                <td>
                                    @if ($item->jabatan)
                                        @if ($item->jabatan->wilayah == 0)
                                            Wilayah Timur
                                        @elseif($item->jabatan->wilayah == 1)
                                            Wilayah Barat
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('users.restore', $item->id_user) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-trash-restore mr-2"></i>Pulihkan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    @endif
@endsection
