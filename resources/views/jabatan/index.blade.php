@extends('layouts.main')

@section('title', 'Data Jabatan')

@section('content')
    <title>Data Jabatan</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('jabatan.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="card-body table-responsive">
                <table id="jabatan" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama Jabatan</th>
                            <th>Wilayah</th>
                            <th>Bagian</th>
                            <th>Klasifikasi</th>
                            {{-- <th>Jenjang Jabatan</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jabatan as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($jabatan->wilayah == 0)
                                        Wilayah Timur
                                    @elseif($jabatan->wilayah == 1)
                                        Wilayah Barat
                                    @endif
                                </td>
                                <td>{{ $jabatan->bagian }}</td>
                                <td>{{ $jabatan->klasifikasi }}</td>
                                {{-- <td></td> --}}
                                <td>
                                    <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" type="button"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                        <form action="{{ $jabatan->is_active ? route('jabatan.disable', $jabatan->id_jabatan) : route('jabatan.enable', $jabatan->id_jabatan) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm {{ $jabatan->is_active ? 'btn-danger' : 'btn-success' }}">
                                                <i class="{{ $jabatan->is_active ? 'fas fa-ban' : 'fas fa-check-circle' }} mr-2"></i>
                                                {{ $jabatan->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $jabatan->id_jabatan }}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button> --}}

                                    <!-- Modal -->
                                    {{-- <div class="modal fade" id="hapusModal{{ $jabatan->id_jabatan }}" tabindex="-1"
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
                                                    action="{{ route('jabatan.delete', $jabatan->id_jabatan) }}">
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
