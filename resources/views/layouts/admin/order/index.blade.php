@extends('master_admin') @section('title', 'Pesanan') @section('content')
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
              <tr>
                <td class="font-weight-medium">
                  1
                </td>
                <td>
                  <a href="{{ url('admin/order/1') }}" class="nav-link">A3313</a>
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
              <tr>
                <td class="font-weight-medium">
                  2
                </td>
                <td>
                  <a href="#" class="nav-link">A3512</a>
                </td>
                <td>
                  <span class="badge badge-danger">Gagal</span>
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
              <tr>
                <td class="font-weight-medium">
                  3
                </td>
                <td>
                  <a href="#" class="nav-link">A3521</a>
                </td>
                <td>
                  <span class="badge badge-success">Berhasil</span>
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
    </div>
  </div>
</div>
@endsection
