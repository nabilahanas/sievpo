@extends('layouts.main')

@section('title', 'Rekap Total BKPH')

@section('content')

    <title>Rekap Total BKPH</title>

    @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-success"
                    href="{{ route('total.exportbkph') }}?{{ request()->has('semester') && request()->has('year') ? 'semester=' . request()->semester . '&year=' . request()->year : 'search=' . '' }}">Download
                    Excel</a>
                <div class="table-responsive-lg mt-4">
                    <table id="tbkph" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Nama BKPH</th>
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
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->bagian }}</td>

                                    @foreach ($monthsToShow as $month)
                                        @php
                                            $poin = isset($bkphTotals[$item->bagian][$month])
                                                ? $bkphTotals[$item->bagian][$month]
                                                : 0;
                                            $monthlyTotals[$month] += $poin;
                                        @endphp
                                        <td>{{ $poin }}</td>
                                    @endforeach
                                    <td>
                                        @php
                                            $bkphTotal = isset($bkphTotals[$item->bagian])
                                                ? array_sum($bkphTotals[$item->bagian])
                                                : 0;
                                        @endphp
                                        {{ $bkphTotal }}
                                    </td>
                                </tr>
                                @php
                                    $grandTotal += $bkphTotal;
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
                <div class="table-responsive-lg mt-4">
                    <table id="tbkphpim" class="table table-sm text-nowrap text-hover table-striped" style="width: 100%">
                        <thead class="thead-successv2">
                            <tr>
                                <th>No.</th>
                                <th>Nama BKPH</th>
                                <th>Total Poin</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>

                        <tbody style="overflow-x: auto;">
                            @php
                                $monthsToShow = [];
                                // Mengurutkan pengguna berdasarkan total poin
                                $sortedBKPH = $jabatan->sortByDesc(function ($item) use ($bkphTotals) {
                                    return isset($bkphTotals[$item->bagian])
                                        ? array_sum($bkphTotals[$item->bagian])
                                        : 0;
                                });

                                // Menginisialisasi peringkat
                                $ranking = 1;
                            @endphp

                            @foreach ($sortedBKPH as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->bagian }}</td>
                                    <td>
                                        @php
                                           $bkphTotal = isset($bkphTotals[$item->bagian])
                                                ? array_sum($bkphTotals[$item->bagian])
                                                : 0;
                                        @endphp
                                        {{ $bkphTotal }}
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
