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
                        <div class="col-md-8">
                            <h3 class="title text-center">STRUKTUR ORGANISASI
                                <br>PERUM PERHUTANI KPH SEMARANG
                            </h3>
                            <div class="post-img">
                                <img src="landingpage/assets/img/struktur-organisasi.png" class="img-fluid mx-auto d-block"
                                    alt="Profil Perusahaan" style="max-width: 100%">
                            </div>
                            <div class="row gy-4">
                                <div class="col-lg-6">
                                    <div class="post-img">
                                        <img src="landingpage/assets/img/Group-476.jpg" class="img-fluid mx-auto d-block"
                                            alt="Profil Perusahaan" style="max-width: 70%">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="post-img">
                                        <img src="landingpage/assets/img/Group-243.jpg" class="img-fluid mx-auto d-block"
                                            alt="Profil Perusahaan" style="max-width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </article>
            </div>
        </section>
    </main>
@endsection
