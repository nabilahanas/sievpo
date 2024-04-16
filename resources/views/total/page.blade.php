@extends('layouts.main')

{{-- @section('title', 'Rekap Total') --}}

@section('content')
    <!-- ADMIN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link {{ $key == 'tkaryawan' ? 'active' : '' }}" href="/total/karyawan" data-toggle="tab">Rekap Karyawan</a></li>
                <li class="nav-item"><a class="nav-link {{ $key == 'tbidang' ? 'active' : '' }}" href="/total/bidang" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a class="nav-link {{ $key == 'tbkph' ? 'active' : '' }}" href="/total/bkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a class="nav-link {{ $key == 'tkrph' ? 'active' : '' }}" href="total/krph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a class="nav-link {{ $key == 'tasper' ? 'active' : '' }}" href="/total/asper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">
                    <section class="content-section">
                        @yield('tab_content')
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection
