@extends('layouts.main')

@section('title', 'Rekap Bulanan')

@section('content')
    <title>Rekap Bulanan</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download
                Excel</a>

            <div class="table-responsive mt-4">
                <table id="bulanan" class="table table-sm text-nowrap text-hover" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th colspan="40">Agustus 2024</th>
                        </tr>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Jabatan</th>

                            @foreach ($bidang as $bidang)
                            <th colspan="9" style="text-align: center">{{ $bidang->nama_bidang }}</th>
                        @endforeach

                            <th rowspan="2">Total</th>
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
                        @foreach ($poin as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}.</th>

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
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
