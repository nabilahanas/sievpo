<table>
    <thead style="background-color: #28a745; color: #ffffff;">
        <tr>
            <th rowspan="3">Nama</th>
            <th rowspan="3">Jabatan</th>
            <th rowspan="3">Wilayah</th>
            <th colspan="{{ count($bidang) * (count($shifts) + 1)}}" class="text-center">
                {{ request()->has('search') ? \Carbon\Carbon::parse(request()->search)->format('d F Y') : $currentDate }}
            </th>
            
            <th rowspan="3">Total</th>
        </tr>
        <tr>
            @foreach ($bidang as $b)
                <th colspan="{{ count($shifts) + 1 }}" class="text-center">{{ $b->nama_bidang }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($bidang as $b)
                @foreach ($shifts as $shift)
                    <th>{{ $shift->nama_shift }}</th>
                @endforeach
                <th>Jml</th>
            @endforeach
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
                @foreach ($bidang as $b)
                    @php
                        $jml = 0;
                    @endphp
                    @foreach ($shifts as $shift)
                        <td>
                            @php
                                $searchDate = request()->has('search')
                                    ? Carbon\Carbon::parse(request()->search)->startOfDay()
                                    : Carbon\Carbon::now()->startOfDay();
                                $poin = isset(
                                    $data[$user->id_user][$searchDate->format('Y-m-d')][$b->id_bidang][
                                        $shift->id_shift
                                    ]
                                )
                                    ? $data[$user->id_user][$searchDate->format('Y-m-d')][
                                        $b->id_bidang
                                    ][$shift->id_shift]
                                    : 0;
                                $jml += $poin;
                                $total += $poin;
                                $searchDate->addDay();
                            @endphp
                            {{ $poin }}
                        </td>
                    @endforeach
                    <td>{{ $jml }}</td>
                @endforeach
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
            @foreach($bidang as $b)
                @php
                    $totalBidang = 0;
                @endphp
                @foreach($shifts as $shift)
                    @php
                        $totalShift = 0;
                    @endphp
                    @foreach($users as $user)
                        @php
                            $searchDate = request()->has('search')
                                ? Carbon\Carbon::parse(request()->search)->startOfDay()
                                : Carbon\Carbon::now()->startOfDay();
                            $poin = isset($data[$user->id_user][$searchDate->format('Y-m-d')][$b->id_bidang][$shift->id_shift])
                                ? $data[$user->id_user][$searchDate->format('Y-m-d')][$b->id_bidang][$shift->id_shift]
                                : 0;
                            $totalBidang += $poin;
                            $totalShift += $poin;
                            $searchDate->addDay();
                        @endphp
                    @endforeach
                    <th>{{ $totalShift }}</th>
                @endforeach
                <th>{{ $totalBidang }}</th>
            @endforeach
            <th>{{ $grandTotal }}</th>
        </tr>
    </tfoot>
</table>
