@extends('master_admin') @section('title', 'Dasbor') @section('content')
<div class="row">
  <div class="col-xl-6 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pemasukan</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0" data-price="{{ $total_bayar }}" id="total_bayar_view">

              </h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total pemasukan
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
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
          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Pesanan diverifikasi
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Petugas</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ (! empty($petugas)) ? count($petugas) : '0' }}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total petugas
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
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
          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Total pengguna
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
          <table class="table table-bordered table-striped" id="order">
            <thead>
              <tr>
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
                  Admin / Petugas
                </th>
                <th>
                  Tanggal Pemesanan
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($pemesanan as $item)
              <tr>
                <td>
                  <a href="{{ route('admin.order.show', ['order' => $item->kode_pemesanan]) }}" class="btn btn-sm btn-dark">
                    #{{ $item->kode_pemesanan }}
                  </a>
                </td>
                <td>
                  @switch($item->status)
                      @case("done")
                          <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                        @break

                      @case("process")
                          <span class="badge badge-primary">{{ ucfirst($item->status) }}</span>
                        @break

                      @case("pending")
                        <span class="badge badge-warning">{{ ucfirst($item->status) }}</span>
                        @break

                      @case("cancel")
                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                        @break
                      @default
                          <span class="badge badge-dark">{{ ucfirst($item->status) }}</span>
                  @endswitch
                </td>
                <td>
                  Rp.{{ $item->total_bayar }}
                </td>
                <td>
                  @if(is_null($item->petugas))
                    @if(is_null($item->admin))
                      -
                    @else
                      {{ $item->admin->name }} <span class="badge badge-outline-danger">admin</span>
                    @endif
                  @else
                    {{ $item->petugas->nama_petugas }} <span class="badge badge-outline-primary">petugas</span>
                  @endif
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
          Lihat lainnya <i class="mdi mdi-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
				<h4 class="card-title">Jumlah pemesanan tiap harinya</h4>
				<canvas id="canvass" style="height:230px"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
<script type="text/javascript">

  document.getElementById("total_bayar_view").innerHTML = formatRupiah('{{ $total_bayar }}', 'Rp.');

  $(document).ready(function() {
    var url = "{{url('api/chartPesanan')}}";
        var Years = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(data){

            $.each(data, function(k,v){
                Years.push(v.created_at);
                Labels.push(v.rute_awal);
                Prices.push(v.rute);
            });
            var ctx = document.getElementById("canvass").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Years,
                      datasets: [{
                          label: 'Jumlah pemesanan',
                          data: Prices,
                          borderWidth: 1,
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgb(47, 225, 243)'
                          ],
                          borderColor: [
                              'rgba(255,99,132,1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)',
                              'rgb(41, 185, 199)'
                          ],
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
          });
        });
  })
</script>

@endsection
