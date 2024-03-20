@extends('layouts.main')

@section('title', 'Data Laporan Eviden')

@section('content')
    <title>Data Laporan Eviden</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <button onclick="window.location='{{ route('data.add') }}'" class="btn btn-primary"><i
                    class="fas fa-plus mr-2"></i>Tambah</button>

            <div class="table-responsive mt-4">
                <table id="evpo" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th colspan="9">{{ Auth::user()->nama_user ?? '' }}</th>
                        </tr>
                        <tr>
                            <th style="text-align: center">Tanggal Laporan</th>

                            {{-- @foreach ($bidang as $bidang)
                                <th colspan="9" style="text-align: center">{{ $bidang->nama_bidang }}</th>
                            @endforeach --}}
                            <th style="text-align: center">Bidang</th>
                            <th style="text-align: center">Shift</th>
                            {{-- <th rowspan="2" style="text-align: center">Total Poin</th> --}}
                            {{-- <th rowspan="2" style="text-align: center">Shift</th> --}}
                            <th style="text-align: center">Lokasi</th>
                            <th style="text-align: center">Foto</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Poin</th>
                            <th style="text-align: center">Tanggal Konfirmasi</th>
                            {{-- <th rowspan="2" style="text-align: center">Oleh</th> --}}
                            <th style="text-align: center">Aksi</th>
                        </tr>
                        {{-- <tr>
                            @foreach ($shift as $s)
                                <th>{{ $s->nama_shift }}</th>
                            @endforeach
                            <th>Jml</th>

                            @foreach ($shift as $s)
                                <th>{{ $s->nama_shift }}</th>
                            @endforeach
                            <th>Jml</th>

                            @foreach ($shift as $s)
                                <th>{{ $s->nama_shift }}</th>
                            @endforeach
                            <th>Jml</th>

                            @foreach ($shift as $s)
                                <th>{{ $s->nama_shift }}</th>
                            @endforeach
                            <th>Jml</th>
                        </tr> --}}

                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                
                                <td>{{ $item->bidang->nama_bidang}}</td>

                                <td>{{ $item->shift->nama_shift }}</td>

                                

                                {{-- <td>{{$item->poin_1_11}}</td>
                                <td>{{$item->poin_1_12}}</td>
                                <td>{{$item->poin_1_13}}</td>
                                <td>{{$item->poin_1_14}}</td>
                                <td>{{$item->poin_1_15}}</td>
                                <td>{{$item->poin_1_16}}</td>
                                <td>{{$item->poin_1_17}}</td>
                                <td>{{$item->poin_1_18}}</td>

                                <td></td>

                                <td>{{$item->poin_2_11}}</td>
                                <td>{{$item->poin_2_12}}</td>
                                <td>{{$item->poin_2_13}}</td>
                                <td>{{$item->poin_2_14}}</td>
                                <td>{{$item->poin_2_15}}</td>
                                <td>{{$item->poin_2_16}}</td>
                                <td>{{$item->poin_2_17}}</td>
                                <td>{{$item->poin_2_18}}</td>

                                <td></td>

                                <td>{{$item->poin_3_11}}</td>
                                <td>{{$item->poin_3_12}}</td>
                                <td>{{$item->poin_3_13}}</td>
                                <td>{{$item->poin_3_14}}</td>
                                <td>{{$item->poin_3_15}}</td>
                                <td>{{$item->poin_3_16}}</td>
                                <td>{{$item->poin_3_17}}</td>
                                <td>{{$item->poin_3_18}}</td>

                                <td></td>

                                <td>{{$item->poin_4_11}}</td>
                                <td>{{$item->poin_4_12}}</td>
                                <td>{{$item->poin_4_13}}</td>
                                <td>{{$item->poin_4_14}}</td>
                                <td>{{$item->poin_4_15}}</td>
                                <td>{{$item->poin_4_16}}</td>
                                <td>{{$item->poin_4_17}}</td>
                                <td>{{$item->poin_4_18}}</td> --}}

                                {{-- <td></td> --}}

                                {{-- <td></td> --}}
                                {{-- <td>{{ $item->shift->nama_shift }}</td> --}}
                                <td>{{ $item->lokasi }}</td>
                                {{-- <td>
                                    <a href="javascript:void(0);" onclick="showFoto('{{ asset('storage/foto-eviden/' . $item->foto) }}')">
                                        Lihat Foto
                                    </a>
                                    <img id="fotoPreview" src="" alt="Foto Eviden" width="150" style="display:none;">
                                </td>
                                
                                <script>
                                    function showFoto(src) {
                                        var fotoPreview = document.getElementById('fotoPreview');
                                        fotoPreview.src = src;
                                        fotoPreview.style.display = 'block';
                                    }
                                </script>                                 --}}

                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#fotoModal{{$item->id_data}}">
                                        Lihat Foto
                                    </a>
                                    <div class="modal fade" id="fotoModal{{$item->id_data}}" tabindex="-1" aria-labelledby="fotoModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body d-flex justify-content-center">
                                                    <img src="{{ $item->foto ? asset('storage/foto-eviden/' . $item->foto) : '' }}"
                                                        alt="Foto Eviden" width="700" class="img-fluid">
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
                                        <div><i class="far fa-clock mr-2" style="color: #FFD43B;"></i>Ditunda</div>
                                    @elseif($item->is_approved === 'approved')
                                        <div><i class="far fa-check-circle mr-2" style="color: #28a745"></i>Diterima</div>
                                    @elseif($item->is_approved === 'rejected')
                                        <div><i class="far fa-times-circle mr-2" style="color: #dc3545"></i>Ditolak</div>
                                    @endif
                                </td>
                                <td>{{ $item->poin }}</td>
                                <td>{{ $item->updated_at }}</td>
                                {{-- <td></td> --}}
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{$item->id_data}}" {{ $item->is_approved !== 'pending' ? 'disabled' : '' }}>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
