@extends('landing.page')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero"
        style="background-image: url('{{ asset('landingpage/assets/img/hero.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Sistem Informasi Eviden Poin Perum Perhutani KPH Semarang</h2>
                    <p>SIEVPO kelola data penilaian karyawan lebih mudah!</p>
                </div>
            </div>
            <div class="row gy-5" data-aos="fade-in">
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#call-to-action" class="btn-get-started">Apa itu SIEVPO?</a>
                    <a href="#services" class="btn-get-started">Fitur SIEVPO</a>
                    <a href="#testimonials" class="btn-get-started">Keunggulan SIEVPO</a>
                </div>
            </div>
        </div>
        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <a href="/datakaryawankph">
                            <div class="icon-box">
                                <h2 class="counter"><span data-purecounter-start="0"
                                        data-purecounter-end="{{ $karyawan }}" data-purecounter-duration="1"
                                        class="purecounter"></span></h2>
                                <h3>Karyawan</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <a href="/wilayah">
                            <div class="icon-box">
                                <h2 class="counter"><span data-purecounter-start="0" data-purecounter-end="2"
                                        data-purecounter-duration="1" class="purecounter"></span></h2>
                                <h3>Wilayah</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <a href="/wilayah">
                            <div class="icon-box">
                                <h2 class="counter"><span data-purecounter-start="0"
                                        data-purecounter-end="{{ $bidang }}" data-purecounter-duration="1"
                                        class="purecounter"></span></h2>
                                <h3>Bidang</h3>
                            </div>
                        </a>
                    </div>

                    {{-- <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <h2 class="counter"><span data-purecounter-start="0" data-purecounter-end="16"
                                    data-purecounter-duration="1" class="purecounter"></span></h2>
                            <h3>Jam Kerja</h3>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action" class="call-to-action">
            <div class="logo d-flex align-items-center justify-content-center" data-aos="fade">
                <img src="{{ asset('landingpage/assets/img/perhutani-2.png') }}" width="300" alt="Logo Perhutani">
            </div>
            <div class="container" data-aos="zoom-out">
                <div class="row">
                    <div class="col-md-6 text-justify">
                        <img src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2021/08/WhatsApp-Image-2021-08-03-at-14.35.15-2.jpeg"
                        class="img-fluid rounded-4 mb-4" alt="Kantor Perhutani" height="400">                    
                    </div>
                    <div class="col-md-6 text-justify">
                        <h3>Apa itu SIEVPO?</h3>
                        <p>Eviden poin merupakan program Perum Perhutani Divisi Regional Jawa Tengah untuk menilai kinerja
                            karyawan
                            lapangannya. Program ini dilakukan agar dapat mengawasi keberadaan dan posisi karyawan lapangan
                            yang
                            sedang bertugas. Program ini juga bertujuan agar para karyawan dapat lebih fokus, disiplin,
                            produktif,
                            dan inovatif.
                        </p>
                        <p>
                            Perum Perhutani KPH Semarang juga menerapkan program tersebut ke karyawan lapangannya. Sistem
                            Informasi
                            Eviden Poin (SIEVPO) Perum Perhutani KPH Semarang ini, diharapkan dapat membantu dan
                            mempersingkat waktu
                            Perum Perhutani KPH Semarang dalam melakukan pendataan dan penilaian karyawan. Selain itu,
                            sistem
                            informasi ini diharapkan dapat mengurangi kesalahan manusia yang terjadi jika pendataan
                            dilakukan secara
                            manual dan sendirian.
                        </p>
                    </div>
                </div>
            </div>

        </section><!-- End Call To Action Section -->

        <!-- ======= Our Services Section ======= -->
        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Berbagai Fitur SIEVPO</h2>
                    <p>Fitur-fitur SIEVPO untuk manajemen penilaian karyawan</p>
                </div>

                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">


                    <!-- BIODATA KARYAWAN -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
                            {{-- <div id="overlay" onclick="off()"></div> --}}
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#biodataModal">
                                <div class="icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h3>Biodata Karyawan</h3>
                                <p>Kemudahan dalam mengelola data karyawan</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="biodataModal" tabindex="-1" aria-labelledby="biodataModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="biodataModalLabel">Biodata Karyawan?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Biodata Karyawan ini menyimpan informasi penting karyawan, seperti nama lengkap,
                                        NIP, jabatan, wilayah, dan sebagainya. Menu ini memudahkan akses data karyawan
                                        kapanpun dan di manapun. Bagi perusahaan, menu ini dapat membantu mengelola data
                                        karyawan dengan mudah dan efisien. Dengan menggunakan menu ini, perusahaan dapat
                                        meningkatkan keakuratan data karyawan, membuat keputusan yang lebih baik terkait
                                        SDM, dan meningkatkan efisiensi dalam pengelolaan SDM.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- JADWAL KERJA -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#shiftingModal">
                                <div class="icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>
                                <h3>Jadwal Kerja (Shifting)</h3>
                                <p>Jadwal jam kerja atau shifting dengan mudah dan tidak rumit</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="shiftingModal" tabindex="-1" aria-labelledby="shiftingModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="shiftingModalLabel">Jadwal Kerja (Shifting)?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Shifting mudah digunakan dan dipahami oleh karyawan. Proses pengaturan
                                        shifting
                                        dapat dilakukan dengan cepat dan efisien. Menu shifting memungkinkan karyawan
                                        untuk
                                        mendapatkan jadwal kerja secara otomatis yang sesuai dengan kebutuhan mereka.
                                        Sistem
                                        shifting dapat membantu meningkatkan keseimbangan kehidupan kerja karyawan.
                                        Selain
                                        itu, menu shifting dapat membantu perusahaan mengoptimalkan penggunaan sumber
                                        daya
                                        manusia.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KEHADIRAN -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#kehadiranModal">
                                <div class="icon">
                                    <i class="bi bi-person-fill-check"></i>
                                </div>
                                <h3>Kehadiran</h3>
                                <p>Absensi karyawan lebih mudah</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="kehadiranModal" tabindex="-1" aria-labelledby="kehadiranModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="kehadiranModalLabel">Biodata Karyawan?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Kehadiran menyediakan antarmuka yang mudah digunakan untuk mencata absensi
                                        karyawan. Memungkinkan karyawan untuk mencatat absensi mereka sendiri melalui
                                        berbagai perangkat, seperti komputer dan smartphone. Meminimalisir kesalahan
                                        dalam
                                        pencatatan absensi serta menghemat waktu dan biaya dalam pengelolaan absensi
                                        karyawan</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PELACAKAN GPS -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#pelacakanModal">
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <h3>Pelacakan GPS</h3>
                                <p>Ketahui posisi karyawan saat melakukan absensi</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="pelacakanModal" tabindex="-1" aria-labelledby="pelacakanModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="pelacakanModalLabel">Pelacakan GPS?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Pelacakan GPS memungkinkan perusahaan untuk mengetahui posisi karyawan saat
                                        melakukan absensi. Menu ini juga dapat membantu perusahaan dalam meningkatkan
                                        akurasi absensi, memantau karyawan, meningkatkan keamanan, dan mengintegrasikan
                                        data
                                        karyawan secara terpusat</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PENILAIAN-->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#penilaianModal">
                                <div class="icon">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>
                                <h3>Penilaian</h3>
                                <p>Pengisian eviden poin karyawan otomatis dan lebih cepat</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="penilaianModalLabel">Penilaian?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Penilaian dirancang untuk membantu perusahaan dalam melakukan penilaian
                                        kinerja
                                        karyawan dengan mudah dan efisien, serta meminimalisir kesalahan dalam penilaian
                                        kinerja. Penilaian diatur berdasarkan jumlah poin yang diperoleh setiap
                                        karyawan.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- REKAPAN DATA EVIDEN POIN -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#rekapModal">
                                <div class="icon">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </div>
                                <h3>Rekap Data Eviden Poin</h3>
                                <p>Rekap data eviden poin karyawan tersimpan dengan baik dan mudah diakses</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="rekapModal" tabindex="-1" aria-labelledby="rekapModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="biodataModalLabel">Rekapan Data Eviden Poin?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Menu Rekap Data dapat membantu perusahaan dalam meringkas dan menganalisa data
                                        karyawan dengan mudah, akurat, dan efisien. Memungkinkan pengguna untuk membuat
                                        berbagai jenis laporan rekap data dengan mudah serta meminimalisisr kesalahan
                                        dalam
                                        pembuatan</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="window.location='/login'">Halaman Login<i
                                            class="fas fa-angle-double-right ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Our Services Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Keunggulan SIEVPO</h2>
                </div>
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-item position-relative">
                            <div class="icon">
                                <i class="bi bi-shield-fill-check"></i>
                            </div>
                            <h3>Keamanan Data</h3>
                            <p>Semua data pribadi dan eviden poin milik karyawan tersimpan dengan aman</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-item position-relative">
                            <div class="icon">
                                <i class="bi bi-info-circle-fill"></i>
                            </div>
                            <h3>Informatif</h3>
                            <p>Informasi terbaru seperti berita dan pengumuman mudah didapatkan</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-item position-relative">
                            <div class="icon">
                                <i class="bi bi-display"></i>
                            </div>
                            <h3>Multi-Perangkat</h3>
                            <p>Aplikasi bisa digunakan pada perangkat laptop dan smartphone</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Carousel Slide ======= -->
        <section id="carousel" class="carousel">
            <div id="carouselIndicators" class="carousel slide carousel-fade" data-bs-ride="true" data-aos="zoom-out">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="https://www.tokoperhutani.com/" target=”_blank”
                            style="text-decoration: none; color: transparent;">Toko Perhutani<img
                                src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2024/01/tokophtArtboard-1@300x-50.jpg"
                                class="d-block w-100" alt="Toko Perhutani">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2024/01/Program-Kerja-2024.jpg"
                            class="d-block w-100" alt="Program Kerja">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2024/01/SMAP-WEBSITE-1.jpg"
                            class="d-block w-100" alt="Kebijakan Anti Penyuapan">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
