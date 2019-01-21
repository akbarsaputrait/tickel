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
  @yield('style')
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout navbar-grad-1 col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.html">
          <img src="{{ asset('admin/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html">
          <img src="{{ asset('admin/images/logo-mini.svg') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
				<ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="#" class="nav-link">Total Pesanan
              <span class="badge badge-warning ml-1">33</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, Richard V.Welsh !</span>
              <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2">
                Manage Accounts
              </a>
              <a class="dropdown-item">
                Change Password
              </a>
              <a class="dropdown-item">
                Check Inbox
              </a>
              <a class="dropdown-item">
                Sign Out
              </a>
            </div>
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
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{ asset('admin/images/faces/face1.jpg') }}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Richard V.Welsh</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'dashboard') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('petugas/dashboard') }}">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-title">Dasbor</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'order') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('petugas/order') }}">
              <i class="menu-icon fa fa-usd"></i>
              <span class="menu-title">Pesanan</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper bg-2">
          <!-- Begin Validation -->
          @if ($errors->any())
              <div class="alert alert-danger alert-dissmissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  @foreach ($errors->all() as $error)
                        <i class="fa fa-close"></i> {{ $error }}
                      <br/>
                  @endforeach
              </div>
          @endif
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
  <script src="{{ asset('js/misc.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script src="{{ asset('admin/vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable();
    })
  </script>
  @yield('script')
</body>

</html>
