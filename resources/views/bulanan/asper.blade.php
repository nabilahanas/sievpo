@extends('layouts.main')

@section('title', 'Rekap Bulanan Asper/KBKPH')

@section('content')
    <title>Rekap Bulanan Asper/KBKPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('bulanan.exportasper') }}?{{ request()->has('bulan') && request()->has('tahun') ? 'bulan=' . request()->bulan . '&tahun=' . request()->tahun : '' }}">Download
                    Excel</a>

                <div class="table-responsive-lg mt-4">
                    @if (request()->has('bulan') && request()->has('tahun'))
                    <div style="padding: 10px; font-size: 15px; font-weight: bold;">
                        Hasil Pencarian: {{ $currentMonth }}
                    </div>
                @endif
                    <table id="basper" class="table table-sm text-nowrap text-hover table-striped" style="width:100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama Karyawan</th>
                                <th rowspan="2">Asper/KBKPH</th>
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
                            @endphp
                            @foreach ($jabatan2 as $item)
                                @php
                                    $total = 0;
                                @endphp

                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->nama_user }}</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        @php
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

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                            $dailyTotals[$day] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endfor

                                    <td>{{ $total }}</td>
                                </tr>
                                @php
                                    $grandTotal += $total;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
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
    @endif

    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div id="bAsperPim" height="60"></div>
                    </div>
                </div>
                <div class="table-responsive-lg mt-4">
                    <table id="basper" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">

                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Asper/KBKPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedUsers = $jabatan2->sortByDesc(function ($item) use ($data, $request) {
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

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                    }
                                    return $total;
                                });
                        
                                // Menginisialisasi peringkat
                                $ranking = 1;

                                $pieData = [];
                                foreach ($sortedUsers as $item) {
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

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                                            $total += $poin;
                                        }
                                        $pieData[] = ['name' => $item->nama_jabatan, 'y' => $total];
                                    }
                            @endphp
                        
                            @foreach ($sortedUsers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->nama_user }}</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                        
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

                                            $userId = $item->id_user;
                                            $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
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
    @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
        <script>
            Highcharts.chart('bAsperPim', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Ranking Asper/KBKPH <?php echo date('M Y'); ?>',
                    align: 'left',
                    style: {
                        color: '#007bff'
                    }
                },
                // plotOptions: {
                //     series: {
                //         allowPointSelect: true,
                //         cursor: 'pointer',
                //         dataLabels: [{
                //             enabled: true,
                //             distance: 20
                //         }, {
                //             enabled: true,
                //             distance: -40,
                //             format: '{point.percentage:.1f}%',
                //             style: {
                //                 fontSize: '1.2em',
                //                 textOutline: 'none',
                //                 opacity: 0.7
                //             },
                //             filter: {
                //                 operator: '>',
                //                 property: 'percentage',
                //                 value: 10
                //             }
                //         }]
                //     }
                // },
                series: [{
                    name: 'Poin',
                    colorByPoint: true,
                    data: {!! json_encode($pieData) !!}
                }]
            });
        </script>
    @endif
@endsection