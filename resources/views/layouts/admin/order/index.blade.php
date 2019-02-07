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
    </div>
  </div>
</div>
@endsection
