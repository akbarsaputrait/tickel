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
  <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/select2/select2.min.css') }}">
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
                <li class="nav-item"> <a class="nav-link text-white" href="/pesan-tiket">PESAN TIKET SEKARANG!</a> </li>
                <li class="nav-item"><a class="nav-link text-white" href="/#why">MENGAPA TICKEL?</a></li>
                <li class="nav-item"> <a class="nav-link text-white" href="#contact">KONTAK KAMI</a> </li>
                <li class="nav-item">
                  <div class="btn-group">
                    @if(!auth()->guard('penumpang')->user())
                    <a href="{{ route('penumpang.login') }}" class="btn btn-outline-dark">Masuk</a>
                    <a href="{{ route('penumpang.register') }}" class="btn btn-outline-dark">Daftar</a>
                    @else
                    <a href="{{ route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]) }}" class="btn btn-dark text-lowercase">
                      @if(is_null(auth()->guard('penumpang')->user()->image))
                      <img src="{{ asset('home/images/client.png') }}" class="img-fluid" style="border-radius: 50%;" alt="" width="20">
                      @else
                      <img src="{{ asset('uploads/images/avatars/' . auth()->guard('penumpang')->user()->image) }}" class="img-fluid" style="border-radius: 50%;" alt="" width="20">
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

  <div class="light-bg py-5" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 text-center text-lg-left">
          <p class="mb-2"> <span class="ti-location-pin mr-2"></span> 1485 Pacific St, Brooklyn, NY 11216 USA</p>
          <div class=" d-block d-sm-inline-block">
            <p class="mb-2">
              <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">support@mobileapp.com</a>
            </p>
          </div>
          <div class="d-block d-sm-inline-block">
            <p class="mb-0">
              <span class="ti-headphone-alt mr-2"></span> <a href="tel:51836362800">518-3636-2800</a>
            </p>
          </div>

        </div>
        <div class="col-lg-6">
          <div class="social-icons">
            <a href="#"><span class="ti-facebook"></span></a>
            <a href="#"><span class="ti-twitter-alt"></span></a>
            <a href="#"><span class="ti-instagram"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
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
  <script src="{{ asset('home/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/sweetalert/sweetalert2.all.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('admin/vendors/select2/select2.full.min.js') }}" charset="utf-8"></script>
  <!-- Plugins JS -->
  <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
  <!-- Custom JS -->
  <script src="{{ asset('home/js/script.js') }}"></script>
  <script src="{{ asset('home/js/home.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('select#select2').select2();
    })
  </script>
</body>

</html>
