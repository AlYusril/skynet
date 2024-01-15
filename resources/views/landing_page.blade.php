@extends('app_ayro')
@section('content')
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
              <h6>Paket PROMO !!!</h6>
              <h2 class="fw-bold">Paket Internet Unlimited</h2>
              <p>
                Temukan pilihan paket internet anda. <a href="{{ route('paket.data') }}">List Paket Lengkap</a>
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
                      <span class="currency"><b>Rp.</b></span>{{ substr($item->total_tagihan, 0, -3) }}<span class="duration"><b>.000</b> <br>/Bulan </span>
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
                  <li> <i class="lni lni-checkmark-circle"></i> Ping Stabil</li>
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
                <div class="contact-item" style="display: grid; grid-template-columns: auto 1fr;">
                    <div class="contact-icon">
                        <i class="lni lni-map-marker" style="font-size: 30px;"></i>
                    </div>
                    <div class="contact-content">
                        <h4>Address</h4>
                        <p>{{ settings()->get('app_address') }}</p>
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
@endsection