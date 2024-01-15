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
                  <a class="page-scroll active" href="#hero-area" onclick="handleNavLinkClick(event, 'hero-area')">Beranda</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#services" onclick="handleNavLinkClick(event, 'services')">Services</a>
                </li>

                <li class="nav-item">
                  <a class="page-scroll" href="#pricing" onclick="handleNavLinkClick(event, 'pricing')">Produk</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#blog" onclick="handleNavLinkClick(event, 'blog')">News</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#contact" onclick="handleNavLinkClick(event, 'contact')">Contact</a>
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
          {{-- <li><a href="{{ asset('ayro') }}/javascript:void(0)">About Us</a></li> --}}
          {{-- <li><a href="{{ asset('ayro') }}/javascript:void(0)">Our Team</a></li> --}}
          <li><a href="#blog">Latest News</a></li>
          <li><a href="#contact">Contact Us</a></li>
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

  @yield('content')

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
            {{-- <div class="col-lg-2 col-md-6 col-12">
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
            </div> --}}
            {{-- <div class="col-lg-2 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-link">
                <h5>Support</h5>
                <ul>
                  <li><a href="#">Pricing</a></li>
                  <li><a href="#">Documentation</a></li>
                  <li><a href="#">Galery</a></li>
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
            </div> --}}
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

    <script>
        // Fungsi untuk menangani klik tombol navigasi
        function handleNavLinkClick(event, targetElementId) {
        event.preventDefault();
    
        // Cek apakah elemen dengan ID targetElementId ada pada halaman
        const targetElement = document.getElementById(targetElementId);
        if (targetElement) {
            // Jika ada, lakukan scroll ke elemen tersebut
            targetElement.scrollIntoView({ behavior: 'smooth' });
        } else {
            // Jika tidak ada, arahkan ke link lain (misalnya halaman lain atau halaman utama)
            const otherLink = '/';
            window.location.href = otherLink + '#' + targetElementId;
    
            // Jika Anda ingin menambahkan ID juga dalam link arahannya, Anda bisa menggabungkan targetElementId dan otherLink
            // Misalnya, window.location.href = otherLink + '#' + targetElementId;
            // Ini akan mengarahkan pengguna ke link-lain-yang-diinginkan#blog (contoh jika targetElementId adalah 'blog')
        }
        }
    </script>
    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/65a4c3c40ff6374032c04ba8/1hk5ppe3n';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script> --}}
    <!--End of Tawk.to Script-->
  
  
  
</body>

</html>