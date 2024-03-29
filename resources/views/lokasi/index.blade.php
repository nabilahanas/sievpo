@extends('layouts.main')

@section('title', 'Data Lokasi')

@section('content')
    <title>Data Lokasi</title>

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
            <a href="{{ route('lokasi.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="lokasi" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasi as $lokasi)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $lokasi->nama_lokasi }}</td>
                                <td>{{ $lokasi->latitude }}</td>
                                <td>{{ $lokasi->longitude }}</td>
                                <td>
                                    <a href="{{ route('lokasi.edit', $lokasi->id_lokasi) }}" type="button"
                                        class="btn btn-sm btn-warning rounded-3"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                        <form action="{{ $lokasi->trashed() ? route('lokasi.restore', $lokasi->id_lokasi) : route('lokasi.delete', $lokasi->id_lokasi) }}"
                                            method="post" class="d-inline">
                                          @csrf
                                          @method($lokasi->trashed() ? 'POST' : 'DELETE')
                                          <button type="submit"
                                                  class="btn btn-sm {{ $lokasi->trashed() ? 'btn-success' : 'btn-danger' }}">
                                              <i class="{{ $lokasi->trashed() ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                              {{ $lokasi->trashed() ? 'Aktifkan' : 'Nonaktifkan' }}
                                          </button>
                                      </form>

                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $lokasi->id_lokasi }}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{ $lokasi->id_lokasi }}" tabindex="-1"
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
                                                <form method="POST"
                                                    action="{{ route('lokasi.delete', $lokasi->id_lokasi) }}">
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
