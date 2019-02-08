@extends('master_admin') @section('title', 'Transportasi') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Transportasi</b>
						</h4>
					</div>
					<div class="mb-3">
            <a href="{{ route('admin.tipe-transportasi.index') }}" class="btn btn-warning">
							<i class="fa fa-rocket"></i> Type Transportasi
						</a>
						<a href="{{ route('admin.transportasi.create') }}" class="btn btn-primary">
							<i class="fa fa-plus"></i> Tambah
						</a>
					</div>
				</div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  Kode
                </th>
                <th>
                  Jumlah Kursi
                </th>
                <th>
                  Nama
                </th>
                <th>
                  Keterangan
                </th>
                <th>
                  Jenis Transportasi
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($transportasi as $item)
              <tr>
                <td>
                  <span class="badge badge-dark">{{ $item->kode }}</span>
                </td>
                <td>
                  {{ $item->jumlah_kursi }}
                </td>
                <td>
                  {{ $item->nama_transportasi }}
                </td>
                <td>
                  {{ $item->keterangan }}
                </td>
                <td>
                  {{ $item->jenis->nama_type }}
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('admin.transportasi.edit', ['transportasi' => $item->id_transportasi]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" id="deleteButton" class="btn btn-danger" data-id="{{ $item->id_transportasi }}" data-menu="transportasi">
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
