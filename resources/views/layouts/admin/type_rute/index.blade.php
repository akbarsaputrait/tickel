@extends('master_admin') @section('title', 'Tipe Rute') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Tipe Rute</b>
						</h4>
					</div>
					<div class="mb-3">
            <a href="{{ route('rute.index') }}" class="btn btn-warning">
							<i class="fa fa-location-arrow"></i> Rute
						</a>
						<button data-toggle="modal" data-target="#createType" class="btn btn-primary">
							<i class="fa fa-plus"></i> Tambah
						</button>
					</div>
				</div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  Keterangan
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($type as $item)
              <tr>
                <td>
                  {{ $item->nama_type }}
                </td>
                <td>

                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('type-rute.edit', ['type-rute' => $item->id_type_rute]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" id="deleteButton" class="btn btn-danger" data-id="{{ $item->id_type_rute }}" data-menu="type-rute">
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

<!-- Modal -->
<div class="modal fade" id="createType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="{{ route('type-rute.store') }}" method="post">
          @csrf
          <h3 class="card-description">
            Informasi Tipe Rute
          </h3>
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control {{ ($errors->has('nama_type')) ? 'is-invalid' : '' }}" name="nama_type" value="" placeholder="Nama Tipe Transportasi">
                <div class="invalid-feedback">
                  {{ $errors->first('nama_type') }}
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Keterangan</label>
                  <textarea name="keterangann" class="form-control" rows="8" cols="80"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
