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
                        @foreach($items as $idUser => $userItems)
                            @foreach($userItems as $item)
                                <tr>
                                    <th scope="row">{{ $loop->parent->iteration }}.</th> <!-- Menggunakan $loop->parent->iteration untuk mendapatkan nomor iterasi dari loop yang lebih tinggi -->
                                    <td>{{ $item->data->user->nama_user }}</td>
                                    <td>{{ $item->data->user->jabatan->nama_jabatan }}</td>
                                    {{-- <td></td> --}}

                            <td>{{ $totals['poin_1_11'] }}</td>
                            <td>{{ $totals['poin_1_12'] }}</td>
                            <td>{{ $totals['poin_1_13'] }}</td>
                            <td>{{ $totals['poin_1_14'] }}</td>
                            <td>{{ $totals['poin_1_15'] }}</td>
                            <td>{{ $totals['poin_1_16'] }}</td>
                            <td>{{ $totals['poin_1_17'] }}</td>
                            <td>{{ $totals['poin_1_18'] }}</td>
                            <td><?php
                                // menjumlahkan poin
                                $tb1 = $totals['poin_1_11'] + $totals['poin_1_12'] + $totals['poin_1_13'] + $totals['poin_1_14'] +
                                $totals['poin_1_15'] + $totals['poin_1_16'] + $totals['poin_1_17'] + $totals['poin_1_18'];
                                ?>
                                {{ $tb1 }}</td>

                            <td>{{ $totals['poin_2_11'] }}</td>
                            <td>{{ $totals['poin_2_12'] }}</td>
                            <td>{{ $totals['poin_2_13'] }}</td>
                            <td>{{ $totals['poin_2_14'] }}</td>
                            <td>{{ $totals['poin_2_15'] }}</td>
                            <td>{{ $totals['poin_2_16'] }}</td>
                            <td>{{ $totals['poin_2_17'] }}</td>
                            <td>{{ $totals['poin_2_18'] }}</td>
                            <td><?php
                                // menjumlahkan poin
                                $tb2 = $totals['poin_2_11'] + $totals['poin_2_12'] + $totals['poin_2_13'] + $totals['poin_2_14'] +
                                $totals['poin_2_15'] + $totals['poin_2_16'] + $totals['poin_2_17'] + $totals['poin_2_18'];
                                ?>
                                {{ $tb2 }}</td>

                            <td>{{ $totals['poin_3_11'] }}</td>
                            <td>{{ $totals['poin_3_12'] }}</td>
                            <td>{{ $totals['poin_3_13'] }}</td>
                            <td>{{ $totals['poin_3_14'] }}</td>
                            <td>{{ $totals['poin_3_15'] }}</td>
                            <td>{{ $totals['poin_3_16'] }}</td>
                            <td>{{ $totals['poin_3_17'] }}</td>
                            <td>{{ $totals['poin_3_18'] }}</td>
                            <td><?php
                                // menjumlahkan poin
                                $tb3 = $totals['poin_3_11'] + $totals['poin_3_12'] + $totals['poin_3_13'] + $totals['poin_3_14'] +
                                $totals['poin_3_15'] + $totals['poin_3_16'] + $totals['poin_3_17'] + $totals['poin_3_18'];
                                ?>
                                {{ $tb3 }}</td>

                            <td>{{ $totals['poin_4_11'] }}</td>
                            <td>{{ $totals['poin_4_12'] }}</td>
                            <td>{{ $totals['poin_4_13'] }}</td>
                            <td>{{ $totals['poin_4_14'] }}</td>
                            <td>{{ $totals['poin_4_15'] }}</td>
                            <td>{{ $totals['poin_4_16'] }}</td>
                            <td>{{ $totals['poin_4_17'] }}</td>
                            <td>{{ $totals['poin_4_18'] }}</td>
                            <td><?php
                                // menjumlahkan poin
                                $tb4 = $totals['poin_4_11'] + $totals['poin_4_12'] + $totals['poin_4_13'] + $totals['poin_4_14'] +
                                $totals['poin_4_15'] + $totals['poin_4_16'] + $totals['poin_4_17'] + $totals['poin_4_18'];
                                ?>
                                {{ $tb4 }}</td>

                            <td></td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
