<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    @yield('css-custom')
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
    <script src="https://cdn.tiny.cloud/1/2eelyvv5cliwpognqye4ud2f8o4shci9qy9ld88yf1himsh4/tinymce/5/tinymce.min.js"></script>
    <style>
      /* custom css */
      /* .table-dark th {
        color: white !important;
      } */
      .overlay {
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;

      /* Custom table */
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

      .nav-pills .nav-link {
        background-color: #2A3038;
        color: #fff;
        border: 2px solid #000000;
        border-radius: 5px; /* Atur radius border sesuai keinginan */
        margin: -5px -7px; /* Atur jarak antar tombol */
        padding: 5px 15px; /* Atur ukuran padding tombol */
        font-size: 14px;
      }

      .nav-pills .nav-link.active {
        background-color: #fff;
        color: #2A3038;
      }

      .progress {
        /* height: 15px; */
        background-color: #928f8f;
        border-radius: 5px;
        /* overflow: hidden; */
      }

    </style>
  </head>
  <body>
    <div id="overlay" class="overlay d-none">
      <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          {{-- <span class="sidebar-brand brand-logo font-weight-bold text-white">SKYNET</span> --}}
          <a class="sidebar-brand brand-logo" href="{{ route('admin.beranda') }}"><img src="{{ \Storage::url(settings()->get('app_logo')) ?? 'assets\logo.png' }}" style="width: 90px; height:auto;" alt="logo"/></a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.beranda') }}"><h2 class="font-weight-bold text-white">S</h2></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{ \Storage::url(Auth::user()->foto ?? 'assets\no-images.jpeg') }}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                  <span>{{ Auth::user()->email }}</span>
                </div>
              </div>
              <a href="{{ asset('corona') }}/#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{ asset('corona') }}/#" class="dropdown-item preview-item">
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
                <a href="{{ asset('corona') }}/#" class="dropdown-item preview-item">
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
                <a href="{{ asset('corona') }}/#" class="dropdown-item preview-item">
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
          <li class="nav-item menu-items {{ \Route::is('admin.beranda.*') ? 'active' : '' }}">
            <a href="{{ route('admin.beranda') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-home"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">DATA MASTER</span>
          </li>
          <li class="nav-item menu-items {{ Route::is('setting.*') || Route::is('settingappform.*') || Route::is('settingwhacenter.*') ? 'active' : '' }}">
            <a href="{{ route('setting.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-settings"></i>
              </span>
              <span class="menu-title">Pengaturan Web</span>
            </a>
          </li>
          <li class="nav-item menu-items {{ Route::is('bankskynet.*') ? 'active' : '' }}">
            <a href="{{ route('bankskynet.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-bank"></i>
              </span>
              <span class="menu-title">Data Bank Skynet</span>
            </a>
          </li>

          <li class="nav-item menu-items {{ Route::is('client.*') || Route::is('user.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Data Akun</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Route::is('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">Akun Admin</a></li>
                <li class="nav-item"> <a class="nav-link {{ Route::is('client.*') ? 'active' : '' }}" href="{{ route('client.index') }}">Akun Pelanggan</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items {{ \Route::is('member.*') ? 'active' : '' }}">
            <a href="{{ route('member.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple"></i>
              </span>
              <span class="menu-title">Pelanggan</span>
            </a>
          </li>
          <li class="nav-item menu-items {{ \Route::is('kirimpesan.*') ? 'active' : '' }}">
            <a href="{{ route('kirimpesan.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-whatsapp"></i>
              </span>
              <span class="menu-title">Kirim Pesan</span>
            </a>
          </li>
          <li class="nav-item menu-items {{ \Route::is('laporkerusakan.*') ? 'active' : '' }}">
            <a href="{{ route('laporkerusakan.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-whatsapp"></i>
              </span>
              <span class="menu-title">Laporan Kerusakan</span>
            </a>
          </li>
          <li class="nav-item menu-items {{ \Route::is('biaya.*') ? 'active' : '' }}">
            <a href="{{ route('biaya.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Paket Internet</span>
            </a>
          </li>
          <li class="nav-item menu-items {{ Route::is('sponsor.*') || Route::is('services.*') || Route::is('berita.*') ? 'active' : '' }}">
            <a href="{{ route('sponsor.index') }}" class="nav-link">
              <span class="menu-icon">
                <i class="fa fa-gear"></i>
              </span>
              <span class="menu-title">Setting Landing Page</span>
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">DATA TRANSAKSI</span>
          </li>
          <li class="nav-item menu-items {{ Route::is('tagihan.*') || Route::is('pembayaran.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-cash-multiple"></i>
              </span>
              <span class="menu-title">Administrasi</span>
              {{-- <span class="badge badge-pill badge-danger" style="margin-left: 5px;">
                {{ auth()->user()->unreadNotifications->count() }}
              </span> --}}
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('jobstatus.index') }}">Buat Tagihan</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('tagihan.index') }}">Tagihan Pelanggan</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('pembayaran.index') }}">Data Pembayaran</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items {{ \Route::is('laporanform.*') ? 'active' : '' }}">
            <a href="{{ route('laporanform.create') }}" class="nav-link">
                <div class="d-flex align-items-center">
                    <span class="menu-icon">
                        <i class="mdi mdi-library-books"></i>
                    </span>
                    <div class="menu-title">Data Laporan</div>
                </div>
            </a>
          </li>
          {{-- <li class="nav-item menu-items {{ \Route::is('logactivity.index') ? 'active' : '' }}">
            <a href="{{ route('logactivity.index') }}" class="nav-link">
                <div class="d-flex align-items-center">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <div class="menu-title">Log</div>
                </div>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.beranda') }}">
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
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="{{ route('tagihan.index') }}" method="GET">
                  <input type="text" class="form-control" name="q" placeholder="cari data tagihan" value="{{ request('q') }}">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                {{-- <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="{{ asset('corona') }}/#">+ Create New Project</a> --}}
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">UI Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Testing</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>
              </li>
              {{-- <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="{{ asset('corona') }}/#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li> --}}
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
                    <span class="badge bg-danger rounded-pill badge-notifications">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="max-height: 300px; overflow-y: auto;">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    @foreach(Auth()->user()->unreadNotifications as $notification)
                    <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">{{ $notification->data['title'] }}</p>
                            <p class="text-muted ellipsis mb-0"> {{ $notification->data['messages'] }} </p>
                            <small class="text-muted bg-white">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="flex-shrink-0 notifications-actions">
                          {!! Form::open([
                              'route' => ['notifikasi.update', $notification->id],
                              'method' => 'PUT',
                          ]) !!}
                          <button class="btn" type="submit"><i class="mdi mdi-close-octagon"></i></button>
                        </div>
                    </a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
            
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="{{ asset('corona') }}/#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="{{ \Storage::url(Auth::user()->foto ?? 'assets\no-images.jpeg') }}" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  {{-- <h6 class="p-3 mb-0">Profile</h6> --}}
                  <div class="dropdown-divider"></div>
                  {{-- <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a> --}}
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
                  <div class="dropdown-divider"></div>
                  {{-- <p class="p-3 mb-0 text-center">Advanced settings</p> --}}
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
            <div class="alert alert-primary d-none" role="alert" id="alert-message">

            </div>
            @if($errors->any())
            <div class="alert alert-danger" role="alert" id="alert-messages">
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
              <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i class="mdi mdi-heart text-danger"></i></span>
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

    {{-- select2 custom --}}
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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('scripts')
    <script>
      $("#alert-messages").not('.alert-important').delay(5000).fadeOut(350);
    </script>
    <script>
      document.getElementById('my-textarea').addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
              e.preventDefault();
              var text = this.value;
              var selectionStart = this.selectionStart;
              var selectionEnd = this.selectionEnd;
              var firstPart = text.slice(0, selectionStart);
              var secondPart = text.slice(selectionEnd);
              this.value = firstPart + '\n' + secondPart;
              this.selectionStart = this.selectionEnd = selectionStart + 1;
          }
      });
    </script>
    <!-- End custom js for this page -->
  </body>
</html>