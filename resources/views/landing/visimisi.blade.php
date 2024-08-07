@extends('landing.page')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('landingpage/assets/img/breadcrumb.png') }}'); background-size: cover; background-position: center;">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h3><b>Visi, Misi, dan Tata Nilai</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol>
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a herf="#">Tentang Kami</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visi, Misi, dan Tata Nilai</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <article class="blog-details text-center">
                    <h3>VISI</h3>
                    <p class="content">Menjadi Perusahaan Pengelola Hutan Berkelanjutan dan Bermanfaat Bagi Masyarakat</p>
                    <h3>MISI</h3>
                    <p class="content">
                        Mengelola Sumberdaya Hutan Secara Lestari
                        <br>Peduli Kepada Kepentingan Masyarakat dan Lingkungan
                        <br>Mengoptimalkan Bisnis Kehutanan dengan Prinsip Good Corporate Governance
                    </p>
                    <h3 style="color: #016237">TATA NILAI AKHLAK</h3>
                    <div class="post-img">
                        <img class="position-relative h-100"
                            src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2022/10/akhlak-2.png"
                            class="img-fluid mx-auto d-block" alt="Akhlak" style="max-width: 70%">
                    </div>
                </article>
            </div>
        </section>
    </main>
@endsection
