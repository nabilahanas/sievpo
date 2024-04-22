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
            <th colspan="{{ count($monthsToShow) }}" style="text-align: center">{{ request()->input('year', $currentYear) }}</th>
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
                    @endphp
                    <td>{{ $poin }}</td>
                @endforeach
                <td>
                    @php
                        $semesterTotal = 0;
                        foreach ($monthsToShow as $month) {
                            $poin = isset($karyawanTotals[$UItem->id_user][$month]) ? $karyawanTotals[$UItem->id_user][$month] : 0;
                            $semesterTotal += $poin;
                        }
                    @endphp
                    {{ $semesterTotal }}
                </td>
            </tr>
            @php
                $grandTotal += $semesterTotal;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="{{ count($monthsToShow) + 3 }}" style="text-align:right">Total:</th>
            <th>{{ $grandTotal }}</th>
        </tr>
    </tfoot>
</table>