@extends('auth.app_corona_auth')

@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-4 py-4">
              <div class="card-title mb-4">
                <h3 class="text-center">Reset Password</h3>
                <h4 class="text-left mt-5 mb-0">Lupa Password? <i class="mdi mdi-lock text-warning"></i></h4>
                <span class="text-muted mt-0">Masukan email anda, dan ikuti instruksi untuk reset password.</span>
              </div>
              <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                  <label for="email">Email *</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Kirim Link Reset') }}
                    </button>
                </div>
              </form>
                <div class="alert alert-info mt-3" role="alert">
                    Jika ada kendala bisa minta bantuan admin kami, <a href="https://wa.me/6285755556574" target="_blank">Whatsapp</a>
                </div>
                <div class="sign-up">
                    <a href="{{ route('login') }}"><< Kembali ke halaman login</a>
                </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@endsection
