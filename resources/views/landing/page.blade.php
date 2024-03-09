<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIEVPO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landingpage/assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('landingpage/assets/img/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landingpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('landingpage/assets/css/main.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.css"> --}}
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="landingpage\assets\img\perhutani.png" alt="perhutani" width="150">
                <h1>SIEVPO</h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="/">Beranda</a></li>
                    <li class="dropdown"><a href=""><span>Tentang Kami</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="/profilekph">Profil Perusahaan</a></li>
                            <li><a href="/visimisikph">Visi, Misi, dan Tata Nilai</a></li>
                            <li><a href="/strukturkph">Struktur Organisasi</a></li>
                            <li><a href="/datakaryawankph">Data Karyawan</a></li>
                        </ul>
                    </li>
                    <li><a href="/beritakph">Berita</a></li>
                    {{-- <li><a href="/fitur">Fitur</a></li> --}}
                    <li><a href="/login" class="btn-perhutani">Masuk</a></li>
                </ul>
            </nav><!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list" style="color: #016237"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x" style="color: #016237"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <div>
        @yield('content')
    </div>
</body>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <a href="/" class="logo d-flex align-items-center">
                    <span>Perhutani</span>
                </a>
                <p>Perhutani adalah Badan Usaha Milik Negara berbentuk Perusahaan Umum (Perum) yang memiliki tugas
                    dan wewenang untuk mengelola sumberdaya hutan negara di pulau Jawa dan Madura.</p>
                <div class="social-links d-flex mt-4">
                    <a href="https://www.facebook.com/perumperhutani/" target=”_blank”><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com/perumperhutani" target=”_blank”><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.instagram.com/perumperhutani/?hl=id" target=”_blank”><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.tiktok.com/@perum.perhutani" target=”_blank”><i class="bi bi-tiktok"></i></a>
                    <a href="https://www.youtube.com/channel/UCmMvplsIxDZLQeusTWlLE2w" target=”_blank”><i
                            class="bi bi-youtube"></i></a>
                    <a href="https://www.linkedin.com/company/perum-perhutani/" target=”_blank”><i
                            class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Tentang Kami</h4>
                <ul>
                    <li><a href="/profilekph">Profil Perusahaan</a></li>
                    <li><a href="/visimisikph">Visi, Misi, dan Tata Nilai</a></li>
                    <li><a href="/strukturkph">Struktur Organisasi</a></li>
                    <li><a href="/datakaryawankph">Data Karyawan</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Fitur</h4>
                <ul>
                    <li><a>Aplikasi Biodata Karyawan</a></li>
                    <li><a>Aplikasi Jadwal Kerja (Shifting)</a></li>
                    <li><a>Aplikasi Kehadiran</a></li>
                    <li><a>Aplikasi Pelacakan GPS</a></li>
                    <li><a>Aplikasi Penilaian</a></li>
                    <li><a>Aplikasi Rekapan Data Eviden Poin</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 footer-contact text-md-start">
                <h4>Alamat</h4>
                <p>
                    Perum Perhutani KPH Semarang Divisi Regional Jawa Tengah <br>
                    <i class="fas fa-map-marker-alt mr-2"></i>Jl. Cipto No. 99, Semarang, Kode Pos:
                    50552<br>
                    <i class="fas fa-phone-alt mr-2"></i>(024) 254326<br>
                    <i class="fas fa-building mr-2"></i>(024) 354621<br>
                    <i class="fas fa-envelope mr-2"></i>kph.semarang@perhutani.co.id<br>
                </p>
            </div>
        </div>
    </div>
</footer>


<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('landingpage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('landingpage/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('landingpage/assets/js/main.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
