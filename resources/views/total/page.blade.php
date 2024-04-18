@extends('layouts.main')

{{-- @section('title', 'Rekap Total') --}}

@section('content')
    <!-- ADMIN -->
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a id="tkaryawan" class="nav-link {{ $key == 'tkaryawan' ? 'active' : '' }}" href="/total/karyawan" data-toggle="tab">Rekap Karyawan</a></li>
                <li class="nav-item"><a id="tbidang" class="nav-link {{ $key == 'tbidang' ? 'active' : '' }}" href="/total/bidang" data-toggle="tab">Rekap Bidang</a></li>
                <li class="nav-item"><a id="tbkph" class="nav-link {{ $key == 'tbkph' ? 'active' : '' }}" href="/total/bkph" data-toggle="tab">Rekap BKPH</a></li>
                <li class="nav-item"><a id="tkrph" class="nav-link {{ $key == 'tkrph' ? 'active' : '' }}" href="/total/krph" data-toggle="tab">Rekap KRPH</a></li>
                <li class="nav-item"><a id="tasper" class="nav-link {{ $key == 'tasper' ? 'active' : '' }}" href="/total/asper" data-toggle="tab">Rekap Asper/KBKPH</a></li>
            </ul>
            <div class="mt-4">
                <div class="tab-content">
                    <section id="content_karyawan" class="content-section">
                        @yield('tab_content_karyawan')
                    </section>
                    <section id="content_bidang" class="content-section">
                        @yield('tab_content_bidang')
                    </section>
                    <section id="content_bkph" class="content-section">
                        @yield('tab_content_bkph')
                    </section>
                    <section id="content_krph" class="content-section">
                        @yield('tab_content_krph')
                    </section>
                    <section id="content_asper" class="content-section">
                        @yield('tab_content_asper')
                    </section>
                </div>
            </div>
        </div>
    </div>
    
    

@endsection
