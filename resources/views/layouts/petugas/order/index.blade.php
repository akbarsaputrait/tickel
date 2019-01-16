@extends('master_petugas') @section('title', 'Pesanan')
@section('style')
<link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-description">Daftar Pesanan</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="datatable">
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
@section('script')
<script src="{{ asset('vendors/datatables/datatables.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('vendors/datatables/buttons.bootstrap4.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('vendors/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable();
  })
</script>
@endsection
