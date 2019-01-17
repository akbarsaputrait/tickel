@extends('master_petugas')
@section('title', 'Dasbor')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-description">Pesanan Terbaru</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="datatable">
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
                  Petugas
                </th>
                <th>
                  Tanggal Pemesanan
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <a href="{{ url('petugas/order/1') }}" class="nav-link">A3313</a>
                </td>
                <td>
                  <span class="badge badge-warning">Proses</span>
                </td>
                <td>
                  Rp. 7,000
                </td>
                <td>
                  Petugas A
                </td>
                <td>
                  Apr 21, 2018
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ url('admin/order') }}" class="btn btn-outline-primary">
          <i class="fa fa-arrow-right"></i> Lihat lainnya</a>
      </div>
    </div>
  </div>
</div>
@endsection
