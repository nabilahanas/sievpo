@extends('layouts.main')

@section('title', 'Rekap Total Karyawan')

@section('content')

<title>Rekap Total Karyawan</title>

    <div class="active tab-pane" id="kar">
        <a class="btn btn-outline-success" href="">Download
            Excel</a>
        <div class="table-responsive-lg mt-4">
            <table id="tkaryawan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                <thead class="thead-successv2">
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Wilayah</th>
                        @php
                            $monthsToShow = [];
                            if ($request->has('semester') && $request->has('year')) {
                                $semester = $request->semester;
                                $monthsToShow =
                                    $semester == 1
                                        ? ['January', 'February', 'March', 'April', 'May', 'June']
                                        : ['July', 'August', 'September', 'October', 'November', 'December'];
                            } else {
                                $monthsToShow = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];
                            }
                        @endphp
                        <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ $currentYear }}</th>
                        <th rowspan="2">Total</th>
                    </tr>
                    <tr>
                        @if ($request->has('semester') && $request->has('year'))
                            @php
                                $semester = $request->semester;
                                $monthsToShow =
                                    $semester == 01
                                        ? ['January', 'February', 'March', 'April', 'May', 'June']
                                        : ['July', 'August', 'September', 'October', 'November', 'December'];
                            @endphp
                            @foreach ($monthsToShow as $monthName)
                                <th>{{ $monthName }}</th>
                            @endforeach
                        @else
                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                <th>{{ $monthName }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $UItem)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}.</td>
                            <td>{{ $UItem->nama_user }}</td>
                            <td>
                                @if ($UItem->jabatan->wilayah == 0)
                                    Wilayah Timur
                                @elseif($UItem->jabatan->wilayah == 1)
                                    Wilayah Barat
                                @endif
                            </td>
                            @foreach ($monthsToShow as $month)
                                @php
                                    $poin = isset($karyawanTotals[$UItem->id_user][$month])
                                        ? $karyawanTotals[$UItem->id_user][$month]
                                        : 0;
                                @endphp
                                <td>{{ $poin }}</td>
                            @endforeach
                            <td>
                                @php
                                    $userTotal = isset($karyawanTotals[$UItem->id_user])
                                        ? array_sum($karyawanTotals[$UItem->id_user])
                                        : 0;
                                @endphp
                                {{ $userTotal }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>



            </table>
        </div>
    </div>

@endsection
