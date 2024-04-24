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
                            <h3><b>Wilayah dan Bidang Kerja</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol>
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a herf="#">Tentang Kami</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wilayah dan Bidang Kerja</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <article class="blog-details">
                    <div class="row justify-content-center position-relative h-100">
                        <h3 class="title text-center">WILAYAH KERJA</h3>
                        <div class="post-img">
                            <a href="{{ asset('landingpage/assets/img/petabkph.jpg') }}"
                                data-gallery="portfolio-gallery-app" class="glightbox"><img
                                    src="{{ asset('landingpage/assets/img/petabkph.jpg') }}" class="img-fluid"
                                    alt="Wilayah Kerja"></a>
                        </div>
                        <div class="row gy-4">
                            <table class="table table-responsive">
                                <thead class="thead-perhutani">
                                    <tr>
                                        <th scope="col">Wilayah Barat</th>
                                        <th scope="col">Wilayah Timur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Barang</td>
                                        <td>Kedungjati</td>
                                    </tr>
                                    <tr>
                                        <td>Jembolo Selatan</td>
                                        <td>Padas</td>

                                    </tr>
                                    <tr>
                                        <td>Jembolo Utara</td>
                                        <td>Manggar</td>
                                    </tr>
                                    <tr>
                                        <td>Penggaron</td>
                                        <td>Tempuran</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggung</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-center position-relative h-100">
                        <h3 class="title text-center">BIDANG KERJA</h3>
                        <div class="col-md-6 offset-2">
                            <table class="table table-responsive">
                                <thead class="thead-perhutani">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Bidang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Tanaman/Persemaian/Pemeliharaan</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Keamanan/Patroli</td>

                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Sosialisasi/Rapat/Apel</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Produksi/Agroforestry/Wisata</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    @endsection
