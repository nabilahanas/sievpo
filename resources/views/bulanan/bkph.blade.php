@extends('layouts.main')

@section('title', 'Rekap Bulanan BKPH')

@section('content')
    <title>Rekap Bulanan BKPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('bulanan.exportbkph') }}?{{ request()->has('bulan') && request()->has('tahun') ? 'bulan=' . request()->bulan . '&tahun=' . request()->tahun : '' }}">Download
                    Excel</a>

                <div class="card mt-4">
                    <div class="card-body">
                        <div id="bBkphAd" style="width:100%; height:350px;"></div>
                    </div>
                </div>

                <div class="table-responsive-lg mt-4">
                    <div class="table-responsive-lg mt-4">
                        @if (request()->has('bulan') && request()->has('tahun'))
                            <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                                Hasil Pencarian: {{ $currentMonth }}
                            </div>
                        @endif
                        <table id="bbkph" class="table table-sm text-nowrap text-hover table-striped"
                            style="width: 100%">

                            <thead class="thead-successv2">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama BKPH</th>
                                    @php
                                        $daysInMonth =
                                            $request->has('bulan') && $request->has('tahun')
                                                ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                                : Carbon\Carbon::now()->daysInMonth;
                                        $colspan = $daysInMonth; // 3 kolom pertama untuk Nama, Jabatan, dan Wilayah
                                    @endphp
                                    <th colspan="{{ $colspan }}" class="text-center">{{ $currentMonth }}</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    @php
                                        $daysInMonth =
                                            $request->has('bulan') && $request->has('tahun')
                                                ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                                : Carbon\Carbon::now()->daysInMonth;
                                    @endphp
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        <th>{{ $day }}</th>
                                    @endfor
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $grandTotal = 0;
                                    $dailyTotals = array_fill(1, $daysInMonth, 0);
                                    $jabatanTotals = []; // Array untuk menyimpan total poin bidang
                                @endphp
                                @foreach ($jabatan as $item)
                                    @php
                                        $total = 0;
                                    @endphp

                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}.</td>
                                        <td>{{ $item->bagian }}</td>
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            @php
                                                $tanggal =
                                                    isset($request->tahun) && isset($request->bulan)
                                                        ? Carbon\Carbon::createFromDate(
                                                            $request->tahun,
                                                            $request->bulan,
                                                            $day,
                                                        )->format('d-m-Y')
                                                        : Carbon\Carbon::createFromDate(
                                                            date('Y'),
                                                            date('m'),
                                                            $day,
                                                        )->format('d-m-Y');

                                                $jabatanId = $item->bagian;
                                                $poin = isset($data[$jabatanId][$tanggal])
                                                    ? $data[$jabatanId][$tanggal]
                                                    : 0;
                                                $total += $poin;
                                                $dailyTotals[$day] += $poin;
                                            @endphp
                                            <td>{{ $poin }}</td>
                                        @endfor

                                        <td>{{ $total }}</td>
                                    </tr>

                                    {{-- Menambahkan total poin bidang ke dalam array --}}
                                    @php
                                        $jabatanTotals[] = ['name' => $item->bagian, 'y' => $total];
                                        $grandTotal += $total;
                                    @endphp
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right">Total:</th>
                                    @foreach ($dailyTotals as $dailyTotal)
                                        <th>{{ $dailyTotal }}</th>
                                    @endforeach
                                    <th>{{ $grandTotal }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div id="bBkphPim" style="width:100%; height:350px;"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    @if (request()->has('bulan') && request()->has('tahun'))
                        <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                            Hasil Pencarian: {{ $currentMonth }}
                        </div>
                    @endif
                    <table id="bbkph" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama BKPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $jabatan->sortByDesc(function ($item) use ($data, $request) {
                                    $total = 0;
                                    $daysInMonth =
                                        $request->has('bulan') && $request->has('tahun')
                                            ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                            : Carbon\Carbon::now()->daysInMonth;

                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $tanggal =
                                            isset($request->tahun) && isset($request->bulan)
                                                ? Carbon\Carbon::createFromDate(
                                                    $request->tahun,
                                                    $request->bulan,
                                                    $day,
                                                )->format('d-m-Y')
                                                : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                    'd-m-Y',
                                                );

                                        $jabatanId = $item->bagian;
                                        $poin = isset($data[$jabatanId][$tanggal]) ? $data[$jabatanId][$tanggal] : 0;
                                        $total += $poin;
                                    }
                                    return $total;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;

                                $pieData = [];
                                foreach ($sortedUsers as $users) {
                                    $total = 0;
                                    $daysInMonth =
                                        $request->has('bulan') && $request->has('tahun')
                                            ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                            : Carbon\Carbon::now()->daysInMonth;

                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $tanggal =
                                            isset($request->tahun) && isset($request->bulan)
                                                ? Carbon\Carbon::createFromDate(
                                                    $request->tahun,
                                                    $request->bulan,
                                                    $day,
                                                )->format('d-m-Y')
                                                : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                    'd-m-Y',
                                                );

                                        $jabatanId = $users->bagian;
                                        $poin = isset($data[$jabatanId][$tanggal]) ? $data[$jabatanId][$tanggal] : 0;
                                        $total += $poin;
                                    }
                                    $pieData[] = ['name' => $users->bagian, 'y' => $total];
                                }
                            @endphp

                            @foreach ($sortedUsers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->bagian }}</td>

                                    @php
                                        $total = 0;
                                        $daysInMonth =
                                            $request->has('bulan') && $request->has('tahun')
                                                ? Carbon\Carbon::create($request->tahun, $request->bulan)->daysInMonth
                                                : Carbon\Carbon::now()->daysInMonth;

                                        for ($day = 1; $day <= $daysInMonth; $day++) {
                                            $tanggal =
                                                isset($request->tahun) && isset($request->bulan)
                                                    ? Carbon\Carbon::createFromDate(
                                                        $request->tahun,
                                                        $request->bulan,
                                                        $day,
                                                    )->format('d-m-Y')
                                                    : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                                        'd-m-Y',
                                                    );

                                            $jabatanId = $item->bagian;
                                            $poin = isset($data[$jabatanId][$tanggal])
                                                ? $data[$jabatanId][$tanggal]
                                                : 0;
                                            $total += $poin;
                                        }
                                    @endphp
                                    <td>{{ $total }}</td>
                                    <!-- Menampilkan peringkat berdasarkan urutan data yang sudah diurutkan -->
                                    <td>{{ $ranking }}</td>
                                </tr>
                                @php
                                    // Meningkatkan peringkat setiap kali perulangan selesai
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <!-- ADMIN -->
    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <script>
            var currentMonth = "<?php echo $currentMonth; ?>";

            Highcharts.chart('bBkphAd', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Rekap BKPH ' + currentMonth,
                    align: 'center',
                    style: {
                        color: '#007bff'
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Poin',
                    colorByPoint: true,
                    data: {!! json_encode($jabatanTotals) !!}
                }]
            });
        </script>
    @endif

    <!-- PIMPINAN -->
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            var currentMonth = "<?php echo $currentMonth; ?>";
            Highcharts.chart('bBkphPim', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Ranking BKPH ' + currentMonth,
                    align: 'left',
                    style: {
                        color: '#007bff'
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Poin',
                    colorByPoint: true,
                    data: {!! json_encode($pieData) !!}
                }]
            });
        </script>
    @endif
@endsection
