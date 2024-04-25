@extends('layouts.main')

@section('title', 'Rekap Total Bidang')

@section('content')
    <title>Rekap Total Bidang</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('total.exportbidang') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                    Excel</a>
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('semester') && request()->has('year'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian Tahun {{ $currentYear }}
                        </div>
                    @endif
                    <table id="tbidang" class="table table-sm text-nowrap text-hover table-striped" style="width:100%">
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
                                $monthlyTotals = array_fill_keys($monthsToShow, 0);
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
                                            $monthlyTotals[$month] += $poin;
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
                                <th colspan="2" style="text-align:right">Total:</th>
                                @foreach ($monthlyTotals as $monthlyTotal)
                                    <th>{{ $monthlyTotal }}</th>
                                @endforeach
                                <th>{{ $grandTotal }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div id="tBidangPim" height="60"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    <table id="tbidangpim" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Bidang</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody style="overflow-x: auto;">
                            @php
                                $monthsToShow = [];
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedBidang = $bidang->sortByDesc(function ($BItem) use ($bidangTotals) {
                                    return isset($bidangTotals[$BItem->id_bidang])
                                        ? array_sum($bidangTotals[$BItem->id_bidang])
                                        : 0;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;

                                $pieData = [];
                                foreach ($sortedBidang as $UItem) {
                                    $bidangTotal = isset($bidangTotals[$UItem->id_bidang])
                                        ? array_sum($bidangTotals[$UItem->id_bidang])
                                        : 0;
                                    $pieData[] = ['name' => $UItem->nama_bidang, 'y' => $bidangTotal];
                                }
                            @endphp

                            @foreach ($sortedBidang as $BItem)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $BItem->nama_bidang }}</td>
                                    <td>
                                        @php
                                            $bidangTotal = isset($bidangTotals[$BItem->id_bidang])
                                                ? array_sum($bidangTotals[$BItem->id_bidang])
                                                : 0;
                                        @endphp
                                        {{ $bidangTotal }}
                                    </td>
                                    <td> {{ $ranking }} </td>
                                </tr>
                                @php
                                    $ranking++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('script')
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentYear = "<?php echo $currentYear; ?>";
            Highcharts.chart('tBidangPim', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Ranking Bidang ' + currentYear,
                    align: 'left',
                    style: {
                        color: '#007bff'
                    }
                },
                series: [{
                    name: 'Poin',
                    colorByPoint: true,
                    data: {!! json_encode($pieData) !!}
                }]
            });
        </script>
    @endif
@endsection
