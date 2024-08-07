@extends('landing.page')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('landingpage/assets/img/breadcrumb.png') }}'); background-size: cover; background-position: center;">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h3><b>Data Karyawan</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol>
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a herf="#">Tentang Kami</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Karyawan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <article class="blog-details">
                    <h3 class="title text-center">DATABASE KARYAWAN PERUM PERHUTANI AGUSTUS 2023
                        <br>KPH SEMARANG DIVISI REGIONAL JAWA TENGAH
                    </h3>
                    <div class="offset-2 mt-4">
                        <table class="table table-striped table-responsive" style="display: inline-block; max-width: 80%">
                            <thead class="thead-perhutani">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
        </section>
    </main>
@endsection
