@extends('landing.page')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2021/08/WhatsApp-Image-2021-08-03-at-14.35.15-2.jpeg?resize=1024%2C768&ssl=1');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h3><b>Berita</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 posts-list">
                    <div class="col-xl-4 col-md-6">
                        <article>
                            <h2 class="title">
                                <a href="">Dolorum optio tempore voluptas dignissimos</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-date">
                                        <time datetime="2022-01-01">Jan 1, 2022</time>
                                    </p>
                                    <p class="post-author-list">Maria Doe</p>
                                    <a href="">Lihat Selengkapnya</a>
                                </div>
                            </div>

                        </article>
                    </div>
                </div>

                <div class="blog-pagination">
                    <ul class="justify-content-center">
                        <li><a href="#">Sebelumnya</a></li>
                        <li><a href="#">Selanjutnya</a></li>
                    </ul>
                </div>

            </div>
        </section>

    </main>
@endsection
