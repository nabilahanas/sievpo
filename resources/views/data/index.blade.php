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

            <div class="card-body table-responsive">
                <table id="evpo" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th colspan="44">{{ Auth::user()->nama_user ?? '' }}</th>
                        </tr>
                        <tr>
                            <th rowspan="2" style="text-align: center">Tanggal</th>

                            @foreach ($bidang as $bidang)
                                <th colspan="9" style="text-align: center">{{ $bidang->nama_bidang }}</th>
                            @endforeach

                            <th rowspan="2" style="text-align: center">Foto</th>
                            <th rowspan="2" style="text-align: center">Aksi</th>
                        </tr>
                        <tr>
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
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>

                            <td>
                                <a href="" target="_blank" rel="noopener noreferrer"></a>
                            </td>
                            <td>
                                <form action="" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
