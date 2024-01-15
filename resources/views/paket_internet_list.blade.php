@extends('app_ayro')
@section('content')

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

@endsection