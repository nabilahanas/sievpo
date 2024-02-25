@extends('layouts.main')

@section('title', 'Konfirmasi Data')

@section('content')
    <title>Konfirmasi Data Eviden</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive mt-4">
                <table id="konfirm" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Shift</th>
                            <th>Lokasi</th>
                            <th>Tanggal Waktu</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="">Lihat Foto</a></td>
                            <td>
                                {{-- <div><i class="far fa-question-circle mr-2" style="color:#6c757d"></i>Tertunda</div> --}}
                                <div class="text-center">--</div>
                                <div><i class="far fa-check-circle mr-2" style="color: #28a745"></i>Diterima</div>
                                <div><i class="far fa-times-circle mr-2" style="color: #dc3545"></i>Ditolak</div>
                            </td>
                            <td>
                                {{-- BELOM FIX --}}
                                <button class="btn btn-sm btn-success"><i
                                        class="fas fa-check-circle mr-2"></i>Terima</button>
                                <button class="btn btn-sm btn-danger mb-2"><i
                                        class="fas fa-times-circle mr-2"></i>Tolak</button>

                                <br>
                                <a href="" type="button" class="btn btn-sm btn-warning"><i
                                        class="fas fa-pen mr-2"></i>Ubah</a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapusModal">
                                    <i class="fas fa-trash mr-2"></i>Hapus
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
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
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
