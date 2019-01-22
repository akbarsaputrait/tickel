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
            <a href="{{ route('tipe-rute.index') }}" class="btn btn-warning">
							<i class="fa fa-rocket"></i> Type Rute
						</a>
            <a href="{{ route('rute.create') }}" class="btn btn-primary">
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
                  Tujuan
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
                  {{ $item->tujuan }}
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
                    <a href="{{ route('rute.edit', ['rute' => $item->id_rute]) }}" class="btn btn-success">
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
