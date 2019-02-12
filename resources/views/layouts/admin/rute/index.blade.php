@extends('master_admin') @section('title', 'Rute') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Rute</b>
						</h4>
					</div>
					<div class="mb-3">
            <a href="{{ route('admin.tipe-rute.index') }}" class="btn btn-warning">
							<i class="fa fa-rocket"></i> Type Rute
						</a>
            <a href="{{ route('admin.rute.create') }}" class="btn btn-primary">
							<i class="fa fa-plus"></i> Tambah
						</a>
					</div>
				</div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  Tipe
                </th>
                <th>
                  Jam Berangkat
                </th>
                <th>
                  Rute Awal
                </th>
                <th>
                  Rute Akhir
                </th>
                <th>
                  Harga
                </th>
                <th>
                  Transportasi
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($rute as $item)
              <tr>
                <td>
                  {{ $item->type->nama_type }}
                </td>
                <td>
                  {{ date('H:i A', strtotime($item->jam_berangkat)) }}
                </td>
                <td>
                  {{ $item->rute_awal }}
                </td>
                <td>
                  {{ $item->rute_akhir }}
                </td>
                <td>
                  Rp. {{ $item->harga }}
                </td>
                <td>
                  {{ $item->transportasi->nama_transportasi }}
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('admin.rute.edit', ['rute' => $item->id_rute]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" id="deleteButton" class="btn btn-danger" data-id="{{ $item->id_rute }}" data-menu="rute">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
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

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "order": [[ 5, "desc" ]]
      });
    })
  </script>
@endsection
