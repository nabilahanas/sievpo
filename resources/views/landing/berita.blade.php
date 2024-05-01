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
                    @foreach ($beritalanding->chunk(3) as $chunk)
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
                                                    alt="Default Image" class="img-fluid"
                                                    style="margin-top: -20px; margin-left: 20px; display: block; transform: scale(1.2)">
                                            @endif
                                        </div>
                                        <h2 class="title"
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            <div>{{ $item->judul }}</div>
                                        </h2>
                                        <div class="post-meta">
                                            <p class="post-date">
                                                <time datetime="{{ $item->created_at }}">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                </time>
                                            </p>
                                        </div>

                                        <div class="article-preview">
                                            @php
                                                // Mendapatkan HTML dari setiap berita
                                                $htmlContent = $beritaContent[$item->id_berita];

                                                // Jika HTML tersedia, lakukan proses parsing
                                                if ($htmlContent) {
                                                    // Temukan posisi awal tag <p>
                                                    $start = strpos($htmlContent, '<p>');
                                                    if ($start !== false) {
                                                        // Temukan posisi akhir tag </p> setelah tag <p> pertama
                                                        $end = strpos($htmlContent, '</p>', $start);
                                                        if ($end !== false) {
                                                            // Ambil teks di antara tag <p> dan </p>
                                                            $preview = substr(
                                                                $htmlContent,
                                                                $start + 3,
                                                                $end - $start - 3,
                                                            );
                                                            echo $preview; // Menampilkan preview dari konten HTML
                                                        } else {
                                                            echo 'Gagal mengambil konten berita.';
                                                        }
                                                    } else {
                                                        echo 'Tidak ada paragraf yang ditemukan dalam konten berita.';
                                                    }
                                                } else {
                                                    echo 'Gagal mengambil konten berita.';
                                                }
                                            @endphp
                                        </div>

                                        <a href="{{ $item->deskripsi }}" target="_blank">Lihat Selengkapnya</a>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="blog-pagination">
                    <ul class="justify-content-center">
                        <li @if (!$beritalanding->previousPageUrl()) class="disabled" @endif>
                            <a @if ($beritalanding->previousPageUrl()) href="{{ $beritalanding->previousPageUrl() }}" @endif><i
                                    class="bi bi-arrow-left"></i></a>
                        </li>

                        @foreach ($beritalanding->links()->elements[0] as $page => $url)
                            @if ($page == $beritalanding->currentPage())
                                <li class="active"><a>{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <li @if (!$beritalanding->nextPageUrl()) class="disabled" @endif>
                            <a @if ($beritalanding->nextPageUrl()) href="{{ $beritalanding->nextPageUrl() }}" @endif><i
                                    class="bi bi-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

    </main>
@endsection
