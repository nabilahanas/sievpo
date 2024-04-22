<table id="bulanan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">

    <thead class="thead-successv2">
        <tr>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Jabatan</th>
            <th rowspan="2">Wilayah</th>
            @php
                $daysInMonth =
                    request()->has('bulan') && request()->has('tahun')
                        ? Carbon\Carbon::create(request()->tahun, request()->bulan)->daysInMonth
                        : Carbon\Carbon::now()->daysInMonth;
                $colspan = $daysInMonth;
            @endphp
            <th colspan="{{ $colspan }}" class="text-center">{{ $currentMonth }}</th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            @php
                $daysInMonth =
                    request()->has('bulan') && request()->has('tahun')
                        ? Carbon\Carbon::create(request()->tahun, request()->bulan)->daysInMonth
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
        @endphp
        @foreach ($users as $user)
            @php
                $total = 0;
            @endphp

            <tr>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->jabatan->nama_jabatan }}</td>
                <td>
                    @if ($user->jabatan->wilayah == 0)
                        WILAYAH TIMUR
                    @elseif($user->jabatan->wilayah == 1)
                        WILAYAH BARAT
                    @endif
                </td>
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $tanggal =
                            isset(request()->tahun) && isset(request()->bulan)
                                ? Carbon\Carbon::createFromDate(
                                    request()->tahun,
                                    request()->bulan,
                                    $day,
                                )->format('d-m-Y')
                                : Carbon\Carbon::createFromDate(date('Y'), date('m'), $day)->format(
                                    'd-m-Y',
                                );

                        $userId = $user->id_user;
                        $poin = isset($data[$userId][$tanggal]) ? $data[$userId][$tanggal] : 0;
                        $total += $poin;
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
            @php
                $daysInMonth =
                    request()->has('bulan') && request()->has('tahun')
                        ? Carbon\Carbon::create(request()->tahun, request()->bulan)->daysInMonth
                        : Carbon\Carbon::now()->daysInMonth;
                $colspan = $daysInMonth + 2; // 3 kolom pertama untuk Nama, Jabatan, dan Wilayah
            @endphp
            <th colspan="{{ $colspan }}" style="text-align:right">Total:</th>
            <th>{{ $grandTotal }}</th>
        </tr>
    </tfoot>

</table>