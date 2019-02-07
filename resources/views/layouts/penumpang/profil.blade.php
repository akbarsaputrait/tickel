@extends('master_home') @section('content')
<header class="text-dark pb-4" id="home">
  <div class="container mt-5">
    <div class="my-5">
      <h3>{{ auth()->guard('penumpang')->user()->nama_penumpang }}</h3>
    </div>
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#profile">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#history">Riwayat Pemesanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#testimoni">Testimoni</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade active show" id="profile">
        @include('layouts.penumpang.user')
      </div>
      <div class="tab-pane fade text-dark" id="history">
        @include('layouts.penumpang.history_order')
      </div>
      <div class="tab-pane fade text-dark" id="testimoni">
        @include('layouts.penumpang.testimoni')
      </div>
    </div>
  </div>
</header>
@include('layouts.penumpang.modal_order')
@endsection
