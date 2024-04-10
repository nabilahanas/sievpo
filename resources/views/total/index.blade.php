@extends('layouts.main')

@section('title', 'Rekap Total')

@section('content')
    <title>Rekap Total</title>

    <!-- ADMIN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#kar" data-toggle="tab">Rekap Karyawan</a></li>
                <li class="nav-item"><a class="nav-link" href="#bid" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a class="nav-link" href="#bkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#krph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#asper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">

                    <!-- KARYAWAN -->
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
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                            <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $UItem)
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
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    $poin = isset($karyawanTotals[$UItem->nama_user][$month]) ? $karyawanTotals[$UItem->nama_user][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    $userTotal = isset($karyawanTotals[$UItem->nama_user]) ? array_sum($karyawanTotals[$UItem->nama_user]) : 0;
                                                @endphp
                                                {{ $userTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                
                            </table>
                        </div>
                    </div>

                    <!-- BIDANG -->
                    <div class="tab-pane" id="bid">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tbidang" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Bidang</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($bidang as $BItem)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $BItem->nama_bidang }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    $poin = isset($bidangTotals[$BItem->nama_bidang][$month]) ? $bidangTotals[$BItem->nama_bidang][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    $bidangTotal = isset($bidangTotals[$BItem->nama_bidang]) ? array_sum($bidangTotals[$BItem->nama_bidang]) : 0;
                                                @endphp
                                                {{ $bidangTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <!-- BKPH -->
                    <div class="tab-pane" id="bkph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tbkph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama BKPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($jabatan as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->bagian }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    $poin = isset($bkphTotals[$item->bagian][$month]) ? $bkphTotals[$item->bagian][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                            <td>
                                                @php
                                                    $bkphTotal = isset($bkphTotals[$item->bagian]) ? array_sum($bkphTotals[$item->bagian]) : 0;
                                                @endphp
                                                {{ $bkphTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                
                                

                            </table>
                        </div>
                    </div>

                    <!-- KRPH -->
                    <div class="tab-pane" id="krph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Nama KRPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($jabatan1 as $krph)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $krph->nama_user}}</td>
                                            <td>{{ $krph->jabatan->nama_jabatan }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    $poin = isset($krphTotals[$krph->nama_user][$month]) ? $krphTotals[$krph->nama_user][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    $krphTotal = isset($krphTotals[$krph->nama_user]) ? array_sum($krphTotals[$krph->nama_user]) : 0;
                                                @endphp
                                                {{ $krphTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ASPER -->
                    <div class="tab-pane" id="asper">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive-lg mt-4">
                            <table id="tasper" class="table table-sm text-nowrap table-hover table-striped"
                                style="width: 100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Karyawan</th>
                                        <th rowspan="2">Asper/KBKPH</th>
                                        <th colspan="12" style="text-align: center">{{ $currentYear }}</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthName)
                                        <th>{{ $monthName }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($jabatan2 as $asper)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $asper->nama_user}}</td>
                                            <td>{{ $asper->jabatan->nama_jabatan }}</td>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                @php
                                                    $poin = isset($asperTotals[$asper->nama_user][$month]) ? $asperTotals[$asper->nama_user][$month] : 0;
                                                @endphp
                                                <td>{{ $poin }}</td>
                                            @endforeach
                                
                                            <td>
                                                @php
                                                    $asperTotal = isset($asperTotals[$asper->nama_user]) ? array_sum($asperTotals[$asper->nama_user]) : 0;
                                                @endphp
                                                {{ $asperTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- KARYAWAN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#rkaryawan" data-toggle="tab">Rekap Karyawan</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#rbidang" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a class="nav-link" href="#rbkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#rkrph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a class="nav-link" href="#rasper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">

                    <!-- KARYAWAN -->
                    <div class="active tab-pane" id="rkaryawan">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                    </div>

                    <!-- BIDANG -->
                    <div class="tab-pane" id="rbidang">
                        <a class="btn btn-outline-success" href="">Download
                            Excel</a>
                    </div>

                    <!-- BKPH -->
                    <div class="tab-pane" id="rbkph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                    </div>

                    <!-- KRPH -->
                    <div class="tab-pane" id="rkrph">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                        <div class="table-responsive mt-4">
                            <table id="tkrph" class="table table-sm text-nowrap text-hover" style="width=100%">
                                <thead class="thead-successv2">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama KRPH</th>
                                        <th colspan="12" style="text-align: center">2024</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row">.</th>

                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ASPER -->
                    <div class="tab-pane" id="rasper">
                        <a class="btn btn-outline-success" href="">Download Excel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
