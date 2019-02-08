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
              @foreach($pemesanan as $item)
              <tr>
                <td>
                  <a href="{{ route('petugas.order.show', ['order' => $item->kode_pemesanan]) }}" class="btn btn-sm btn-dark">
                    #{{ $item->kode_pemesanan }}
                  </a>
                </td>
                <td>
                  @switch($item->status)
                      @case("done")
                          <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                        @break

                      @case("proccess")
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
                  {{ (is_null($item->petugas)) ? '-' : $item->petugas->nama_petugas }}
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
        <a href="{{ url('admin/order') }}" class="btn btn-outline-primary">
          <i class="fa fa-arrow-right"></i> Lihat lainnya</a>
      </div>
    </div>
  </div>
</div>
@endsection
