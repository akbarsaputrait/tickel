@extends('master_petugas')
@section('title', 'Dasbor')
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
                  <a href="{{ route('petugas.order.show', ['order' => $item->kode_pemesanan]) }}" class="btn btn-sm btn-dark">
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
        <a href="{{ url('admin/order') }}" class="btn btn-outline-primary">
          <i class="fa fa-arrow-right"></i> Lihat lainnya</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('table').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdfHtml5'
      ],
      "order": [[ 4, "desc" ]]
    });
  });
</script>
@endsection
