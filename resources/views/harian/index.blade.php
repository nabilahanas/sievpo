@extends('layouts.main')

@section('title', 'Rekap Harian')

@section('content')
    <title>Rekap Harian</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download Excel</a>
            <div class="table-responsive-lg mt-4">
                <table id="harian" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">

                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="3">Nama</th>
                            <th rowspan="3">Jabatan</th>
                            <th rowspan="3">Wilayah</th>
                            <th colspan="36" class="text-center">{{ $currentDate }}</th>
                            <th rowspan="3">Total</th>
                        </tr>
                        <tr>
                            @foreach ($bidang as $b)
                                <th colspan="{{ count($shifts) + 1 }}" class="text-center">{{ $b->nama_bidang }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($bidang as $b)
                                @foreach ($shifts as $shift)
                                    <th>{{ $shift->nama_shift }}</th>
                                @endforeach
                                <th>Jml</th>
                            @endforeach
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $total = 0;
                            @endphp
                            <tr>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($user->jabatan->wilayah == 0)
                                        WILAYAH TIMUR
                                    @elseif($user->jabatan->wilayah == 1)
                                        WILAYAH BARAT
                                    @endif
                                </td>
                                @foreach ($bidang as $b)
                                    @php
                                        $jml = 0;
                                    @endphp
                                    @foreach ($shifts as $shift)
                                        <td>
                                            @php
                                                $searchDate = request()->has('search')
                                                    ? Carbon\Carbon::parse(request()->search)->startOfDay()
                                                    : Carbon\Carbon::now()->startOfDay();
                                                $poin = isset(
                                                    $data[$user->id_user][$searchDate->format('Y-m-d')][$b->id_bidang][
                                                        $shift->id_shift
                                                    ],
                                                )
                                                    ? $data[$user->id_user][$searchDate->format('Y-m-d')][
                                                        $b->id_bidang
                                                    ][$shift->id_shift]
                                                    : 0;
                                                $jml += $poin;
                                                $total += $poin;
                                                $searchDate->addDay();
                                            @endphp
                                            {{ $poin }}
                                        </td>
                                    @endforeach
                                    <td>{{ $jml }}</td>
                                @endforeach
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection
