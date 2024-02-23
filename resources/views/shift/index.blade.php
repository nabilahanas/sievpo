@extends('layouts.main')

@section('title', 'Data Shift')

@section('content')
    <title>Data Shift</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('shift.add') }}" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="card-body table-responsive">
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
                                              <i class="{{ $shift->trashed() ? 'fas fa-check-circle' : 'fas fa-trash' }} mr-2"></i>
                                              {{ $shift->trashed() ? 'Restore' : 'Soft Delete' }}
                                          </button>
                                      </form>

                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $shift->id_shift }}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{ $shift->id_shift }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('shift.delete', $shift->id_shift) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Yakin</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
