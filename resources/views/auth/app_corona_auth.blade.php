<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>{{ $title ?? '' }} {{ settings()->get('app_name', 'My APP') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('corona') }}/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('corona') }}/assets/images/favicon.png" />
  </head>
  <body>
    @yield('content')
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('corona') }}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('corona') }}/assets/js/off-canvas.js"></script>
    <script src="{{ asset('corona') }}/assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('corona') }}/assets/js/misc.js"></script>
    <script src="{{ asset('corona') }}/assets/js/settings.js"></script>
    <script src="{{ asset('corona') }}/assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>