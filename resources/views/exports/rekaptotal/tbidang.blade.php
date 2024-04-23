<table id="tbidang" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
    <thead class="thead-successv2">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama Bidang</th>
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
            <th colspan="{{ count($monthsToShow) }}" style="text-align: center">
                {{ request()->input('year', $currentYear) }}</th>
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
                        $semesterTotal = 0;
                        foreach ($monthsToShow as $month) {
                            $poin = isset($bidangTotals[$BItem->id_bidang][$month])
                                ? $bidangTotals[$BItem->id_bidang][$month]
                                : 0;
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
            <th colspan="3" style="text-align:right">Total:</th>
            @foreach ($monthlyTotals as $monthlyTotal)
                <th>{{ $monthlyTotal }}</th>
            @endforeach
            <th>{{ $grandTotal }}</th>
        </tr>
    </tfoot>
</table>
