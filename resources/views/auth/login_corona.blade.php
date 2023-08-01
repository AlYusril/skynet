@extends('auth.app_corona_auth')

@section('content')
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5">
            <h3 class="card-title text-center mb-3">
              {{-- <img src="{{ asset('corona/assets/images/logo.png') }}" alt="" srcset="" width="120"> --}}
              Login
            </h3>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label>Email *</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="form-group">
                <label>Password *</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="form-group d-flex align-items-center justify-content-between">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember"> Remember me </label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-pass">Forgot password</a>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
              </div>
              
              <p class="sign-up">Jika belum memiliki akun, silahkan hubungi admin kami, via <a href="https://wa.me/6285755556574" target="_blank"> Whatsapp</a></p>
            </form>
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