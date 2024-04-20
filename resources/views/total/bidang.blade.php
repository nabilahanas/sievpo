@extends('layouts.main')

@section('title', 'Rekap Total Bidang')

@section('content')
    <title>Rekap Total Bidang</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download
                Excel</a>
            <div class="table-responsive-lg mt-4">
                <table id="tbidang" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama Bidang</th>
                            @php
                                $monthsToShow = [];
                                if ($request->has('semester') && $request->has('year')) {
                                    $semester = $request->semester;
                                    $monthsToShow =
                                        $semester == 1
                                            ? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']
                                            : ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                } else {
                                    $monthsToShow = [
                                        'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember',
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
                                            ? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']
                                            : ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                @endphp
                                @foreach ($monthsToShow as $monthName)
                                    <th>{{ $monthName }}</th>
                                @endforeach
                            @else
                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $monthName)
                                    <th>{{ $monthName }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($bidang as $BItem)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $BItem->nama_bidang }}</td>

                                @foreach ($monthsToShow as $month)
                                    @php
                                        $poin = isset($bidangTotals[$BItem->id_bidang][$month])
                                            ? $bidangTotals[$BItem->id_bidang][$month]
                                            : 0;
                                    @endphp
                                    <td>{{ $poin }}</td>
                                @endforeach
                                <td>
                                    @php
                                        $bidangTotal = isset($bidangTotals[$BItem->id_bidang])
                                            ? array_sum($bidangTotals[$BItem->id_bidang])
                                            : 0;
                                    @endphp
                                    {{ $bidangTotal }}
                                </td>
                            </tr>
                            @php
                                $grandTotal += $bidangTotal;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="14" style="text-align:right">Total:</th>
                            <th>{{ $grandTotal }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
