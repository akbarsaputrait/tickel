<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | Tickle</title>
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
  <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  @yield('style')
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout navbar-grad-2 col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
          <img src="{{ asset('home/images/logo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html">
          <img src="{{ asset('home/images/logo.png') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-xl-inline-block">
            <a href="{{ route('admin.profile') }}" class="nav-link" aria-expanded="false">
              <span class="profile-text">Hello, {{ auth()->guard('admin')->user()->name }} !</span>
              @if(is_null(auth()->guard('admin')->user()->image))
              <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
      				@else
      				<img class="img-xs rounded-circle" src="{{ asset('admin/uploads/images/avatars/'.auth()->guard('admin')->user()->image ) }}" alt="Profile image">
      				@endif
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ strpos(request()->path(), 'dasbor') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/dasbor') }}">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-title">Dasbor</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'order') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/order') }}">
              <i class="menu-icon fa fa-usd"></i>
              <span class="menu-title">Pesanan</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'petugas') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/petugas') }}">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'rute') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/rute') }}">
              <i class="menu-icon fa fa-location-arrow"></i>
              <span class="menu-title">Rute</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'transportasi') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/transportasi') }}">
              <i class="menu-icon fa fa-plane"></i>
              <span class="menu-title">Transportasi</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'level') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/level') }}">
              <i class="menu-icon fa fa-key"></i>
              <span class="menu-title">Level</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/logout') }}">
              <i class="menu-icon fa fa-sign-out"></i>
              <span class="menu-title">Keluar</span>
            </a>
          </li>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper bg-1">
          <!-- Begin Validation -->

          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fa fa-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
                  </i> {{ session()->get('message') }}
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
  <script src="{{ asset('admin/vendors/sweetalert/sweetalert2.all.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/js/script.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable();
    })
  </script>
  @yield('script')
</body>

</html>
