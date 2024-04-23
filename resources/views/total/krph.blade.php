@extends('layouts.main')

@section('title', 'Rekap Total KRPH')

@section('content')

    <title>Rekap Total KRPH</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success"
                href="{{ route('total.exportkrph') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                Excel</a>
            <!-- Test -->
            <div class="row mt-4">
                <section class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title" style="color: #007bff; font-weight: 600;">
                                    KRPH <?php echo date('M Y'); ?>
                                </h3>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i>
                                    Download</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="krphPoin" height="60"></div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="table-responsive-lg mt-4">
                <table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Nama KRPH</th>
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
                        @foreach ($jabatan1 as $krph)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $krph->nama_user }}</td>
                                <td>{{ $krph->jabatan->nama_jabatan }}</td>
                                @foreach ($monthsToShow as $month)
                                    @php
                                        $poin = isset($krphTotals[$krph->id_user][$month])
                                            ? $krphTotals[$krph->id_user][$month]
                                            : 0;
                                        $monthlyTotals[$month] += $poin;
                                    @endphp
                                    <td>{{ $poin }}</td>
                                @endforeach
                                <td>
                                    @php
                                        $krphTotal = isset($krphTotals[$krph->id_user])
                                            ? array_sum($krphTotals[$krph->id_user])
                                            : 0;
                                    @endphp
                                    {{ $krphTotal }}
                                </td>
                            </tr>
                            @php
                                $grandTotal += $krphTotal;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right">Total:</th>
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

@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('krphPoin', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Eviden Poin KRPH',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode($categories) !!},
                crosshair: true,
                // accessibility: {
                //     description: 'Countries'
                // }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Poin'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Poin',
                data: [406, 260, 107, 683, 275, 145]
            }, ]
        });
    </script>
@endsection
