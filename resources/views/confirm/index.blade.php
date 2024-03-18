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
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->users->nama_user }}</td>
                                <td>{{ $item->bidang->nama_bidang }}</td>
                                <td>{{ $item->shift->nama_shift }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#fotoModal{{$item->id_data}}">
                                        <img src="{{ $item->foto ? asset('storage/foto-eviden/' . $item->foto) : '' }}"
                                            alt="Foto Eviden" width="150">
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="fotoModal{{$item->id_data}}" tabindex="-1" aria-labelledby="fotoModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img src="{{ $item->foto ? asset('storage/foto-eviden/' . $item->foto) : '' }}"
                                                        alt="Foto Eviden" width="400">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">Nama</th>
                                                                <td>$250.30</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Waktu</th>
                                                                <td>$10.34</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Dimensi</th>
                                                                <td>$5.80</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Ukuran</th>
                                                                <td>$265.24</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Perangkat</th>
                                                                <td>$265.24</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>           
                                </td>
                                <td>
                                    @if ($item->is_approved === 'pending')
                                        <div><i class="far fa-clock mr-2" style="color: #FFD43B;"></i>Diproses</div>
                                    @elseif($item->is_approved === 'approved')
                                        <div><i class="far fa-check-circle mr-2" style="color: #28a745"></i>Diterima</div>
                                    @elseif($item->is_approved === 'rejected')
                                        <div><i class="far fa-times-circle mr-2" style="color: #dc3545"></i>Ditolak</div>
                                    @endif
                                </td>
                                <td>{{ $item->poin }}</td>
                                <td>
                                    <form
                                        action="{{ route('approval.process', ['id' => $item->id_data, 'status' => 'approved']) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-block mb-2" {{ $item->is_approved !== 'pending' ? 'disabled' : '' }}>
                                            <i class="fas fa-check-circle mr-2"></i>Terima
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('approval.process', ['id' => $item->id_data, 'status' => 'rejected']) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary btn-block mb-2" {{ $item->is_approved !== 'pending' ? 'disabled' : '' }}>
                                            <i class="fas fa-times-circle mr-2"></i>Tolak
                                        </button>
                                    </form>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger btn-block mb-2"
                                        data-bs-toggle="modal" data-bs-target="#hapusModal{{$item->id_data}}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{$item->id_data}}" tabindex="-1" aria-labelledby="hapusModalLabel"
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
                                                <form method="POST" action="{{ route('data.delete', $item->id_data) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Data yang dihapus <b>tidak dapat</b> dipulihkan.
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

@endsection
