<!doctype html>
<html lang="en">
<!--

Page    : index / MobApp
Version : 1.0
Author  : Colorlib
URI     : https://colorlib.com

 -->

<head>
  <title>Tickel</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Mobland - Mobile App Landing Page Template">
  <meta name="keywords" content="HTML5, bootstrap, mobile, app, landing, ios, android, responsive">

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

  <!-- Font -->
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}">
  <!-- Themify Icons -->
  <link rel="stylesheet" href="{{ asset('home/css/themify-icons.css') }}">
  <!-- Owl carousel -->
  <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
  <!-- Main css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/datepicker/css/datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('home/css/custom.css') }}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

  <!-- Nav Menu -->

  <div class="nav-menu fixed-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-dark navbar-expand-lg">
            <a class="navbar-brand py-0" href="{{ route('home') }}"><img src="{{ asset('home/images/logo.png') }}" class="img-fluid" alt="logo" width="50"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbar">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"> <a class="nav-link" href="{{ route('pesan.create') }}">PESAN TIKET SEKARANG!</a> </li>
                <li class="nav-item"><a class="nav-link" href="/#why">MENGAPA TICKEL?</a></li>
                <li class="nav-item"> <a class="nav-link" href="/#testimoni">TESTIMONI</a> </li>
                <li class="nav-item">
                  <div class="btn-group">
                    @if(!auth()->guard('penumpang')->user())
                    <a href="{{ route('penumpang.login') }}" class="btn btn-outline-dark">Masuk</a>
                    <a href="{{ route('penumpang.register') }}" class="btn btn-outline-dark">Daftar</a>
                    @else
                    <a href="{{ route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]) }}" class="btn btn-dark text-lowercase d-flex align-items-center">
                      @if(is_null(auth()->guard('penumpang')->user()->image))
                      <img src="{{ asset('home/images/client.png') }}" class="img-fluid" style="border-radius: 50%;" alt="" width="20">
                      @else
                      <div id="avatar-image-sm" style="background: url('{{ asset('uploads/images/avatars/' . auth()->guard('penumpang')->user()->image) }}'); background-size: cover; background-position: center top; max-width: 100%;">
        							</div>
                      @endif
                      {{ '@'. auth()->guard('penumpang')->user()->username }}
                    </a>
                    <a href="{{ route('penumpang.logout') }}" class="btn btn-outline-dark">Keluar</a>
                    @endif
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  @yield('content')
  <!-- // end .section -->
  <footer class="my-5 text-center">
    <!-- Copyright removal is not prohibited! -->
    <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED. MOBAPP TEMPLATE BY <a href="https://colorlib.com">COLORLIB</a></small></p>

    <small>
            <a href="#" class="m-2">PRESS</a>
            <a href="#" class="m-2">TERMS</a>
            <a href="#" class="m-2">PRIVACY</a>
        </small>
  </footer>
  <!-- jQuery and Bootstrap -->
  <script src="{{ asset('home/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/datatables/jquery.dataTables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/jszip.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/pdfmake.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.html5.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('home/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/sweetalert/sweetalert2.all.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/select2/select2.full.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datepicker/js/bootstrap-datepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/datepicker/js/locales/bootstrap-datepicker.id.js') }}" charset="utf-8"></script>
  <!-- Plugins JS -->
  <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
  <!-- Custom JS -->
  <script src="{{ asset('home/js/script.js') }}"></script>
  <script src="{{ asset('home/js/home.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('select#select2').select2();
      $('.datepicker').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd'
      });
    })
  </script>
  @yield('script')
</body>

</html>
