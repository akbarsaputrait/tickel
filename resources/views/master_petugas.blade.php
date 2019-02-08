<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | Tickle</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <!-- endinject -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  @yield('style')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout navbar-grad-1 col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('petugas.dashboard') }}">
          <img src="{{ asset('home/images/logo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('petugas.dashboard') }}">
          <img src="{{ asset('home/images/logo.png') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-xl-inline-block">
            <a class="nav-link" id="UserDropdown" href="{{ route('petugas.profile') }}" aria-expanded="false">
              <span class="profile-text">Hello, {{ auth()->guard('petugas')->user()->nama_petugas }} !</span>
              @if(is_null(auth()->guard('petugas')->user()->image))
              <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
      				@else
      				<img class="img-xs rounded-circle" src="{{ asset('uploads/images/avatars/'.auth()->guard('petugas')->user()->image ) }}" alt="Profile image">
      				@endif
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ strpos(request()->path(), 'dasbor') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('petugas.dashboard') }}">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-title">Dasbor</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'order') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('petugas.order.index') }}">
              <i class="menu-icon fa fa-usd"></i>
              <span class="menu-title">Pesanan</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('petugas.logout') }}" class="nav-link">
              <i class="menu-icon fa fa-sign-out"></i>
              <span class="menu-title">Keluar</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper bg-2">
          <!-- Begin Validation -->
          @if(session()->has('message'))
              <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  <i class="fa fa-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
                  </i>
                  {{ session()->get('message') }}
              </div>
      @endif
      <!-- End Validation -->
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
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
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script src="{{ asset('admin/vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/js/printThis.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table#datatable').DataTable();

      $('#printThis').on("click", function () {
      $('div.printIt').printThis({
        loadCSS: [
          "{{ asset('admin/css/style.css') }}",
          "{{ asset('admin/vendors/css/vendor.bundle.base.css') }}",
          "{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}"
        ]
      });
    });
    })
  </script>
  @yield('script')
</body>

</html>
