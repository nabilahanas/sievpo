<table id="tkrph" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">
    <thead class="thead-successv2">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Nama RPH</th>
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

    <tbody>
        @php
            $grandTotal = 0;
            $monthlyTotals = array_fill_keys($monthsToShow, 0);
            $krphData = [];
        @endphp
        @foreach ($jabatan1 as $krph)
            <tr>
                <td scope="row">{{ $loop->iteration }}.</td>
                <td>{{ $krph->nama_user }}</td>
                <td>{{ $krph->jabatan->nama_jabatan }}</td>
                @php
                    $krphTotal = isset($krphTotals[$krph->id_user])
                        ? array_sum($krphTotals[$krph->id_user])
                        : 0;
                @endphp
                @foreach ($monthsToShow as $month)
                    @php
                        $poin = isset($krphTotals[$krph->id_user][$month])
                            ? $krphTotals[$krph->id_user][$month]
                            : 0;
                        $monthlyTotals[$month] += $poin;
                        $krph->total = $krphTotal;
                    @endphp
                    <td>{{ $poin }}</td>
                @endforeach
                <td>{{ $krphTotal }}</td>
            </tr>
            @php
                $grandTotal += $krphTotal;
                $krphData[] = ['nama_user' => $krph->nama_user, 'total' => $krphTotal];
            @endphp
        @endforeach
    </tbody>
    @php
        $krphData = collect($krphData)->sortByDesc('total')->values();
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
