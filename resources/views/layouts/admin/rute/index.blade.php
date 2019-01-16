@extends('master_admin') @section('title', 'Rute') @section('content')
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
						<a href="{{ url('admin/rute/create') }}" class="btn btn-primary">
							<i class="fa fa-plus"></i> Tambah
						</a>
					</div>
				</div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
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
              <tr>
                <td>
                  Jakarta
                </td>
                <td>
                  Bandara Djuanda
                </td>
                <td>
                  Bandara Soekarno-Hatta
                </td>
                <td>
                  Rp. 300,000
                </td>
                <td>
                  Pesawat Garuda Indonesia
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" name="button" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" name="button" class="btn btn-danger">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
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
