<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? '' }} {{ settings()->get('app_name', 'My APP') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/select2/select2.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('corona') }}/assets/images/favicon.png" />
    {{-- <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}"/> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .thead-dark {
        color: #fff !important;
        background-color: #343a40 !important;
      }

      .informasi-pembayaran {
        background-color: rgb(54, 58, 61) !important;
        color: white;
        padding: 10px;
      }

      /* Mengubah warna teks menjadi putih saat mengetik di form */
      .form-group label,
        .form-control {
        color: #fff;
        }
      .form-control:focus {
        color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      }
    </style>
    <script>
      popupCenter = ({url, title, w, h}) => {
        // Fixes dual-screen position                             Most browsers      Firefox
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title, 
          `
          scrollbars=yes,
          width=${w / systemZoom}, 
          height=${h / systemZoom}, 
          top=${top}, 
          left=${left}
          `
        )

        if (window.focus) newWindow.focus();
      }
    </script>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          {{-- <span class="sidebar-brand brand-logo font-weight-bold text-white">SKYNET</span> --}}
          <a class="sidebar-brand brand-logo" href="{{ route('admin.beranda') }}"><img src="{{ \Storage::url(settings()->get('app_logo')) ?? 'assets\logo.png' }}" style="width: 90px; height:auto;" alt="logo"/></a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('client.beranda') }}"><h2 class="font-weight-bold text-white">S</h2></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="{{ auth()->user()->unreadNotifications->count() >= 1 ? 'count-indicator':'' }}">
                  <img class="img-xs rounded-circle " src="{{ \Storage::url(Auth::user()->foto ?? 'no-images.jpeg') }}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                  <span>{{ Auth::user()->email }}</span>
                </div>
              </div>
              <a href="{{ asset('corona') }}/#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{ route('client.profil.create') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('client.profil.index') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items {{ \Route::is('client.beranda') ? 'active' : '' }}">
            <a href="{{ route('client.beranda') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item menu-items {{ \Route::is('client.member.*') ? 'active' : '' }}">
            <a href="{{ route('client.member.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Pelanggan Aktif</span>
            </a>
          </li>

          <li class="nav-item menu-items {{ \Route::is('client.tagihan.*') || \Route::is('client.pembayaran.*') ? 'active' : '' }}">
            <a href="{{ route('client.tagihan.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Data Tagihan</span>
            </a>
          </li>

          {{-- <li class="nav-item menu-items {{ \Route::is('client.profil.*') ? 'active' : '' }}">
            <a href="{{ route('client.profil.create') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Setting Profil</span>
            </a>
          </li> --}}
          
          <li class="nav-item menu-items {{ Route::is('client.laporkerusakan.*') ? 'active' : '' }}">
            <a href="{{ route('client.laporkerusakan.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Lapor Kerusakan</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="{{ route('client.beranda') }}">
              {{-- <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="120"/> --}}
              <h3 class="text-white">Sky</h3>
            </a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                {{-- {!! Form::open(['route' => 'client.tagihan.index', 'method' => 'GET']) !!}
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input name="q" type="text" class="form-control" placeholder="Pencarian Data Member" value="{{ request('q') }}">
                </form>
                {!! Form::close() !!} --}}
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{ route('client.tagihan.index') }}" method="GET">
                  <input type="text" class="form-control" name="q" placeholder="cari data tagihan" value="{{ request('q') }}">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              
              {{-- <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="{{ asset('corona') }}/#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{ asset('corona') }}/assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{ asset('corona') }}/assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{ asset('corona') }}/assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li> --}}
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="{{ asset('corona') }}/#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  {{-- <span class="count bg-danger"></span> --}}
                  <span class="badge bg-danger rounded-pill badge-notifications">
                    {{ auth()->user()->unreadNotifications->count() }}
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  @foreach(Auth()->user()->unreadNotifications as $notification)
                  <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}" class="dropdown-item preview-item">
                    
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">{{ $notification->data['title'] }}</p>
                      <p class="text-muted text-wrap ellipsis mb-0"> {{ $notification->data['messages'] }} </p>
                      <small class="text-muted bg-white">
                        {{ $notification->created_at->diffForHumans() }}
                      </small>
                    </div>
                    <div class="flex-shrink-0 notifications-actions">
                      {!! Form::open([
                          'route' => ['client.notifikasi.update', $notification->id],
                          'method' => 'PUT',
                      ]) !!}
                      <button class="btn" type="submit"><i class="mdi mdi-close-octagon"></i></button>
                    </div>
                  </a>
                  @endforeach
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="{{ asset('corona') }}/#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="{{ \Storage::url(Auth::user()->foto ?? 'no-images.jpeg') }}" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('client.profil.create') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logout') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                  {!! implode('', $errors->all('<div>:message</div>')) !!}
                </div>
                @endif
                {{-- @include('flash::message') --}}
                  @yield('content')
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © skynet.com 2023</span>
              {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="{{ asset('corona') }}/https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> --}}
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('corona') }}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('corona') }}/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('corona') }}/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="{{ asset('corona') }}/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="{{ asset('corona') }}/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('corona') }}/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('corona') }}/assets/js/off-canvas.js"></script>
    <script src="{{ asset('corona') }}/assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('corona') }}/assets/js/misc.js"></script>
    <script src="{{ asset('corona') }}/assets/js/settings.js"></script>
    <script src="{{ asset('corona') }}/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('corona') }}/assets/js/dashboard.js"></script>

    {{-- Custom Select2 --}}
    <script src="{{ asset('corona') }}/assets/vendors/select2/select2.min.js"></script>

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
      $(document).ready(function() {
        $('.rupiah').mask("#.##0", {
          reverse: true
        });
        $('.select2').select2();
      });
    </script>
    @yield('js')
    <!-- End custom js for this page -->
  </body>
</html>