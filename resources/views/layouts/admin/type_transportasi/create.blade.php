@extends('master_admin') @section('title', 'Tipe Transportasi') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Tipe Transportasi</h4>
        <form class="form-horizontal" action="{{ route('type-transportasi.store') }}" method="post">
          @csrf
          <h3 class="card-description">
            Informasi Tipe Transportasi
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control {{ ($errors->has('nama_type')) ? 'is-invalid' : '' }}" name="nama_type" value="" placeholder="Nama Tipe Transportasi">
                <div class="invalid-feedback">
                  {{ $errors->first('nama_type') }}
                </div>
              </div>
            </div>
            <div class="col-md-8">
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
            <a href="{{ route('type-transportasi.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
