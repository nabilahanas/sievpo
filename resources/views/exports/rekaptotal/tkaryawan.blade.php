<table id="tkaryawan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
    <thead class="thead-successv2">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Wilayah</th>
            @php
                // Initialize monthsToShow based on semester and year
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
                // Store the correct monthsToShow in a separate variable
                $displayMonths = $monthsToShow;
            @endphp
            <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ $currentYear }}</th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            @foreach ($displayMonths as $monthName)
                <th>{{ $monthName }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @php
            $grandTotal = 0;
            $monthlyTotals = array_fill_keys($monthsToShow, 0);
            $usersData = [];
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
                {{-- {{ dd($poin) }} --}}
                <td>
                    @php
                        $userTotal = isset($karyawanTotals[$UItem->id_user])
                            ? array_sum($karyawanTotals[$UItem->id_user])
                            : 0;
                        $UItem->total = $userTotal;
                    @endphp
                    {{ $userTotal }}
                </td>
            </tr>
            @php
                $grandTotal += $userTotal;
                $usersData[] = ['nama_user' => $UItem->nama_user, 'total' => $userTotal];
            @endphp
        @endforeach
    </tbody>
    @php
        $totalPoints = isset($karyawanTotals[auth()->user()->id_user])
            ? array_values($karyawanTotals[auth()->user()->id_user])
            : [];
        // Urutkan array pengguna berdasarkan total mereka secara menurun
        usort($usersData, function ($a, $b) {
            return $b['total'] - $a['total'];
        });
    @endphp
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
