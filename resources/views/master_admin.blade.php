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
  <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/datepicker/css/datepicker.css') }}">
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
          <img src="{{ asset('home/images/logo.png') }}" alt="logo" width="50" class="img-fluid" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
          <img src="{{ asset('home/images/logo.png') }}" alt="logo"  width="50"/>
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
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Dasbor</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'order') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.order.index') }}">
              <i class="menu-icon mdi mdi-cart"></i>
              <span class="menu-title">Pesanan</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'petugas') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.petugas.index') }}">
              <i class="menu-icon mdi mdi-human"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'rute') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.rute.index') }}">
              <i class="menu-icon mdi mdi-crosshairs-gps"></i>
              <span class="menu-title">Rute</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'transportasi') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.transportasi.index') }}">
              <i class="menu-icon mdi mdi-airplane"></i>
              <span class="menu-title">Transportasi</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'rekening') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.rekening.index') }}">
              <i class="menu-icon mdi mdi-credit-card"></i>
              <span class="menu-title">Rekening</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'level') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.level.index') }}">
              <i class="menu-icon mdi mdi-key"></i>
              <span class="menu-title">Level</span>
            </a>
          </li>
          <li class="nav-item {{ strpos(request()->path(), 'testimoni') !== false ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin.testimoni.index') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Testimoni</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}">
              <i class="menu-icon mdi mdi-logout"></i>
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
  <script src="{{ asset('admin/js/jquery-3.3.1.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/jquery.dataTables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/jszip.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/pdfmake.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.html5.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
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
  <script src="{{ asset('admin/vendors/select2/select2.full.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datepicker/js/bootstrap-datepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datepicker/js/locales/bootstrap-datepicker.id.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/js/printThis.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/js/script.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
      });

      $('select').select2();

      $('.datepicker').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd'
      });

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
