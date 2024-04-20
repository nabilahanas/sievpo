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
                            <h3><b>Struktur Organisasi</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol>
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item">Tentang Kami</li>
                        <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <article class="blog-details">
                    <div class="row justify-content-center position-relative h-100">
                        <h3 class="title text-center">STRUKTUR ORGANISASI
                            <br>PERUM PERHUTANI KPH SEMARANG TAHUN 2023
                        </h3>
                        <div class="post-img">
                            <a href="landingpage/assets/img/struktur_organisasi.png" data-gallery="portfolio-gallery-app"
                                class="glightbox"><img src="landingpage/assets/img/struktur_organisasi.png"
                                    class="img-fluid" alt="Struktur Organisasi"></a>
                        </div>
                        {{-- <div class="col-md-12">
                            <p class="text-center" style="font-size: 10px">Klik gambar untuk memperbesar</p>
                        </div> --}}
                        <div class="row gy-4">
                            <div class="col-lg-5">
                                <img src="landingpage/assets/img/keterangan.jpg" class="img-fluid" style="max-width: 50%">
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>
@endsection
