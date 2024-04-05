@extends('layouts.main')

@section('title', 'Rekap Bulanan')

@section('content')
    <title>Rekap Bulanan</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download
                Excel</a>

            <div class="table-responsive mt-4">
                <table id="bulanan" class="table table-sm text-nowrap text-hover table-striped" style="width=100%">

                    <thead class="thead-successv2">
                        <tr>
                            <th colspan="40" class="text-center">{{ $currentMonth }}</th>
                        </tr>
                        <tr>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Jabatan</th>
                            <th rowspan="2">Wilayah</th>
                            @foreach ($bidang as $b)
                                <th colspan="{{ count($shifts) + 1 }}" class="text-center">{{ $b->nama_bidang }}</th>
                            @endforeach
                            <th></th>
                        </tr>
                        <tr>
                            @foreach ($bidang as $b)
                                @foreach ($shifts as $shift)
                                    <th>{{ $shift->nama_shift }}</th>
                                @endforeach
                                <th>Jml</th> <!-- Tambahkan kolom total untuk jumlah poin per bulan -->
                            @endforeach
                            <th rowspan="2">Total</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $total = 0;
                            @endphp

                            <tr>
                                <td>{{ $user->nama_user }}</td>
                                <td>{{ $user->jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($user->jabatan->wilayah == 0)
                                        Wilayah Timur
                                    @elseif($user->jabatan->wilayah == 1)
                                        Wilayah Barat
                                    @endif
                                </td>
                                @foreach ($bidang as $b)
                                    @php
                                        $jml = 0;
                                    @endphp
                                    @foreach ($shifts as $shift)
                                        <td>
                                            @php
                                                // Inisialisasi total poin per bulan
                                                $bulanIni = \Carbon\Carbon::now()->startOfMonth(); // Mulai dari bulan ini
                                            @endphp
                                            @while ($bulanIni->lte(\Carbon\Carbon::now()))
                                                @php
                                                    // Ambil total poin untuk user, bidang, shift, dan bulan saat ini
                                                    $poin =
                                                        $data[$user->id_user][$bulanIni->format('Y-m')][$b->id_bidang][
                                                            $shift->id_shift
                                                        ];
                                                    echo $poin;
                                                    $jml += $poin; // Tambahkan poin ke total poin per bulan
                                                    $total += $poin;
                                                    $bulanIni->addMonth(); // Lanjutkan ke bulan berikutnya
                                                @endphp
                                            @endwhile
                                        </td>
                                    @endforeach
                                    <td>{{ $jml }}</td> <!-- Tampilkan total poin per bulan -->
                                @endforeach
                                <td>{{ $total }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
