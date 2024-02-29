@extends('landing.page')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2021/08/WhatsApp-Image-2021-08-03-at-14.35.15-2.jpeg?resize=1024%2C768&ssl=1')">
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a herf="#">Tentang Kami</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visi, Misi, dan Tata Nilai</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="text-center">
                    <h3>VISI</h3>
                    <p>Menjadi Perusahaan Pengelola Hutan Berkelanjutan dan Bermanfaat Bagi Masyarakat</p>
                    <h3>MISI</h3>
                    <p>
                        Mengelola Sumberdaya Hutan Secara Lestari
                        <br>Peduli Kepada Kepentingan Masyarakat dan Lingkungan
                        <br>Mengoptimalkan Bisnis Kehutanan dengan Prinsip Good Corporate Governance
                    </p>
                    <h5 style="color: #016237">TATA NILAI AKHLAK</h5>
                    <img class="position-relative h-100"
                        src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2022/10/akhlak-2.png"
                        class="img-fluid mx-auto d-block" alt="Akhlak" style="max-width: 60%">
                </div>
            </div>
        </section>
    </main>
@endsection
