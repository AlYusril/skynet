<!DOCTYPE html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--====== Title ======-->
  <title>{{ $title ?? '' }} {{ settings()->get('app_name', 'My APP') }}</title>

  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('ayro') }}/../assets/images/favicon.svg" type="image/svg" />

  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/bootstrap.min.css" />

  <!--====== Line Icons css ======-->
  <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/lineicons.css" />

  <!--====== Tiny Slider css ======-->
  <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/tiny-slider.css" />

  <!--====== gLightBox css ======-->
  <link rel="stylesheet" href="{{ asset('ayro') }}/assets/css/glightbox.min.css" />

  <link rel="stylesheet" href="{{ asset('ayro') }}/style.css" />
  <style>
    /* .amount {
        display: flex;
        align-items: center;
    }

    .currency {
        margin-right: 5px;
    } */

    /* Gaya tambahan untuk mengatur posisi teks "Rp." */
    /* .amount b {
        display: inline-block;
        width: 15px;
    } */
    /* CSS */
    .single-news .image {
      position: relative;
      width: 100%; /* Atur lebar gambar sesuai kebutuhan */
      height: 0;
      padding-bottom: 60%; /* Atur tinggi gambar sesuai kebutuhan */
      overflow: hidden;
    }

    .single-news .thumb {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain; /* Mengubah ukuran gambar agar sesuai dengan lebar dan tinggi yang diatur */
      object-position: center; /* Menengahkan gambar di dalam container */
    }

    /* Tambahan gaya CSS lainnya untuk menyesuaikan tampilan sesuai kebutuhan */

  </style>
  <style>

    /* Gaya untuk gambar di dalam slider */
    .slider img {
      width: auto; /* Gambar akan mengisi seluruh lebar kontainer slider */
      max-height: 400px; /* Tinggi gambar akan menyesuaikan agar gambar tidak terdistorsi */
    }
  
    .slick-prev, .slick-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 1;
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      border: none;
      padding: 10px;
      cursor: pointer;
    }
  
    .slick-prev {
      left: 10px;
    }
  
    .slick-next {
      right: 10px;
    }
  
    .slick-dots {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1;
    }
  
    .slick-dots li button:before {
      color: #fff;
      font-size: 14px;
    }
  </style>
  
  <!-- Di bagian head atau sebelum bagian body tag -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

</head>

