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
            <a class="navbar-brand" href="index.html"><img src="{{ asset('home/images/logo.png') }}" class="img-fluid" alt="logo" width="100"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbar">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"> <a class="nav-link text-dark" href="#features">PESAN TIKET SEKARANG!</a> </li>
                <li class="nav-item"><a class="nav-link text-dark" href="#why">MENGAPA TICKEL?</a></li>
                <li class="nav-item"> <a class="nav-link text-dark" href="#contact">KONTAK KAMI</a> </li>
                <li class="nav-item">
                  <div class="btn-group">
                    <a href="{{ route('penumpang.login') }}" class="btn btn-outline-dark">Masuk</a>
                    <a href="{{ route('penumpang.register') }}" class="btn btn-outline-dark">Daftar</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>


  <header class="text-dark" id="home">
    <div class="container mt-5">
      <h1>Tickel</h1>
      <p>Aplikasi pembelian tiket pesawat dan kereta api di Indonesia.</p>
    </div>
    <div class="img-holder mt-3">
      <!-- <img src="{{ asset('home/images/plane.png') }}" alt="phone" class="img-fluid" width="300">
          <img src="{{ asset('home/images/train.png') }}" alt="phone" class="img-fluid" width="300"> -->
    </div>
  </header>

  <div class="section light-bg" id="features">
    <div class="container">
      <div class="section-title">
        <h3>Cari rute tujuan mu!</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card features p-4">
            <form class="form-horizontal" action="" method="post">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Kota Asal</label>
                    <select class="form-control" name="">
                      <option value="">-- Pilih kota asal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Kota Tujuan</label>
                    <select class="form-control" name="">
                      <option value="">-- Pilih kota tujuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tanggal Berangkat</label>
                    <input type="date" class="form-control" name="" value="">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="">Transportasi</label>
                        <select class="form-control" name="">
                          <option value="">-- Jenis Transportasi</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="">Kelas</label>
                        <select class="form-control" name="">
                          <option value="">-- Kelas Transportasi</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Jumlah Kursi</label>
                    <input type="number" class="form-control" name="" value="">
                  </div>
                  <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary custom" name="button">Cari Tiket</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="text-center">
              <a href="#">Masuk</a> atau <a href="#">Daftar</a> untuk melengkapi pemesanan tiket.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- // end .section -->
  <div class="section">

    <div class="section" id="why">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-6">
            <div class="card" style="border: none; border-radius: 0px; box-shadow: 0px 5px 7px 0px rgba(0, 0, 0, 0.04);">
              <div class="card-body">
                <h2>Mengapa memilih Tickel?</h2>
                <div class="mb-4">
                  <b>Harga Jujur</b>
                  <p>Harga tiket yang ditampilkan sudah termasuk biaya-biaya seperti pajak, dsb.</p>

                  <b>Proses Mudah</b>
                  <p>Proses pemesanan tiket yang cepat dan mudah.</p>
                </div>
              </div>
            </div>
            <!-- <a href="#" class="btn btn-primary">Read more</a> -->
          </div>
        </div>
        <div class="perspective-phone">
          <img src="{{ asset('home/images/AssetA.png') }}" alt="perspective phone" class="img-fluid">
        </div>
      </div>

    </div>
    <!-- // end .section -->

    <div class="section light-bg">

      <div class="container">
        <div class="row">
          <div class="col-md-8 d-flex align-items-center">
            <ul class="list-unstyled ui-steps">
              <li class="media">
                <div class="circle-icon mr-4">1</div>
                <div class="media-body">
                  <h5>Mendaftarkan akun</h5>
                  <p>Dengan mendaftar anda dapat memesan tiket untuk bepergian secara cepat dan mudah.</p>
                </div>
              </li>
              <li class="media my-4">
                <div class="circle-icon mr-4">2</div>
                <div class="media-body">
                  <h5>Pilih rute tujuan</h5>
                  <p>Harga yang jujur dan terjangkau dapat anda pilih sesuai dengan rute yang anda inginkan.</p>
                </div>
              </li>
              <li class="media">
                <div class="circle-icon mr-4">3</div>
                <div class="media-body">
                  <h5>Perjalanan yang menakjubkan</h5>
                  <p>Nikmati perjalanan anda dengan kemudahan pemesanan tiket transportasi di Tickel.</p>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <img src="{{ asset('home/images/asset2.png') }}" alt="iphone" class="img-fluid">
          </div>

        </div>

      </div>

    </div>
    <!-- // end .section -->


    <div class="section" id="testimonials">
      <div class="container">
        <div class="section-title">
          <small>TESTIMONI</small>
          <h3>Apa yang mereka katakan?</h3>
        </div>

        <div class="testimonials owl-carousel">
          <div class="testimonials-single">
            <img src="{{ asset('home/images/client.png') }}" alt="client" class="client-img">
            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
            <p class="text-primary">United States</p>
          </div>
          <div class="testimonials-single">
            <img src="{{ asset('home/images/client.png') }}" alt="client" class="client-img">
            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
            <p class="text-primary">United States</p>
          </div>
          <div class="testimonials-single">
            <img src="{{ asset('home/images/client.png') }}" alt="client" class="client-img">
            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
            <p class="text-primary">United States</p>
          </div>
        </div>

      </div>

    </div>
    <!-- // end .section -->

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
    <!-- Plugins JS -->
    <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('home/js/script.js') }}"></script>

</body>

</html>
