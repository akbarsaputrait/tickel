@extends('master_admin') @section('title', 'Level') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Level</b>
						</h4>
					</div>
					<div class="mb-3">
						<a href="{{ route('admin.level.create') }}" class="btn btn-primary">
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

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($level as $item)
              <tr>
                <td>
                  {{ $item->nama_level }}
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('admin.level.edit', ['level' => $item->id_level]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" class="btn btn-danger" id="deleteButton"
                            data-id="{{ $item->id_level }}" data-menu="level">
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