<body>

  <!--====== NAVBAR NINE PART START ======-->

  <section class="navbar-area navbar-nine">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="">
                <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="150"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNine"
              aria-controls="navbarNine" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarNine">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="page-scroll active" href="#hero-area">Beranda</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#services">Services</a>
                </li>

                <li class="nav-item">
                  <a class="page-scroll" href="#pricing">Produk</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#blog">News</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" target="_blank">Login</a>
                  </li>
              </ul>
            </div>

            <div class="navbar-btn d-none d-lg-inline-block">
              <a class="menu-bar" href="#side-menu-left"><i class="lni lni-menu"></i></a>
            </div>
          </nav>
          <!-- navbar -->
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </section>

  <!--====== NAVBAR NINE PART ENDS ======-->

  <!--====== SIDEBAR PART START ======-->

  <div class="sidebar-left">
    <div class="sidebar-close">
      <a class="close" href="#close"><i class="lni lni-close"></i></a>
    </div>
    <div class="sidebar-content">
      <div class="sidebar-logo">
        <a href=""><img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="120"/></a>
      </div>
      <p class="text">{{ Settings('app_slogan') }}</p>
      <!-- logo -->
      <div class="sidebar-menu">
        <h5 class="menu-title">Quick Links</h5>
        <ul>
          <li><a href="{{ asset('ayro') }}/javascript:void(0)">About Us</a></li>
          <li><a href="{{ asset('ayro') }}/javascript:void(0)">Our Team</a></li>
          <li><a href="{{ asset('ayro') }}/javascript:void(0)">Latest News</a></li>
          <li><a href="{{ asset('ayro') }}/javascript:void(0)">Contact Us</a></li>
        </ul>
      </div>
      <!-- menu -->
      <div class="sidebar-social align-items-center justify-content-center">
        <h5 class="social-title">Follow Us On</h5>
        <ul>
          <li>
            <a href="{{ asset('ayro') }}/javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
          </li>
          <li>
            <a href="{{ asset('ayro') }}/javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
          </li>
          <li>
            <a href="{{ asset('ayro') }}/javascript:void(0)"><i class="lni lni-linkedin-original"></i></a>
          </li>
          <li>
            <a href="{{ asset('ayro') }}/javascript:void(0)"><i class="lni lni-youtube"></i></a>
          </li>
        </ul>
      </div>
      <!-- sidebar social -->
    </div>
    <!-- content -->
  </div>
  <div class="overlay-left"></div>

  <!--====== SIDEBAR PART ENDS ======-->

  <!-- Start header Area -->
  <section id="hero-area" class="header-area header-eight">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-content">
            <h1>{{ settings()->get('app_name') }}</h1>
            <p>
              {{ Settings('app_slogan') }}
            </p>
            <div class="button">
              <a href="#pricing" class="btn primary-btn">Get Started</a>
              {{-- <a href="{{ asset('ayro') }}/https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
                class="glightbox video-button">
                <span class="btn icon-btn rounded-full">
                  <i class="lni lni-play"></i>
                </span>
                <span class="text">Watch Intro</span>
              </a> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-image slider">
            @forelse ($slider as $item)
              <img src="{{ \Storage::url($item->gambar) }}" alt="slider" />
            @empty
              <img src="{{ asset('ayro') }}/assets/images/header/hero-image.jpg" alt="#" />
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End header Area -->

  <!-- ===== service-area start ===== -->
  <section id="services" class="services-area services-eight">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Services</h6>
              <h2 class="fw-bold">Our Best Services</h2>
              <p>
                Temukan solusi terbaik untuk konektifitas internet, guna memperlancar bisnis anda.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        @forelse ($services as $item)
          <div class="col-lg-4 col-md-6">
            <div class="single-services">
              <div class="service-icon">
                <i class="lni lni-{{ $item->gambar }}"></i>
              </div>
              <div class="service-content">
                <h4>{{ $item->judul }}</h4>
                <p>
                  {!! htmlspecialchars_decode($item->konten) !!}
                </p>
              </div>
            </div>
          </div>
        @empty
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-bootstrap"></i>
            </div>
            <div class="service-content">
              <h4>Internet Broadband</h4>
              <p>
                Layanan ini sangat cocok untuk bisnis UMKM, retail, 
                rumahan yang membutuhkan koneksi internet cepat, tepat dan harga terjangkau.
              </p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>
  <!-- ===== service-area end ===== -->


  <!-- Start Pricing  Area -->
  <section id="pricing" class="pricing-area pricing-fourteen">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Paket Home</h6>
              <h2 class="fw-bold">Paket Internet Unlimited</h2>
              <p>
                Temukan pilihan paket internet anda.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        @foreach ($models as $item)
          <div class="col-lg-4 col-md-6 col-12">
            <div class="pricing-style-fourteen">
              <div class="table-head">
                <h6 class="title">{{ $item->nama }}</h4>
                  <p>{{ $item->keterangan }}</p>
                  <div class="price">
                    <h2 class="amount">
                      <span class="currency"><b class="rupiah">Rp.</b></span>{{ substr($item->total_tagihan, 0, -3) }}<span class="duration"><b>.000</b> <br>/Bulan </span>
                    </h2>
                  </div>
              </div>

              <div class="light-rounded-buttons">
                <a href="#contact" class="btn primary-btn-outline btnBerlangganan" data-id="{{ $item->id }}">
                  Berlangganan
                </a>
              </div>

              <div class="table-content">
                <ul class="table-list">
                  <li> <i class="lni lni-checkmark-circle"></i> Internet Unlimited</li>
                  <li> <i class="lni lni-checkmark-circle"></i> Ratio 1:2 Up/Down </li>
                  <li> <i class="lni lni-checkmark-circle"></i> Support 24/7</li>
                  <li> <i class="lni lni-checkmark-circle"></i> Excepteur sint occaecat velit.</li>
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!--/ End Pricing  Area -->

  <!-- Start Latest News Area -->
  <div id="blog" class="latest-news-area section">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>berita terbaru</h6>
              <h2 class="fw-bold">Berita dan Karir</h2>
              {{-- <p>
                There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered alteration in some form.
              </p> --}}
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        @forelse ($berita as $item)
          <div class="col-lg-4 col-md-6 col-12 grid-margin stretch-card">
            <!-- Single News -->
            <div class="single-news">
              <div class="image text-center">
                {{-- <a href="#zoom-popup" class="popup-link"><img class="thumb" src="{{ \Storage::url($item->gambar) }}" alt="Blog"/></a> --}}
                <a href="#" class="popup-link" data-mfp-src="{{ \Storage::url($item->gambar) }}"><img class="thumb" src="{{ \Storage::url($item->gambar) }}" alt="Blog"/></a>
                {{-- <div class="meta-details">
                  <img class="thumb" src="{{ asset('ayro') }}/assets/images/blog/b6.jpg" alt="Author" />
                  <span>BY TIM NORTON</span>
                </div> --}}
              </div>
              <div class="content-body">
                <h4 class="title">
                  <a href="#"> {{ $item->judul }} </a>
                </h4>
                <p>
                  {!! htmlspecialchars_decode($item->konten) !!}
                </p>
              </div>
            </div>
            <!-- End Single News -->
            <!-- Konten Popup -->
            {{-- <div id="zoom-popup" class="mfp-hide">
              <img src="{{ \Storage::url($item->gambar) }}" alt="Zoomed Image">
            </div> --}}
          </div>
        @empty
            Empty
        @endforelse
      </div>
    </div>
  </div>
  <!-- End Latest News Area -->

  <!-- ========================= contact-section start ========================= -->
  <section id="contact" class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-4">
          <div class="contact-item-wrapper">
            <div class="row">
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-phone"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Contact</h4>
                    <p>{{ formatNomorHp(settings()->get('app_phone')) }}</p>
                    <p>{{ settings()->get('app_email') }}</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-map-marker"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Address</h4>
                    <p>{{ settings()->get('app_address') }}</p>
                    <p>Jawa Timur</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-alarm-clock"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Support</h4>
                    <p>24 Hours / 7 Days Open</p>
                    <p>Office time: 08:00 - 16:30</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="contact-form-wrapper">
            <div class="row">
              <div class="col-xl-10 col-lg-8 mx-auto">
                <div class="section-title text-center">
                  <span> Daftar </span>
                  <h2>
                    Form Daftar Berlangganan
                  </h2>
                  <p>
                    Isi form dibawah ini sesuai dengan data diri anda, dan pilih paket internet yang anda inginkan
                  </p>
                </div>
              </div>
            </div>
            <form action="{{ route('landingpage.store') }}" method="post" class="contact-form">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="nama" id="name" placeholder="Nama" required />
                </div>
                <div class="col-md-6">
                  <input type="email" name="email" id="email" placeholder="Email (optional)" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="nohp" id="phone" placeholder="Nomor HP" required />
                </div>
                <div class="col-md-6">
                  {!! Form::select('biaya_id', $listBiaya, null, ['class' => 'form-control', 'name' => 'biaya', 'id' => 'selectBiaya']) !!}
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <textarea name="alamat" id="message" placeholder="Alamat" rows="3"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="button text-center rounded-buttons">
                    <button type="submit" class="btn primary-btn rounded-full">
                      DAFTAR
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ========================= contact-section end ========================= -->

  <!-- ========================= map-section end ========================= -->
  <section class="map-section map-style-9 mt-3">
    <div class="map-container">
      <object style="border:0; height: 500px; width: 100%;"
        data="{{ Settings('app_maps') }}"></object>
    </div>
    </div>
  </section>
  <!-- ========================= map-section end ========================= -->

<!-- Start Brand Area -->
<div id="clients" class="brand-area section">
  <!--======  Start Section Title Five ======-->
  <div class="section-title-five">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            {{-- <h6>Meet our Clients</h6> --}}
            <h2 class="fw-bold">Our Sponsorship</h2>
            {{-- <p>
              There are many variations of passages of Lorem Ipsum available,
              but the majority have suffered alteration in some form.
            </p> --}}
          </div>
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </div>
  <!--======  End Section Title Five ======-->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 col-12">
        <div class="clients-logos">
          @forelse ($sponsor as $item)
            <div class="single-image">
              <img src="{{ \Storage::url($item->gambar) }}" alt="Brand Logo Images" />
            </div>
          @empty
            <div class="single-image">
              <h2>Data Kosong</h2>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Brand Area -->

  <!-- Start Footer Area -->
  <footer class="footer-area footer-eleven">
    <!-- Start Footer Top -->
    <div class="footer-top">
      <div class="container">
        <div class="inner-content">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-about">
                <div class="logo">
                  <a href="">
                    <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="120"/>
                  </a>
                </div>
                <p>
                  {{ Settings('app_slogan') }}
                </p>
                <p class="copyright-text">
                  <span>© 2023 {{ settings()->get('app_name') }}.</span>Designed and Developed by
                  <a href="mailto:yusrilefendi12345@gmail.com" rel="nofollow"> Al Yusril </a>
                </p>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-2 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-link">
                <h5>Solutions</h5>
                <ul>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Marketing</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Analytics</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Commerce</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Insights</a></li>
                </ul>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-2 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-link">
                <h5>Support</h5>
                <ul>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Pricing</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Documentation</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">Guides</a></li>
                  <li><a href="{{ asset('ayro') }}/javascript:void(0)">API Status</a></li>
                </ul>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget newsletter">
                <h5>Subscribe</h5>
                <p>Subscribe to our newsletter for the latest updates</p>
                <form action="#" method="get" target="_blank" class="newsletter-form">
                  <input name="EMAIL" placeholder="Email address" required="required" type="email" />
                  <div class="button">
                    <button class="sub-btn">
                      <i class="lni lni-envelope"></i>
                    </button>
                  </div>
                </form>
              </div>
              <!-- End Single Widget -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ End Footer Top -->
  </footer>
  <!--/ End Footer Area -->

	{{-- <div class="made-in-ayroui mt-4">
		<a href="{{ asset('ayro') }}/https://ayroui.com" target="_blank" rel="nofollow">
		  <img style="width:220px" src="{{ asset('ayro') }}/assets/images/ayroui.svg">
		</a>
	</div> --}}

  <a href="#hero-area" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
  </a>

  <!--====== js ======-->
  <script src="{{ asset('ayro') }}/assets/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('ayro') }}/assets/js/glightbox.min.js"></script>
  <script src="{{ asset('ayro') }}/assets/js/main.js"></script>
  <script src="{{ asset('ayro') }}/assets/js/tiny-slider.js"></script>
  <!-- Sebelum penutupan body tag -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
				
  <script>

    //===== close navbar-collapse when a  clicked
    let navbarTogglerNine = document.querySelector(
      ".navbar-nine .navbar-toggler"
    );
    navbarTogglerNine.addEventListener("click", function () {
      navbarTogglerNine.classList.toggle("active");
    });

    // ==== left sidebar toggle
    let sidebarLeft = document.querySelector(".sidebar-left");
    let overlayLeft = document.querySelector(".overlay-left");
    let sidebarClose = document.querySelector(".sidebar-close .close");

    overlayLeft.addEventListener("click", function () {
      sidebarLeft.classList.toggle("open");
      overlayLeft.classList.toggle("open");
    });
    sidebarClose.addEventListener("click", function () {
      sidebarLeft.classList.remove("open");
      overlayLeft.classList.remove("open");
    });

    // ===== navbar nine sideMenu
    let sideMenuLeftNine = document.querySelector(".navbar-nine .menu-bar");

    sideMenuLeftNine.addEventListener("click", function () {
      sidebarLeft.classList.add("open");
      overlayLeft.classList.add("open");
    });

    //========= glightbox
    // GLightbox({
    //   'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
    //   'type': 'video',
    //   'source': 'youtube', //vimeo, youtube or local
    //   'width': 900,
    //   'autoplayVideos': true,
    // });

  </script>
  <!-- JavaScript -->
  <script>
    $(document).ready(function() {
      $('.popup-link').magnificPopup({
        type: 'image',
        gallery: {
          enabled: true
        }
      });
    });
  </script>
  <script>
    $(document).ready(function(){
      $('.slider').slick({
        autoplay: true,
        dots: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-arrow-right"></i></button>',
      });
    });
  </script> 
<script>
$(document).ready(function () {
    // Ambil elemen tombol berdasarkan kelas (class)
    var btnBerlangganan = $(".btnBerlangganan");

    // Tambahkan event listener pada tombol
    btnBerlangganan.on("click", function (event) {
        event.preventDefault();

        // Ambil nilai id dari atribut data-id pada tombol yang diklik
        var itemId = $(this).data("id");

        // Atur nilai pada elemen select dengan nilai id yang sesuai
        $("#selectBiaya").val(itemId);

        // Ambil target dari atribut href tombol
        var target = $(this).attr("href");

        // Cek apakah target adalah sebuah ID yang ada di halaman
        if ($(target).length) {
            // Gulirkan halaman ke bawah menuju elemen dengan ID target
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 200); // Durasi animasi dalam milidetik (misalnya, 1000 = 1 detik)
        }
    });
});

  </script>
  
</body>

</html>