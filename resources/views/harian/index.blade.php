@extends('layouts.main')

@section('title', 'Rekap Harian')

@section('content')
    <title>Rekap Harian</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download Excel</a>
            <div class="table-responsive mt-4">
                <table id="harian" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Wilayah</th>
                            <th rowspan="2">Jabatan</th>

                            @foreach ($bidang as $bidang)
                                <th colspan="9" style="text-align: center">{{ $bidang->nama_bidang }}</th>
                            @endforeach
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
                                {{-- <th>.</th> --}}
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->data->users->nama_user }}</td>
                                <td></td>
                                <td>{{ $item->data->users->jabatan->nama_jabatan}}</td>
                                {{-- <td></td> --}}

                                <td>{{ $item->poin_1_11 }}</td>
                                <td>{{ $item->poin_1_12 }}</td>
                                <td>{{ $item->poin_1_13 }}</td>
                                <td>{{ $item->poin_1_14 }}</td>
                                <td>{{ $item->poin_1_15 }}</td>
                                <td>{{ $item->poin_1_16 }}</td>
                                <td>{{ $item->poin_1_17 }}</td>
                                <td>{{ $item->poin_1_18 }}</td>
                                <td>
                                    <?php
                                    // menjumlahkan poin
                                    $totalbidang1 = $item->poin_1_11 + $item->poin_1_12 + $item->poin_1_13 + $item->poin_1_14 +
                                                 $item->poin_1_15 + $item->poin_1_16 + $item->poin_1_17 + $item->poin_1_18;
                                    ?>
                                    {{ $totalbidang1 }}
                                </td>

                                <td>{{ $item->poin_2_11 }}</td>
                                <td>{{ $item->poin_2_12 }}</td>
                                <td>{{ $item->poin_2_13 }}</td>
                                <td>{{ $item->poin_2_14 }}</td>
                                <td>{{ $item->poin_2_15 }}</td>
                                <td>{{ $item->poin_2_16 }}</td>
                                <td>{{ $item->poin_2_17 }}</td>
                                <td>{{ $item->poin_2_18 }}</td>
                                <td>
                                    <?php
                                    // menjumlahkan poin
                                    $totalbidang2 = $item->poin_2_11 + $item->poin_2_12 + $item->poin_2_13 + $item->poin_2_14 +
                                                 $item->poin_2_15 + $item->poin_2_16 + $item->poin_2_17 + $item->poin_2_18;
                                    ?>
                                    {{ $totalbidang2 }}
                                </td>

                                <td>{{ $item->poin_3_11 }}</td>
                                <td>{{ $item->poin_3_12 }}</td>
                                <td>{{ $item->poin_3_13 }}</td>
                                <td>{{ $item->poin_3_14 }}</td>
                                <td>{{ $item->poin_3_15 }}</td>
                                <td>{{ $item->poin_3_16 }}</td>
                                <td>{{ $item->poin_3_17 }}</td>
                                <td>{{ $item->poin_3_18 }}</td>
                                <td>
                                    <?php
                                    // menjumlahkan poin
                                    $totalbidang3 = $item->poin_3_11 + $item->poin_3_12 + $item->poin_3_13 + $item->poin_3_14 +
                                                 $item->poin_3_15 + $item->poin_3_16 + $item->poin_3_17 + $item->poin_3_18;
                                    ?>
                                    {{ $totalbidang3 }}
                                </td>

                                <td>{{ $item->poin_4_11 }}</td>
                                <td>{{ $item->poin_4_12 }}</td>
                                <td>{{ $item->poin_4_13 }}</td>
                                <td>{{ $item->poin_4_14 }}</td>
                                <td>{{ $item->poin_4_15 }}</td>
                                <td>{{ $item->poin_4_16 }}</td>
                                <td>{{ $item->poin_4_17 }}</td>
                                <td>{{ $item->poin_4_18 }}</td>
                                <td>
                                    <?php
                                    // menjumlahkan poin
                                    $totalbidang4 = $item->poin_4_11 + $item->poin_4_12 + $item->poin_4_13 + $item->poin_4_14 +
                                                 $item->poin_4_15 + $item->poin_4_16 + $item->poin_4_17 + $item->poin_4_18;
                                    ?>
                                    {{ $totalbidang4 }}
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
