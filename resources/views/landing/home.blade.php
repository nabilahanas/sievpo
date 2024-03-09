@extends('landing.page')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Sistem Informasi Eviden Poin Perum Perhutani KPH Semarang</h2>
                    <p>SIEVPO kelola data penilaian karyawan lebih mudah!</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="" class="btn-get-started">Data Karyawan</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="{{ asset('landingpage/assets/img/hero-img.svg') }}" class="img-fluid" alt=""
                        data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="col-xl-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box">
                        <h4 class="title"><a href="" class="stretched-link">173 Karyawan</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>About Us</h2>
                    <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat
                        sunt id nobis omnis tiledo stran delop</p>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-6">
                        <h3>Voluptatem dignissimos provident quasi corporis</h3>
                        <img src="{{ asset('landingpage/assets/img/about.jpg') }}" class="img-fluid rounded-4 mb-4"
                            alt="">
                        <p>Ut fugiat ut sunt quia veniam. Voluptate perferendis perspiciatis quod nisi et. Placeat
                            debitis quia recusandae odit et consequatur voluptatem. Dignissimos pariatur consectetur
                            fugiat voluptas ea.</p>
                        <p>Temporibus nihil enim deserunt sed ea. Provident sit expedita aut cupiditate nihil vitae quo
                            officia vel. Blanditiis eligendi possimus et in cum. Quidem eos ut sint rem veniam qui. Ut
                            ut repellendus nobis tempore doloribus debitis explicabo similique sit. Accusantium sed ut
                            omnis beatae neque deleniti repellendus.</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                                    voluptate velit.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                    storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident
                            </p>

                            <div class="position-relative mt-4">
                                <img src="{{ asset('landingpage/assets/img/about-2.jpg') }}" class="img-fluid rounded-4"
                                    alt="">
                                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action" class="call-to-action">
            <div class="container text-center" data-aos="zoom-out">
                <h3>Call To Action</h3>
                <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.</p>
            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= Our Services Section ======= -->
        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Berbagai Fitur SIEVPO</h2>
                    <p>Fitur-fitur SIEVPO untuk manajemen penilaian karyawan</p>
                </div>

                <!-- BIODATA KARYAWAN -->
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
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
                                    <div class="modal-footer">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-primary"
                                                onclick="window.location='/login'">Halaman Login</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- JADWAL KERJA -->
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#shiftingModal">
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
                        <div class="modal-dialog modal-dialog-centereds">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <p>Menu Shifting mudah digunakan dan dipahami oleh karyawan. Proses pengaturan shifting
                                        dapat dilakukan dengan cepat dan efisien. Menu shifting memungkinkan karyawan untuk
                                        mendapatkan jadwal kerja secara otomatis yang sesuai dengan kebutuhan mereka. Sistem
                                        shifting dapat membantu meningkatkan keseimbangan kehidupan kerja karyawan. Selain
                                        itu, menu shifting dapat membantu perusahaan mengoptimalkan penggunaan sumber daya
                                        manusia.</p>
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
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <p>Menu Kehadiran menyediakan antarmuka yang mudah digunakan untuk mencata absensi
                                        karyawan. Memungkinkan karyawan untuk mencatat absensi mereka sendiri melalui
                                        berbagai perangkat, seperti komputer dan smartphone. Meminimalisir kesalahan dalam
                                        pencatatan absensi serta menghemat waktu dan biaya dalam pengelolaan absensi
                                        karyawan</p>
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
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <p>Menu Pelacakan GPS memungkinkan perusahaan untuk mengetahui posisi karyawan saat
                                        melakukan absensi. Menu ini juga dapat membantu perusahaan dalam meningkatkan
                                        akurasi absensi, memantau karyawan, meningkatkan keamanan, dan mengintegrasikan data
                                        karyawan secara terpusat</p>
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
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <p>Menu Penilaian dirancang untuk membantu perusahaan dalam melakukan penilaian kinerja
                                        karyawan dengan mudah dan efisien, serta meminimalisir kesalahan dalam penilaian
                                        kinerja. Penilaian diatur berdasarkan jumlah poin yang diperoleh setiap karyawan.
                                    </p>
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
                                <h3>Rekapan Data Eviden Poin</h3>
                                <p>Rekapan data eviden poin karyawan tersimpan dengan baik dan mudah diakses</p>
                            </button>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="rekapModal" tabindex="-1" aria-labelledby="rekapModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <p>Menu Rekap Data dapat membantu perusahaan dalam meringkas dan menganalisa data
                                        karyawan dengan mudah, akurat, dan efisien. Memungkinkan pengguna untuk membuat
                                        berbagai jenis laporan rekap data dengan mudah serta meminimalisisr kesalahan dalam
                                        pembuatan</p>
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
                    <h2>Testimonials</h2>
                    <p>Voluptatem quibusdam ut ullam perferendis repellat non ut consequuntur est eveniet deleniti
                        fignissimos eos quam</p>
                </div>

                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('landingpage/assets/img/testimonials/testimonials-1.jpg') }}"
                                            class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>Saul Goodman</h3>
                                            <h4>Ceo &amp; Founder</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                        suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et.
                                        Maecen aliquam, risus at semper.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('landingpage/assets/img/testimonials/testimonials-2.jpg') }}"
                                            class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>Sara Wilsson</h3>
                                            <h4>Designer</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                        quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat
                                        irure amet legam anim culpa.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('landingpage/assets/img/testimonials/testimonials-3.jpg') }}"
                                            class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>Jena Karlis</h3>
                                            <h4>Store Owner</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                        veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis
                                        sint minim.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('landingpage/assets/img/testimonials/testimonials-4.jpg') }}"
                                            class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>Matt Brandon</h3>
                                            <h4>Freelancer</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore
                                        quem dolore.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('landingpage/assets/img/testimonials/testimonials-5.jpg') }}"
                                            class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>John Larson</h3>
                                            <h4>Entrepreneur</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                        noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam
                                        esse veniam culpa fore.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Portfolio</h2>
                    <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et
                        autem uia reprehenderit sunt deleniti</p>
                </div>

                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                    data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                    <div>
                        <ul class="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-product">Product</li>
                            <li data-filter=".filter-branding">Branding</li>
                            <li data-filter=".filter-books">Books</li>
                        </ul>
                    </div>

                    <div class="row gy-4 portfolio-container">

                        <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/app-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/app-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/product-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/product-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/branding-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/branding-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/books-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/books-1.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/app-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/app-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/product-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/product-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/branding-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/branding-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/books-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/books-2.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/app-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/app-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/product-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/product-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/branding-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/branding-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('landingpage/assets/img/portfolio/books-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="assets/img/portfolio/books-3.jpg" class="img-fluid" alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Our Team</h2>
                    <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt
                        quis dolorem dolore earum</p>
                </div>

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <img src="{{ asset('landingpage/assets/img/team/team-1.jpg') }}" class="img-fluid"
                                alt="">
                            <h4>Walter White</h4>
                            <span>Web Development</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <img src="{{ asset('landingpage/assets/img/team/team-2.jpg') }}" class="img-fluid"
                                alt="">
                            <h4>Sarah Jhinson</h4>
                            <span>Marketing</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <img src="{{ asset('landingpage/assets/img/team/team-3.jpg') }}" class="img-fluid"
                                alt="">
                            <h4>William Anderson</h4>
                            <span>Content</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="member">
                            <img src="{{ asset('landingpage/assets/img/team/team-4.jpg') }}" class="img-fluid"
                                alt="">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Our Team Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Pricing</h2>
                    <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat
                        sunt id nobis omnis tiledo stran delop</p>
                </div>

                <div class="row g-4 py-lg-5" data-aos="zoom-out" data-aos-delay="100">

                    <div class="col-lg-4">
                        <div class="pricing-item">
                            <h3>Free Plan</h3>
                            <div class="icon">
                                <i class="bi bi-box"></i>
                            </div>
                            <h4><sup>$</sup>0<span> / month</span></h4>
                            <ul>
                                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span>
                                </li>
                                <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis
                                        hendrerit</span></li>
                            </ul>
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="pricing-item featured">
                            <h3>Business Plan</h3>
                            <div class="icon">
                                <i class="bi bi-airplane"></i>
                            </div>

                            <h4><sup>$</sup>29<span> / month</span></h4>
                            <ul>
                                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                                <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                                <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
                            </ul>
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="pricing-item">
                            <h3>Developer Plan</h3>
                            <div class="icon">
                                <i class="bi bi-send"></i>
                            </div>
                            <h4><sup>$</sup>49<span> / month</span></h4>
                            <ul>
                                <li><i class="bi bi-check"></i> Quam adipiscing vitae proin</li>
                                <li><i class="bi bi-check"></i> Nec feugiat nisl pretium</li>
                                <li><i class="bi bi-check"></i> Nulla at volutpat diam uteera</li>
                                <li><i class="bi bi-check"></i> Pharetra massa massa ultricies</li>
                                <li><i class="bi bi-check"></i> Massa ultricies mi quis hendrerit</li>
                            </ul>
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Carousel Slide ======= -->
        <div class="row">
            <section class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="https://www.tokoperhutani.com/" target=”_blank”><img
                                            src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2024/01/tokophtArtboard-1@300x-50.jpg?fit=1366%2C600&ssl=1"
                                            class="d-block w-100" alt="Toko Perhutani"></a>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://i0.wp.com/www.perhutani.co.id/wp-content/uploads/2024/01/SMAP-WEBSITE-1.jpg?fit=1366%2C600&ssl=1"
                                        class="d-block w-100" alt="Kebijakan Anti Penyuapan">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main><!-- End #main -->
@endsection
