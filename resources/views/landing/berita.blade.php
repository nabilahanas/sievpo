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
                            <h3><b>Berita</b></h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol>
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
                    @foreach ($berita->chunk(3) as $chunk)
                        <div class="row">
                            @foreach ($chunk as $item)
                                <div class="col-xl-4 col-md-6">
                                    <article class="post-item">
                                        <div class="post-img">
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/gambar-berita/' . $item->gambar) }}"
                                                    alt="Gambar Berita" class="img-fluid">
                                            @else
                                                <img src="https://www.perhutani.co.id/wp-content/themes/perhutani2022/assets/images/default-cover.jpg"
                                                    alt="Default Image" class="img-fluid" style="margin-top: -20px; margin-left: 20px; display: block; transform: scale(1.2)">
                                            @endif
                                        </div>
                                        <h2 class="title"
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            <a href="{{ $item->deskripsi }}" target="_blank">{{ $item->judul }}</a>
                                        </h2>
                                        <div class="d-flex align-items-center">
                                            <div class="post-meta">
                                                <p class="post-date">
                                                    <time datetime="{{ $item->created_at }}">
                                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                    </time>
                                                </p>
                                                <div class="article-preview">
                                                    HTML adalah bahasa yang digunakan untuk membuat halaman web. Bagi yang
                                                    berkecimpung di dunia perangkat gadget dan ilmu komputer, pasti sudah
                                                    tidak asing lagi dengan berbagai kode di dalamnya. HTML adalah
                                                    kependekan dari Hypertext Markup Language.
                                                </div>
                                                {{-- <p class="post-author-list">Diterbitkan oleh Administrator</p> --}}
                                                <a href="{{ $item->deskripsi }}" target="_blank">Lihat Selengkapnya</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="blog-pagination">
                    <ul class="justify-content-center">
                        <li><a href="#"><i class="bi bi-arrow-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>

    </main>
@endsection
