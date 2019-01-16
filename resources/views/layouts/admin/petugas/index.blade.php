@extends('master_admin') @section('title', 'Petugas') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Petugas</b>
						</h4>
					</div>
					<div class="mb-3">
						<a href="{{ url('admin/petugas/create') }}" class="btn btn-primary">
							<i class="fa fa-plus"></i> Tambah
						</a>
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
                  Email
                </th>
                <th>
                  Telepon
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($petugas as $item)
              <tr>
                <td>
                  {{ $item->nama_petugas }}
                </td>
                <td>
                  {{ $item->email }}
                </td>
                <td>
                  {{ $item->telefone }}
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('petugas.edit', ['petugas' => $item->id_petugas]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" id="deleteButton" class="btn btn-danger" data-id="{{ $item->id_petugas }}" data-menu="petugas">
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
