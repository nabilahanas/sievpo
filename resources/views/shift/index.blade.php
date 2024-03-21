@extends('layouts.main')

@section('title', 'Data Shift')

@section('content')
    <title>Data Shift</title>

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
            <a href="{{ route('shift.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="shift" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Shift</th>
                            <th>Jam Mulai</th>
                            <th>Jam Akhir</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shift as $shift)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $shift->nama_shift }}</td>
                                <td>{{ $shift->jam_mulai }}</td>
                                <td>{{ $shift->jam_akhir }}</td>
                                <td>{{ $shift->poin }}</td>
                                <td>
                                    <a href="{{ route('shift.edit', $shift->id_shift) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                        <form action="{{ $shift->trashed() ? route('shift.restore', $shift->id_shift) : route('shift.delete', $shift->id_shift) }}"
                                            method="post" class="d-inline">
                                          @csrf
                                          @method($shift->trashed() ? 'POST' : 'DELETE')
                                          <button type="submit"
                                                  class="btn btn-sm {{ $shift->trashed() ? 'btn-success' : 'btn-danger' }}">
                                              <i class="{{ $shift->trashed() ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                              {{ $shift->trashed() ? 'Aktifkan' : 'Nonaktifkan' }}
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
