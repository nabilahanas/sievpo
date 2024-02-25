@extends('layouts.main')

@section('title', 'Data Pengumuman')

@section('content')
    <title>Data Pengumuman</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('pengumuman.add') }}" type="button" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</a>

            <div class="table-responsive mt-4">
                <table id="pengumuman" class="table table-sm table-hover table-striped" style="table-layout:fixed">
                    <thead class="thead-successv2">
                        <tr>
                            <th>Tanggal Publikasi</th>
                            <th>Judul Pengumuman</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumuman as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_publikasi)->format('d-m-Y') }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/gambar-pengumuman/' . $item->gambar) }}"
                                            alt="Gambar Pengumuman" width="150">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <button onclick="window.location='{{ route('pengumuman.edit', $item->id_pengumuman) }}'"
                                        class="btn btn-sm btn-warning"><i class="fas fa-pen mr-2"></i>Ubah</button>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $item->id_pengumuman }}"><i
                                            class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{ $item->id_pengumuman }}" tabindex="-1"
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
                                                    action="{{ route('pengumuman.delete', $item->id_pengumuman) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Data pengumuman yang dihapus <b>dapat</b> dipulihkan.
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

    @if (count($pengumumanDeleted) > 0)
        <h3 class="ml-3">Riwayat Pengumuman</h3>
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover table-striped">
                    <thead class="thead-secondary">
                        <tr>
                            <th>Tanggal Publikasi</th>
                            <th>Judul Pengumuman</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumumanDeleted as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_publikasi)->format('d-m-Y') }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/gambar-pengumuman/' . $item->gambar) }}"
                                            alt="Gambar Pengumuman" width="150">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td><a href="{{ $item->deskripsi }}">Lihat Selengkapnya</a></td>
                                <td>
                                    <form action="{{ route('pengumuman.restore', $item->id_pengumuman) }}" method="POST"
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
    @endif

@endsection
