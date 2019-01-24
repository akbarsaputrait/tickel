@extends('master_home') @section('content')
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
          <form class="form-horizontal" action="" method="post" id="pesanTiket">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Kota Asal</label>
                  <select class="form-control" name="rute_awal">
                    <option value="">Pilih kota asal</option>
                    @foreach($rute_awal as $item)
                    <option value="{{ $item->rute_awal }}">{{ $item->rute_awal }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Kota Tujuan</label>
                  <select class="form-control" name="rute_akhir">
                    <option value="">Pilih kota tujuan</option>
                    @foreach($rute_akhir as $item)
                    <option value="{{ $item->rute_akhir }}">{{ $item->rute_akhir }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tanggal Berangkat</label>
                      <input type="date" class="form-control" name="tanggal_berangkat" value="" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Jam Berangkat</label>
                      <input type="time" class="form-control" name="jam_berangkat" value="" placeholder="Jam keberangkatan" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Transportasi</label>
                      <select class="form-control" name="transportasi" disabled>
                        <option value="">Jenis Transportasi</option>
                        @foreach($transportasi as $item)
                        <option value="{{ $item->nama_transportasi }}">{{ $item->nama_transportasi }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Kelas</label>
                      <select class="form-control" name="kelas" disabled>
                        <option value="">Kelas Transportasi</option>
                        @foreach($type_rute as $item)
                        <option value="{{ $item->nama_type }}">{{ $item->nama_type }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="btn-group w-100">
                        <input type="button" id="cariTiket" class="mt-4 btn btn-primary custom" name="submit" value="Cari Tiket">
                        <button type="button" id="clearButton" class="btn btn-primary custom d-none" name="button">Batal</button>
                      </div>
                    </div>
                  </div>
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
  <!-- MODAL -->
  <div class="modal fade" id="showTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 1000px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Daftar ketersedian tiket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-responsive">
                <thead>
                  <th>Rute Awal</th>
                  <th>Rute Akhir</th>
                  <th>Harga</th>
                  <th>Jam Berangkat</th>
                  <th>Jam Tiba</th>
                  <th>Nama Transportasi</th>
                  <th></th>
                </thead>
                <tbody id="dataTiket">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @endsection
