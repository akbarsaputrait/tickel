@extends('master_admin') @section('title', 'Pesanan') @section('content')
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
                  Petugas
                </th>
                <th>
                  Tanggal Pemesanan
                </th>
                <th></th>
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
                <td>
                  <button type="button" name="button" class="btn btn-danger" id="deleteButton"
                          data-id="{{ $item->id_pemesanan }}" data-menu="pemesanan">
                    <i class="fa fa-trash"></i>
                  </button>
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
