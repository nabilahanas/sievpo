@extends('layouts.main')

@section('title', 'Rekap Total Karyawan')

@section('content')

    <title>Rekap Total Karyawan</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('total.exportkaryawan') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                    Excel</a>
                <!-- Chart -->
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
                                <div id="bulanPoin" height="60"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="table-responsive-lg mt-4" style="overflow-x: auto;">
                    <table id="tkaryawan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Wilayah</th>
                                @php
                                    $monthsToShow = [];
                                    if (request()->has('semester') && request()->has('year')) {
                                        $semester = request()->semester;
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
                                @if (request()->has('semester') && request()->has('year'))
                                    @php
                                        $semester = request()->semester;
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
                        <tbody style="overflow-x: auto;">
                            @php
                                $grandTotal = 0;
                                $monthlyTotals = array_fill_keys($monthsToShow, 0);
                            @endphp
                            @foreach ($user as $UItem)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $UItem->nama_user }}</td>
                                    <td>
                                        @if ($UItem->jabatan->wilayah == 0)
                                            WILAYAH TIMUR
                                        @elseif($UItem->jabatan->wilayah == 1)
                                            WILAYAH BARAT
                                        @endif
                                    </td>
                                    @foreach ($monthsToShow as $month)
                                        @php
                                            $poin = isset($karyawanTotals[$UItem->id_user][$month])
                                                ? $karyawanTotals[$UItem->id_user][$month]
                                                : 0;
                                            $monthlyTotals[$month] += $poin;
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
                                @php
                                    $grandTotal += $userTotal;
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
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-lg mt-4" style="overflow-x: auto;">
                    <table id="tkaryawanpim" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Nama Jabatan</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $UItem)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $UItem->nama_user }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
@if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('bulanPoin', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Eviden Poin Bulanan',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode($monthsToShow) !!},
                crosshair: true,
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
                data: {!! json_encode(array_values($monthlyTotals)) !!}
            }]
        });
    </script>
@endif
@endsection
