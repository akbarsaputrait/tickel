@extends('master_admin') @section('title', 'Daftar Rekening') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div class="">
						<h4 class="card-title">
							<b>Daftar Rekening</b>
						</h4>
					</div>
					<div class="mb-3">
						<button data-toggle="modal" data-target="#createRekening" class="btn btn-primary">
							<i class="mdi mdi-plus"></i> Tambah
						</button>
					</div>
				</div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  Atas Nama
                </th>
                <th>
                  Nama Bank
                </th>
                <th>
                  Nomor Rekening
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($rekening as $item)
              <tr>
                <td>
                  {{ $item->atas_nama }}
                </td>
                <td>
                  {{ $item->nama_bank }}
                </td>
                <td>
                  {{ $item->no_rekening }}
                </td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('admin.rekening.edit', ['rekening' => $item->id_rekening]) }}" class="btn btn-success">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" name="button" id="deleteButton" class="btn btn-danger" data-id="{{ $item->id_rekening }}" data-menu="rekening">
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
<div class="modal fade" id="createRekening" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nomor Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="{{ route('admin.rekening.store') }}" method="post">
          @csrf
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Atas Nama</label>
                <input type="text" class="form-control {{ ($errors->has('atas_nama')) ? 'is-invalid' : '' }}" name="atas_nama" value="" placeholder="Atas Nama Pemilik Rekening" autofocus>
                <div class="invalid-feedback">
                  {{ $errors->first('atas_nama') }}
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nama Bank</label>
                <input type="text" class="form-control {{ ($errors->has('nama_bank')) ? 'is-invalid' : '' }}" name="nama_bank" value="" placeholder="Nama Bank">
                <div class="invalid-feedback">
                  {{ $errors->first('nama_bank') }}
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nomor Rekening</label>
                <input type="text" class="form-control {{ ($errors->has('no_rekening')) ? 'is-invalid' : '' }}" name="no_rekening" value="" placeholder="Nomor Rekening">
                <div class="invalid-feedback">
                  {{ $errors->first('no_rekening') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="mdi mdi-content-save"></i> Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="mdi mdi-close"></i>Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
