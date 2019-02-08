@extends('master_admin') @section('title', 'Dasbor') @section('content')
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pemasukan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">Rp. {{ (! empty($pemasukan)) ? count($pemasukan) : '0' }}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-receipt text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pesanan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ (! empty($pesanan)) ? count($pesanan) : '0' }}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Product-wise sales
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Petugas</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ (! empty($petugas)) ? count($petugas) : '0' }}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pengguna</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ (! empty($penumpang)) ? count($penumpang) : '0' }}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Product-wise sales
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pesanan</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Kode Pemesan
                </th>
                <th>
                  Status
                </th>
                <th>
                  Total Harga
                </th>
                <th>
                  Petugas
                </th>
                <th>
                  Tanggal Pemesanan
                </th>
              </tr>
            </thead>
            <tbody>
              @php
                $x = 1;
              @endphp
              @foreach($pemesanan as $item)
              <tr>
                <td class="font-weight-medium">
                  {{ $x++ }}
                </td>
                <td>
                  <a href="{{ route('admin.order.show', ['order' => $item->kode_pemesanan]) }}" class="btn btn-dark btn-sm">#{{ $item->kode_pemesanan }}</a>
                </td>
                <td>
                  <span class="badge badge-warning">Proses</span>
                </td>
                <td>
                  Rp. {{ $item->total_bayar }}
                </td>
                <td>
                  -
                </td>
                <td>
                  {{ date('d F Y, H:i A', strtotime($item->created_at)) }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('admin.order.index') }}" class="btn btn-outline-primary">
          <i class="fa fa-arrow-right"></i> Lihat lainnya</a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
				<h4 class="card-title">Bar chart</h4>
				<canvas id="barChart" style="height:230px" data-url="{{ url('api/chartPesanan') }}"></canvas>
      </div>
    </div>
  </div>
	<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
				<h4 class="card-title">Pie chart</h4>
				<canvas id="pieChart" style="height:250px"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/js/chart.js') }}"></script>
@endsection
