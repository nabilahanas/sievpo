@extends('layouts.main')

@section('title', 'Rekap Harian')

@section('content')
    <title>Rekap Harian</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download Excel</a>
            <div class="table-responsive mt-4">
                <table id="harian" class="table table-sm text-nowrap table-hover table-striped" style="width: 100%">

                    <thead>
                        <tr>
                            <th rowspan="2">Nama</th>
                            @foreach($bidang as $b)
                                <th colspan="{{ count($shifts) + 1 }}">{{ $b->nama_bidang }}</th>
                            @endforeach
                            {{-- <th rowspan="2">Total</th> --}}
                        </tr>
                        <tr>
                            @foreach($bidang as $b)
                                @foreach($shifts as $shift)
                                    <th>{{ $shift->nama_shift }}</th>
                                @endforeach
                                <th>Jml</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->nama_user }}</td>
                                @foreach($bidang as $b)
                                    @php
                                        $totalPoinPerBidang = 0;
                                    @endphp
                                    @foreach($shifts as $shift)
                                        <td>
                                            @php
                                                $poin = 0;
                                                // Cari poin yang sesuai dengan user, bidang, dan shift saat ini
                                                foreach($datas as $rekap) {
                                                    if($rekap->id_user == $user->id_user && $rekap->id_bidang == $b->id_bidang && $rekap->id_shift == $shift->id_shift) {
                                                        $poin = $rekap->poin;
                                                        break; // Keluar dari loop setelah menemukan poin
                                                    }
                                                }
                                                echo $poin;
                                                $totalPoinPerBidang += $poin;
                                            @endphp
                                        </td>
                                    @endforeach
                                    <td>{{ $totalPoinPerBidang }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
